<?php

//httponly flag
ini_set('session.cookie_httponly', 1);

//prevent session ID from being passed through URLs
ini_set('session.use_only_cookies', 1);

//for later
//use HTTPS only
//ini_set('session.cookie_secure', 1);

//session_start();

use Respect\Validation\Validator as v;

//autoload dependencies
require_once dirname(__DIR__) . '/vendor/autoload.php';

//use this for printing stuff
function pr($data)
{
    echo "<pre>";
    var_dump($data); // or var_dump($data);
    echo "</pre>";
}

//set ctype language to german
//seems not to work under windows
setlocale(LC_CTYPE, 'de_DE.UTF-8','German_Germany.1252', 'deu', 'german', 'deu_deu', 'de_DE@euro', 'de_DE', 'de', 'ge');
mb_internal_encoding("UTF-8");

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'validation' => [
            'idLength' => 4,
            'emailLength' => 30,
            'firstNameLength' => 20,
            'lastNameLength' => 20,
            'nicknameLength' => 20,
            'passwordLength' => 20,
            'telephoneNumberLength' => 20,
            'roomLength' => 20,
        ],

        //TODO: scheint noch buggy zu sein
        //'csrfProtection' => false,

        'assert' => [
            'active' => true,
            'bail' => true
        ],

        'jwt' => [

            //signature algorithm
            'algorithm' => 'RS256',

            //Header key
            //format is like X-Token | Bearer sdfjskdfsdjfhsk...
            'header' => 'X-Token',

            //name of the returned public key
            'pubkeyname' => 'X-Token-verify',

            //this has to be enabled later for HTTPS
            'secure' => false,

            //protected paths
            'path' => '/api',

            //unprotected paths
            'ignore' => [
                //for login
                '/api/sessions',

                //for debugging
                '/api/phpinfo',
                
                //for registration
                '/api/admins'],

            //lifetime of an issued token in seconds
            'lifetime' => 18000
        ],
    ],
]);

$container = $app->getContainer();

//set assert parameters
assert_options(ASSERT_ACTIVE, $container->settings['assert']['active']);
assert_options(ASSERT_BAIL, $container->settings['assert']['bail']);

//inject CSRF protection
// if ($container->settings['csrfProtection']) {
//     $container['csrf'] = function ($container) {

//     //CSRF protection applies to POST, PUT, DELETE, PATCH
//         $guard = new \Slim\Csrf\Guard();

//         //update token only with new session or on CSRF check failure,
//         //instead of being updated after every request
//         $guard->setPersistentTokenMode(true);
//         return $guard;
//     };
// }


//inject assertion helper
$container['AssertHelper'] = function ($container) {
    return new \App\Helper\AssertHelper($container);
};

//inject route controllers
$container['UserController'] = function ($container) {
    return new \App\Controllers\UserController($container);
};
$container['AdminController'] = function ($container) {
    return new \App\Controllers\AdminController($container);
};
$container['SessionController'] = function ($container) {
    return new \App\Controllers\SessionController($container);
};
$container['ShiftController'] = function ($container) {
    return new \App\Controllers\ShiftController($container);
};

//inject authentication
$container['auth'] = function ($container) {
    return new \App\Authentication\Auth($container);
};


//inject database connection
$container['Database'] = function ($container) {
    $db = \App\Database::Instance();
    $db->setAppSettings($container->settings);
    return $db;
};

//inject validation
$container['Validator'] = function ($container) {
    return new \App\Validation\Validator();
};

//add validation middleware
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));

//add csrf protection middleware
if ($container->settings['csrfProtection']) {
    $app->add($container->csrf);
}

assert(isset($container->settings['jwt']));
$app->add(new Tuupola\Middleware\JwtAuthentication([
    'secret' => $container->auth->publicKey(),
    'path' => $container->settings['jwt']['path'],
    'ignore' => $container->settings['jwt']['ignore'],
    'secure' => $container->settings['jwt']['secure'],
    'algorithm' => array($container->settings['jwt']['algorithm']),
    'header' => $container->settings['jwt']['header']
]));

//include custom rules for validation
v::with('App\\Validation\\Rules\\');

//load routes
require_once dirname(__DIR__) . '/app/routes.php';
