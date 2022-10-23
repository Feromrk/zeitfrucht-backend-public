<?php

namespace App\Validation\Rules;


class UniqueEmail extends Rule
{
    public function validate($input)
    {
        $sql = 'SELECT email FROM user WHERE email = :email1 
                UNION ALL
                SELECT email from admin WHERE email = :email2';

        $row = $this->db->querySelect($sql, [':email1' => $input, ':email2' => $input]);

        if ($row || $row === null) {
            return false;
        }

        return true;
    }
}
