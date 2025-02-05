@extends('layouts/contentNavbarLayout')

@section('title', 'Lista de Sesiones')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Historial de Inicio de Sesión /</span> Lista de Sesiones
</h4>
<div >
  {{-- <a href="{{route('users.create')}}" class="btn btn-primary">Crear Usuario</a>
  <a href="{{route('users.pdf')}}" class="btn btn-danger">Exportar PDF</a>
  <a href="{{route('users.excel')}}" class="btn btn-success">Exportar Excel</a> --}}
</div></br>

<div class="card">
  {{-- <h5 class="card-header">Light Table head</h5> --}}
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
          <th>Nombre Completo</th>
          <th>Email</th>
          <th>Estado</th>
          <th>Estado de Conexión</th>
          <th>Última Conexión</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }} {{ $user->lastname }}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if ($user->tracking && $user->tracking->status == 'A') Activo
                @elseif ($user->tracking && $user->tracking->status == 'I') Inactivo
                @else No definido
                @endif
            </td>
            <td>
                @if ($user->tracking && $user->tracking->status_conection == '1') Conectado
                @elseif ($user->tracking && $user->tracking->status_conection == '0') Desconectado
                @else No definido
                @endif
            </td>
            <td>{{ $user->tracking && $user->tracking->last_conection ? \Carbon\Carbon::parse($user->tracking->last_conection)->format('d/m/Y H:i:s') : 'Nunca' }}</td>
        </tr>
        @endforeach


      </tbody>
    </table>
  </div>
</div>



@endsection
