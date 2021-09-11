<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\type_of_contract;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Enlista los productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::where('is_active', '=', 1)->with(['type_of_contract'])->orderBy('paternal_surname', 'DESC')->paginate(5);
        return view('employees.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Visualiza el detalle del empleado.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->input('id');
        $employee = Employee::with(['type_of_contract'])->find($id);


        return view('employees.detail', compact('employee'));
    }

    /**
     * Abre el formulario para la creación de actualización
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request)
    {
        $id = $request->input('id');
        $types_of_contract = type_of_contract::where('is_active', '=', 1)->get();

        if ($id)
            $employee = Employee::with(['type_of_contract'])->find($id);
        else {
            $employee = new Employee();
            $employee->id = 0;
        }

        return view('employees.form', compact('employee', 'types_of_contract'));
    }

    /**
     * Método para guardar los datos del empleado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate([
            'code' => ['required', 'max:10', 'min:10', 'regex: /^[a-z0-9]*$/'],
            'paternal_surname' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
            'maternal_surname' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
            'name' => ['required', 'regex: /^[a-zA-Z-_]*$/'],
            'type_of_contract' => ['required'],
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'status' => 'required'
        ]);

        $employee = new Employee();
        $employee->code = $request['code'];
        $employee->name = $request['name'];
        $employee->paternal_surname = $request['paternal_surname'];
        $employee->maternal_surname = $request['maternal_surname'];
        $employee->type_of_contract_id = $request['type_of_contract'];
        $employee->email = $request['email'];
        $employee->status = $request['status'];

        if ($request['id'] != 0) {
            $employee->id = $request['id'];
            $message = $this->update($employee);
        } else {
            $message = $this->create($employee);
        }
        return redirect()->route('index')
            ->with('success', $message);
    }

    /**
     * Método para actualizar los datos del empleado.
     *
     * @param  App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee)
    {
        $employee_stored = Employee::find($employee->id);
        if ($employee_stored) {
            $employee->code = $employee['code'];
            $employee_stored->name = $employee['name'];
            $employee_stored->paternal_surname = $employee['paternal_surname'];
            $employee_stored->maternal_surname = $employee['maternal_surname'];
            $employee_stored->type_of_contract_id = $employee['type_of_contract_id'];
            $employee_stored->email = $employee['email'];
            $employee_stored->status = $employee['status'];
            $employee_stored->save();
            return 'Empleado actualizado';
        } else {
            return "El empleado no existe";
        }
    }

    /**
     * Método para crear al  empleado.
     *
     * @param  App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function create(Employee $employee)
    {
        $employee_stored = Employee::where('email', '=', $employee->email)->orWhere('code', '=', $employee->code)->first();
        if ($employee_stored)
            return 'El codigo o email del empleado que intenta registrar ya esta registrado.';
        else {
            $employee->save();
            return 'Empleado creado';
        }
    }

    
}
