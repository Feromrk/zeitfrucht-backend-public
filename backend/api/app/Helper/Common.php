<?php

namespace App\Helper;

class Common {

    //remove all keys with empty strings as value from array
    public static function removeEmptyStringsRecursively(array &$array) {
        foreach ($array as $key => &$value) {

            if(!is_array($value)) {
                if(strlen($value) === 0) {
                    unset($array[$key]);
                }
            } else {
                self::removeEmptyStringsRecursively($value);
            }
        }

        return $array;
    }

}