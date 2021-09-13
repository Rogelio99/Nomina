<?php

namespace App\Http\Response;

use App\Http\Response\Response;

class SuccessResponse extends Response
{   
    private $response;

    public function __construct()
    {
        $this->response = ['data' => []];
    }

    public function SetData($data){
        $this->response['data'] = $data;
    }

    public function WriteResponse(){
        return response()->json($this->response, 200, [], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }
}
