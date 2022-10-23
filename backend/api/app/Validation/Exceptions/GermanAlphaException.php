<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class GermanAlphaException extends ValidationException
{
    public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Only letters a-Z,ä-Ü allowed.',
            ],
        ];
}
