<?php

namespace App\Validation\Rules;

use App\Database;
use Respect\Validation\Rules\AbstractRule;

abstract class Rule extends AbstractRule
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::Instance();
    }
}
