<?php

namespace App\Http\Repository;

use App\Models\Employee;
use Exception;

class EmployeeRepository {
    public function __construct(){
   
    }

    public function FindByIdWithRelation($id){
        return Employee::with(['type_of_contract'])->find($id);
    }

    public function FindById($id){
        return Employee::find($id);
    }

    public function FindByFilters($filters){
        
        $is_active = 1;
        $field_sort = 'paternal_surname';
        $sort = 'asc';
        $limit = 10;
        $page = 0;
        if(isset($filters['limit']))
            $limit = $filters['limit'];
        if(!empty($filters['page']))
            $page = ($limit * $filters['page']) - $limit;
    
        $employees = Employee::where('is_active', '=', $is_active)
        ->with(['type_of_contract'])
        ->skip($page)
        ->take($limit)
        ->orderBy($field_sort, $sort);
        return $employees->get();
    }

    public function Count() {
        return Employee::where('is_active', '=', 1)->count();
    }

    public function Update(Employee $employee){
        $employee_stored = Employee::find($employee->id);
        
        if ($employee_stored) {
            
            $employee_stored->code = $employee['code'];
            $employee_stored->name = $employee['name'];
            $employee_stored->paternal_surname = $employee['paternal_surname'];
            $employee_stored->maternal_surname = $employee['maternal_surname'];
            $employee_stored->type_of_contract_id = $employee['type_of_contract_id'];
            $employee_stored->email = $employee['email'];
            $employee_stored->status = $employee['status'];
            $employee_stored->save();
            return 'Empleado actualizado';
        } else {
            throw new Exception("El empleado no existe");
        }
    }

    public function Create(Employee $employee){
        $employee_stored = Employee::where('email', '=', $employee->email)->orWhere('code', '=', $employee->code)->first();
        if ($employee_stored){
            throw new Exception('El codigo o email del empleado que intenta registrar ya esta registrado.');
        } else {
            $employee->save();
            return 'Empleado creado';
        }
    }
}