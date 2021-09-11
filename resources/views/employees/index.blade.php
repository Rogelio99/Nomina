@extends('employees.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Gestión de empleados</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" >Registrar empleado nuevo</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>#</th>
        <th>Código</th>
        <th>Nombre</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Correo Electronico</th>
        <th>Tipo de contrato</th>
        <th>Estado</th>
        <th width="280px">Acciones</th>
    </tr>
    @foreach ($employees as $employee)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $employee->code}}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->paternal_surname }}</td>
        <td>{{ $employee->maternal_surname }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->type_of_contract["name"] }}</td>
        <td>{{ $employee->status == 1 ? 'Activo': 'Inactivo'}}</td>
        <td>
            <form action="{{route('Employeer.delete', ['id' =>$employee->id])}}" method="POST">

                <a class="btn btn-info" >Ver detalle</a>

                <a class="btn btn-primary" >Editar</a>

                <a class="btn btn-danger">Desactivar</a>

                @method('DELETE')

                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $employees->links() !!}

@endsection