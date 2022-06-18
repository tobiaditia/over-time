<?php
namespace App\Utils;

use Illuminate\Http\JsonResponse;

trait Response
{
    public function responseData ($data, $message = null){
        if ($message != null){
            return new JsonResponse([
                'message' => $message,
                'data'   => $data,
            ],200);
        }
        return new JsonResponse([
            'result' => true,
            'data'      => $data,
        ],200);
    }

    public function responseServerError(){
        return new JsonResponse([
            'mesage'    => 'Server error',
            'errors' => null,
        ],500);
    }

    public function responseValidation($validation){
        return new JsonResponse([
            'message' => 'Validation Error',
            'errors' => $validation,
        ], 400);
    }

}
