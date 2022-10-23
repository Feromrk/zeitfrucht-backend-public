<?php

namespace App\Validation;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    protected $errors = [];

    public function setErrorsForSingleField(array $errors)
    {
        #$errors: field => [ "error msg1", "error msg2", ...  ]
        #or
        #$erros: field => "error msg"

        if(\count($errors) !== 1) {
            throw \LengthException("Array length of argument must be 1");
        }

        $keys = \array_keys($errors);
        assert(count($keys) === 1);

        $field = $keys[0];

        $msg = $errors[$field];

        if(!is_array($msg)) {
            $msg = [$msg];
        }

        if(isset($this->errors[$field])) {
            $this->errors = \array_merge($this->errors[$field], $msg);
        } else {
            $this->errors[$field] = $msg;
        }

    }

    public function validate($request, array $rules, $paramsOnlyInBody = true)
    {

        if($paramsOnlyInBody) {
            $params = $request->getParsedBody();
        } else {
            $params = $request->getParams();
        }

        if($request->getBody()->isSeekable()) {
            $request->getBody()->rewind();
        } else {
            $this->errors['body'] = "internal error";
            return $this;
        }

        foreach ($rules as $field => $rule) {
            try {
                if ($field === 'CONTENT_TYPE') {
                    $body = $request->getBody()->getContents();
                    if($request->getBody()->isSeekable()) {
                        $request->getBody()->rewind();
                    } else {
                        $this->errors['body'] = ["internal error"];
                        return $this;
                    }
                    $rule->setName('Request body')->assert($body);
                } else {
                    $rule->setName(ucfirst($field))->assert($params[$field]);
                }
            } catch (NestedValidationException $e) {
                //show other errors only if valid CONENT_TYPE, since wrong CONTENT_TYPE gives false positives
                if (!isset($this->errors['CONTENT_TYPE'])) {
                    $this->setErrorsForSingleField([$field => $e->getMessages()]);
                }
            } catch (Respect\Validation\Exceptions\Exception $e) {
                pr('validate: base error');
            }
        }

        return $this;
    }

    public function validateArray(array $arr, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName(ucfirst($field))->assert($arr[$field]);
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            } catch (Respect\Validation\Exceptions\Exception $e) {
                pr('validate: base error');
            }
        }

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

    public function getErrors() 
    {
        return $this->errors;
    }

    public function clearErrors() 
    {
        $this->errors = [];
    }
}
