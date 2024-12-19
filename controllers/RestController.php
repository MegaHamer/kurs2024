<?php
namespace app\controllers;
use yii\rest\ActiveController;

class RestController extends ActiveController
{
    public function send($code,$data){
        $response = $this->response;
        $response->format = \yii\web\Response::FORMAT_JSON;

        $response->data = $data;
        $response->statusCode = $code;

        return $response;
    }

    public function sendErrorValidation($error){
        return $this->send(422,[
            "message"=>"Validation error",
            "errors"=>$error
        ]);
    }
}