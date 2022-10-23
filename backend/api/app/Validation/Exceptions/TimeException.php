<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class TimeException extends ValidationException {

        public static $defaultTemplates = [
            self::MODE_DEFAULT => [
                self::STANDARD => 'Time must be of format HH:MM 24-hour with leading 0.',
            ],
        ];
}