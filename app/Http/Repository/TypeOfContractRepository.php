<?php

namespace App\Http\Repository;

use App\Models\type_of_contract;
use Exception;

class TypeOfContractRepository {
    public function __construct(){
   
    }

    public function FindById($id){
        return type_of_contract::find($id);
    }

    public function FindByFilters($filters){
        
        $is_active = 1;

        $type_of_contracts = type_of_contract::where('is_active', '=', $is_active);
        return $type_of_contracts->get();
    }
}