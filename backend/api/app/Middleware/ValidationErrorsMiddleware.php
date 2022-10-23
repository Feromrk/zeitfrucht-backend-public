<?php

namespace App\Middleware;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke($request, $response, $next)
    {
        
        $response = $next($request, $response);

        
        $errors = $this->container->Validator->getErrors();
        $this->container->Validator->clearErrors();

        if (!empty($errors)) {
            return $response->withJson(array('errors' => $errors), 422);
        } else {
            return $response;
        }

    }
}
