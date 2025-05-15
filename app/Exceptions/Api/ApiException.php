<?php

namespace App\Exceptions\Api;

use Exception;

class ApiException extends Exception
{
    public function __construct(string $message = "", int $code = 500, $errors = []){
        //Формируем ответ
        $response = [
            'message' => $message,

        ];
        if(!empty($errors)){
            $response['errors'] = $errors;
        }
        parent::__construct(response()->json($response)->setStatusCode($code));
    }
}
