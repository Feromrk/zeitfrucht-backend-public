<?php

namespace App\Helper;

class AssertHelper 
{
    protected $container;
    private $settings;

    public function __construct($container)
    {
        $this->container = $container;
        $this->settings = $container->settings;
        
    }

    public function assertSettings(array $settings, string $function, string $line) {

        //get current settings
        $warning = assert_options(ASSERT_WARNING);
        $bail = assert_options(ASSERT_BAIL);

        //disable current settings
        assert_options(ASSERT_WARNING, 0);
        assert_options(ASSERT_BAIL, 0);

        foreach ($settings as $key => $value) {
            if(assert(isset($this->settings[$key][$value])) === FALSE) {
                echo('assert failed in function: '.$function.' on line: '.$line);
                echo("\nkey: '.$key.' value: '.$value.'not present in app settings");
                die;
            }
        }

        
        //restore settings
        assert_options(ASSERT_WARNING, $warning);
        assert_options(ASSERT_BAIL, $bail);
    }
}
