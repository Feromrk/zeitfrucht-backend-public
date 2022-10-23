<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class GermanPhoneException extends ValidationException
{
    public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Incorrect phone number.',
            ],
        ];
}
