<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Response\SuccessResponse;
use App\Http\Response\ErrorResponse;
use App\Http\Bc\TypeOfContractBc;
use \Exception;

class TypeOfContractController extends Controller
{
    private $type_of_contract_bc = null;

    public function __construct()
    {
        
        $this->type_of_contract_bc = new TypeOfContractBc();
    }
    /**
     * Enlista los contratos.
     * @param  \Illuminate\Http\Request  $request ejemplo: {} o {}
     * @return App\Http\Response\Response
     */
    public function FindTypeOfContracts(Request $request){
        try
        {
            $filters = [];

            $type_of_contracts  = $this->type_of_contract_bc->FindTypeOfContracts($filters);
            $response = new SuccessResponse();
            $response->SetData($type_of_contracts);
            return $response->WriteResponse();
        }
        catch(Exception $e){
            $response = new ErrorResponse();
            $response->SetMessage($e->getMessage());
            return $response->WriteResponse();
        }
    }
}