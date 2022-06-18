<?php
namespace App\Utils;

use Illuminate\Http\JsonResponse;

trait Response
{

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
