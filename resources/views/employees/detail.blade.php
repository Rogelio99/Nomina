@extends('employees.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Detalle de empleado</h2>
        </div>
        <div class="pull-right mt-3">
            <a class="btn btn-primary" href="{{ route('index') }}"> Regresar</a>
        </div>
        <div class="pull-right mt-3">
            <a class="btn btn-success" href="{{ route('Employeer.form', ['id' =>$employee->id]) }}"> Editar</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Código:</strong>
            {{ $employee->code}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre completo:</strong>
            {{ $employee->name ." ".$employee->paternal_surname. " ".$employee->maternal_surname}}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Correo Electronico:</strong>
            {{ $employee->email }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipo de contrato:</strong>
            {{ $employee->type_of_contract->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipo de contrato:</strong>
            {{ $employee->status == 1 ? 'Active' : 'Inactivo' }}
        </div>
    </div>
</div>
@endsection