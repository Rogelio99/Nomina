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

    
}
