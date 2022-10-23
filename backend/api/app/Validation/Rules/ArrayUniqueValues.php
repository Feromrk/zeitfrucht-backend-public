<?php

namespace App\Validation\Rules;


class ArrayUniqueValues extends Rule
{
    public function validate($input)
    {
        if (!is_array($input)) {
            return true;
        }
        
        return count($input) === count(array_unique($input));
    }
}
