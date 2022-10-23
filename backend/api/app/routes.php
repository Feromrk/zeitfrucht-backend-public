<?php


/**
 * @OA\Info(title="Zeitfrucht API", version="0.1")
 */


$app->group('/api', function () use ($app) {
    $app->get('/swagger/swagger.json', function ($request, $response) {
        $response->getBody()->write(\OpenApi\scan('../app')->toJson()); //returns int
        return $response->withHeader('Content-Type', 'application/json');
    });

    if ($this->getContainer()->settings['displayErrorDetails']) {
        $app->get('/phpinfo', function () use ($app) {
            echo phpinfo();
        });
    }
   
    $app->group('/users', function () use ($app) {
        //get all users for a given admin
        $app->get('', 'UserController:get_returnAllUsers');

        //get single user for a given admin or given user
        $app->get('/{id}', 'UserController:get_returnSingleUser');

        //register user for a given admin
        $app->post('', 'UserController:post_createSingleUser');

        //TODO
        //nur admin sendet userid um einzelnen user zu löschen
        $app->delete('/{id}', 'UserController:delete_deleteSingleUser');
    });

    $app->group('/admins', function () use ($app) {

        //get all admins -> does this make sense?
        //$app->get('', 'AdminController:getSendAll');

        //register admin
        $app->post('', 'AdminController:post_createSingleAdmin');
    });

    $app->group('/sessions', function () use ($app) {

        //get auth status
        //$app->get('', 'SessionController:getSendAuthStatus');

        //create jwt token aka login
        $app->post('', 'SessionController:post_createToken');

        //logout
        //$app->delete('', 'SessionController:deleteDoLogout');

        //get csrf token
        // if ($container->settings['csrfProtection']) {
        //     $app->get('/csrf', 'SessionController:getSendCsrf');
        // }
    });

    //TODO
    $app->group('/shifts', function () use ($app) {

        //get all shifts
        //admin, user schickt datum
        //alle schichten aus raum für das datum
        $app->get('', 'ShiftController:get_returnAllShifts'); 

        //create a shift
        //nur admin schickt datum, beginn, optional ende, und alle user in dieser schicht, optional sich selber auch
        //auch bei änderungen / löschungen 
        //imme prüfen, ob user schon in der schicht drin, wenn ja rauslöschen und dann anlegen
        $app->post('', 'ShiftController:post_createSingleShift');

        //nur vom admin, schickt eine oder mehrere ids um eine oder mehrere schichten zu löschen
        $app->delete('/{id}', 'UserController:delete_deleteShifts');
    });
});
