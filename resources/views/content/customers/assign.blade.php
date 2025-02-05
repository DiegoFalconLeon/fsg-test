@extends('layouts/contentNavbarLayout')

@section('title', 'Clientes Cridez')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Clientes /</span> Asignar cliente a usuarios
</h4>
<div ><a href="/customers/create" class="btn btn-primary">Asignar nuevo</a></div></br>

<div class="card">
  {{-- <h5 class="card-header">Light Table head</h5> --}}
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
          <th>Area de consulta</th>
          <th>Cliente</th>
          <th>Trabajador Asignado</th>
          <th>Estado</th>
          <th>Ocpiones</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        {{-- @foreach ($customers as $customer)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$customer->name ." ". $customer->lastname}}</strong></td>
          <td>{{$customer->document}}</td>
          {{-- <td>{{$customer->email}}</td> --}}
          <td>{{$customer->phone}}</td>
          <td>{{$customer->areas->name}}</td>
          <td>{{$customer->meansOfContact->name}}</td>
          <td><span class="badge bg-label-{{Util::cbadge($customer->status)}} me-1">{{Util::cstatus($customer->status)}}</span></td>
          <td>
            <a  href="customers/show/{{$customer->id}}"><i class="bx bx-edit-alt me-1"></i> editar</a>
            <a  href="customers/delete/{{$customer->id}};"><i class="bx bx-trash me-1"></i> Borrar</a>
          </td>
        </tr>
        @endforeach --}}

      </tbody>
    </table>
  </div>
</div>



@endsection
