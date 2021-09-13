<?php

namespace App\Http\Bc;

use App\Http\Repository\EmployeeRepository;
use App\Models\Employee;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class EmployeeBc{
    private $employee_repository = null;

    public function __construct(){
        $this->employee_repository = new EmployeeRepository();
    }

    public function FindEmployees ($filters) {
        if($filters['id']> 0){
            return $this->employee_repository->FindByIdWithRelation($filters['id']);
        }else{
            $employees = $this->employee_repository->FindByFilters($filters);
            $count = $this->employee_repository->Count();
            $data = new stdClass;
            $data->employees = $employees;
            $data->total = $count;
            return $data;
        }
    }

    public function ChangeStatus ($id) {
        try {
            DB::beginTransaction();
            $employee_stored = $this->employee_repository->FindById($id);
            if($employee_stored){
                $employee_stored->status = !$employee_stored->status;
                $employee_stored->save();
                $new_status = $employee_stored->status == 1 ? 'activado' : 'desactivado';
                $response = 'Empleado ' . $employee_stored->name . ' fue ' . $new_status . ' con exito';
                DB::commit();
                return $response;
            }else{
                return "No se encontro el empleado.";
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function Delete ($id) {
        try {
            DB::beginTransaction();
            $employee_stored = $this->employee_repository->FindById($id);
            if($employee_stored){
                $employee_stored->is_active = false;
                $employee_stored->save();
                $response = 'Empleado ' . $employee_stored->name . ' fue eliminado con exito';
                DB::commit();
                return $response;
            }else{
                return "No se encontro el empleado.";
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Método para guardar los datos del empleado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save($employee)
    {
        try {
            DB::beginTransaction();
            $rules = [
                'code' => ['required', 'max:10', 'min:10', 'regex: /^[a-z0-9]*$/'],
                'paternal_surname' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
                'maternal_surname' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
                'name' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
                'type_of_contract_id' => ['required'],
                'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
                'status' => 'required'
            ];

            $validation = Validator::make($employee, $rules);
            if ($validation->fails()) {
                $messages = $validation->errors();
                throw new Exception($messages);
            }

            $employee_to_save = new Employee();
            $employee_to_save->code = $employee['code'];
            $employee_to_save->name = $employee['name'];
            $employee_to_save->paternal_surname = $employee['paternal_surname'];
            $employee_to_save->maternal_surname = $employee['maternal_surname'];
            $employee_to_save->type_of_contract_id = $employee['type_of_contract_id'];
            $employee_to_save->email = $employee['email'];
            $employee_to_save->status = $employee['status'];

            if (isset($employee['id'])) {
                $employee_to_save->id = $employee['id'];
                $message = $this->employee_repository->update($employee_to_save);
            } else {
                $message = $this->employee_repository->create($employee_to_save);
            }
            DB::commit();
            return $message;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }
}