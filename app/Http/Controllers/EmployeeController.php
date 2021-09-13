<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Response\SuccessResponse;
use App\Http\Response\ErrorResponse;
use App\Http\Bc\EmployeeBc;
use \Exception;

class EmployeeController extends Controller
{
    private $employee_bc = null;

    public function __construct()
    {
        
        $this->employee_bc = new EmployeeBc();
    }
    /**
     * Enlista los empleados.
     * @param  \Illuminate\Http\Request  $request ejemplo: {"limit":1, "page":2} o {"id":1}
     * @return App\Http\Response\Response
     */
    public function FindEmployees(Request $request){
        try
        {
            $filters = [];
            $filters["limit"] = $request->input('limit');
            $filters["page"] = $request->input('page');
            $filters["id"] = $request->input('id');

            $employees  = $this->employee_bc->FindEmployees($filters);
            $response = new SuccessResponse();
            $response->SetData($employees);
            return $response->WriteResponse();
        }
        catch(Exception $e){
            $response = new ErrorResponse();
            $response->SetMessage($e->getMessage());
            return $response->WriteResponse();
        }
    }


    /**
     * Activar o desactivar al empleado
     *
     * @param  \Illuminate\Http\Request  $request ejemplo: /employee/change_status?id=1
     * @return App\Http\Response\Response
     */
    public function ChangeStatus(Request $request){
        try
        {
            $id = $request->input('id');

            $message  = $this->employee_bc->ChangeStatus($id);
            $response = new SuccessResponse();
            $response->SetData($message);
            return $response->WriteResponse();
        }
        catch(Exception $e){
            $response = new ErrorResponse();
            $response->SetMessage($e->getMessage());
            return $response->WriteResponse();
        }
    }

    /**
     * Eliminado logico de empleado
     *
     * @param  \Illuminate\Http\Request  $request ejemplo: /employee/delete?id=1
     * @return \Illuminate\Http\Response
     */

    public function Delete(Request $request){
        try
        {
            $id = $request->input('id');

            $message  = $this->employee_bc->Delete($id);
            $response = new SuccessResponse();
            $response->SetData($message);
            return $response->WriteResponse();
        }
        catch(Exception $e){
            $response = new ErrorResponse();
            $response->SetMessage($e->getMessage());
            return $response->WriteResponse();
        }
    }

    /**
     * Eliminado logico de empleado
     *
     * @param  \Illuminate\Http\Request  $request ejemplo: 
     * 
     * {
     *  "employee": {
     *     "id": 60,  if will be created this field dont be send
     *     "code": "1a2b3c4d5e",
     *     "name": "Nelli",
     *     "paternal_surname": "Suarez",
     *     "maternal_surname": "Perez",
     *     "type_of_contract": 2,
     *     "email": "nelli@gmail.com",
     *     "status": true
     *   }
     * }
     * @return \Illuminate\Http\Response
     */

    public function Save(Request $request){
        try
        {
            $employee_to_save = $request->input('employee');
            $message  = $this->employee_bc->Save($employee_to_save);
            $response = new SuccessResponse();
            $response->SetData($message);
            return $response->WriteResponse();
        }
        catch(Exception $e){
            $response = new ErrorResponse();
            $response->SetMessage($e->getMessage());
            return $response->WriteResponse();
        }
    }
   
}
