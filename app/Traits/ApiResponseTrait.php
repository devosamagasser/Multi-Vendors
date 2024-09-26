<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data=null,$message=null,$error=null,$code=200)
    {
        $array = [
            'code' => $code,
            'message' => $message,
            'error' => $error,
            'data' => $data,
        ];

        return response($array,200);
    }
}
