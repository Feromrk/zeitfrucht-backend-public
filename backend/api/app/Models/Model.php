<?php

namespace App\Models;

abstract class Model {

    //returns available properties but excludes $excluded
    protected function getVars(array $excluded = []) {

        //remove metadata
        $excluded = array_merge($excluded, ['created_at', 'modified_at']);

        $vars = get_object_vars($this);

        if (!is_null($excluded)) {
            foreach ($excluded as $value) {
                unset($vars[$value]);
            }
        }
        return $vars;
    }

    protected function setVars(array $data, array $toBeSet) {
        if(is_null($data) || is_null($toBeSet)) {
            throw new \OutOfBoundsException("data and toBeSet must not be null");
        }

        foreach ($toBeSet as $var => $option) {
            
            if(isset($data[$var])) {
                $this->$var = $data[$var];
            } else {
                if($option === 'notnull') {
                    throw new \OutOfBoundsException("data and toBeSet must not be null");
                }
            }

        }
    }

    //must return an array of properties, that must be set for an insert statement
    abstract public function getInsertVars();

    //must return an array of public properties, that are returned to the front end upon creation
    abstract public function getPublicVars();
}