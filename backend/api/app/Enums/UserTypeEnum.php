<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static self USER()
 * @method static self ADMIN()
 */
class UserTypeEnum extends Enum
{
    const USER = 'user';
    const ADMIN = 'admin';
}
