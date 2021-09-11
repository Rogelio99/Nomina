@extends('employees.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>{{$employee->id ? 'Actualizar empleado':'Registrar empleado nuevo'}}</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('index') }}"> Regresar</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Ups</strong> Verifica los campos por favor<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ url('save/'.$employee->id) }}" method="POST">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Código:</strong>
                <div class="col-sm-10">
                    <input type="text" name="code" class="form-control" placeholder="Ingresa el código" value="{{$employee->id ?$employee->code: ''}}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Nombre:</strong>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" placeholder="Ingresa un nombre" value="{{$employee->id ?$employee->name: ''}}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Apellido Paterno:</strong>
                <div class="col-sm-10">
                    <input type="text" name="paternal_surname" class="form-control" placeholder="Ingresa un apellido paterno" value="{{$employee->id ?$employee->paternal_surname: ''}}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Apellido Materno:</strong>
                <div class="col-sm-10">
                    <input type="text" name="maternal_surname" class="form-control" placeholder="Ingresa un apellido materno" value="{{$employee->id ?$employee->maternal_surname: ''}}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Correo electronico:</strong>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" placeholder="Ingresa un correo electronico" value="{{$employee->id ?$employee->email: ''}}">
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Tipo de contrato:</strong>
                <div class="col-sm-10">
                    <select name="type_of_contract" class="form-control">
                        @foreach ($types_of_contract as $type_of_contract)
                        <option {{$employee->id ? $employee->type_of_contract_id == $type_of_contract->id?'selected':'':'' }} value="{{$type_of_contract->id}}"> {{$type_of_contract->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group row">
                <strong class="col-sm-2 col-form-label">Tipo de contrato:</strong>
                <div class="col-sm-10">
                    <select name="status" class="form-control">
                        <option value="1" {{$employee->id ? $employee->status==1?'selected':'':''}}>Activo</option>
                        <option value="0" {{$employee->id ? $employee->status==0?'selected':'':''}}>Inactivo</option>
                    </select>
                </div>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>

</form>
@endsection