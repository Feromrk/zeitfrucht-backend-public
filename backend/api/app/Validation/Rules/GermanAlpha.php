<?php

namespace App\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

class GermanAlpha extends Rule
{
    public function validate($input)
    {
        //simple check if input contains some characters
        return preg_match('/^[a-zA-ZäÄöÖüÜß]*$/', $input);
    }
}
