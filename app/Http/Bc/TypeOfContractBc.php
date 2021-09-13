<?php

namespace App\Http\Bc;

use App\Http\Repository\TypeOfContractRepository;
use stdClass;

class TypeOfContractBc{
    private $type_of_contract_repository = null;

    public function __construct(){
        $this->type_of_contract_repository = new TypeOfContractRepository();
    }

    public function FindTypeOfContracts ($filters) {
        if(isset($filters['id'])){
            return $this->type_of_contract_repository->FindById($filters['id']);
        }else{
            $type_of_contracts = $this->type_of_contract_repository->FindByFilters($filters);
            $data = new stdClass;
            $data->type_of_contracts = $type_of_contracts;
            return $data;
        }
    }

}