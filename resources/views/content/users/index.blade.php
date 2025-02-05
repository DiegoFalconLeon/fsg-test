@extends('layouts/contentNavbarLayout')

@section('title', 'Usuarios Cridez')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Usuarios /</span> Lista de Usuarios
</h4>
<div >
  <a href="{{route('users.create')}}" class="btn btn-primary">Crear Usuario</a>
  <a href="{{route('users.pdf')}}" class="btn btn-danger">Exportar PDF</a>
  <a href="{{route('users.excel')}}" class="btn btn-success">Exportar Excel</a>
</div></br>

<div class="card">
  {{-- <h5 class="card-header">Light Table head</h5> --}}
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
          <th>Nombre Completo</th>
          <th>Email</th>
          <th>Area</th>
          <th>Estado</th>
          <th>Ocpiones</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($users as $user)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->name ." ". $user->lastname}}</strong></td>
          <td>{{$user->email}}</td>
          <td>
            {{$user->areas->name}}
          </td>
          <td><span class="badge bg-label-{{Util::bagde($user->status)}} me-1">{{Util::estado($user->status)}}</span></td>
          <td>
            <a  href="users/show/{{$user->id}}"><i class="bx bx-edit-alt me-1"></i> editar</a>
            <a  href="users/delete/{{$user->id}}" data-confirm-delete="false"><i class="bx bx-trash me-1"></i> Borrar</a>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>



@endsection
