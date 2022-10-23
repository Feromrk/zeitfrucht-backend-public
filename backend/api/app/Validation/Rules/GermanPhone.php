<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class GermanPhone extends Rule
{
    public function validate($input)
    {
        //simple check if input contains some characters
        //also allows empty input
        return preg_match('/^[ \d()+\/-]*$/', $input);
    }
}
