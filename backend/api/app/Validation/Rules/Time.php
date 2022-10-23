<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class Time extends Rule
{
    public function validate($input)
    {
        //HH:MM 24-hour with leading 0
        //see https://digitalfortress.tech/tricks/top-15-commonly-used-regex/
        return preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $input);
    }
}


