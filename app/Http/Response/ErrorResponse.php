<?php

namespace App\Http\Response;
use App\Http\Response\Response;

class ErrorResponse extends Response
{   
    private $response;

    public function __construct()
    {
        $this->response = [
            "error" => [
                "code" => 0, 
                "message" => ""
            ]
        ];
    }

    public function SetMessage($message){
       $this->response["error"]["message"] = $message;
    }

    public function SetCode($code){
        $this->response["error"]["code"] = $code;
     }

    public function WriteResponse(){
        if(json_decode($this->response["error"]["message"], true))
            $this->response["error"]["message"] = json_decode($this->response["error"]["message"], true);
        return response()->json($this->response, 500);
    }
}