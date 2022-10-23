<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class ArrayUniqueValuesException extends ValidationException
{
    public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Duplicate values are not allowed.',
            ],
        ];
}
