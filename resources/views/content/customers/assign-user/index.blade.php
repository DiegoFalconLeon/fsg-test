@extends('layouts/contentNavbarLayout')

@section('title', 'Listar Caso ')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Clientes /</span> Listar Casos
</h4>
<div >
  <a href="assign-user/create" class="btn btn-primary">Añadir Nuevo</a>
  <a href="{{route('customers.assign-user.pdf')}}" class="btn btn-danger">Exportar PDF</a>
  <a href="{{route('customers.assign-user.excel')}}" class="btn btn-success">Exportar Excel</a>
</div></br>

<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead class="table-light">
        <tr>
          <th>Nombre Cliente</th>
          <th>Area de consulta</th>
          <th>Monto</th>
          <th>Trabajador asignado</th>
          <th>Estado</th>
          <th>Ocpiones</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($customers_users as $customer_user)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$customer_user->customers->name ." ". $customer_user->customers->lastname}}</strong></td>
          <td>{{$customer_user->areas->name}}</td>
          <td>{{$customer_user->amount}}</td>
          <td>{{$customer_user->users->name.' '.$customer_user->users->lastname}}</td>
          <td><span class="badge bg-label-{{Util::cbagde($customer_user->status)}} me-1">{{Util::cstatus($customer_user->status)}}</span></td>
          <td>
            <a  href="assign-user/show/{{$customer_user->id}}"><i class="bx bx-edit-alt me-1"></i> editar</a>
            <a  href="assign-user/delete/{{$customer_user->id}};"><i class="bx bx-trash me-1"></i> Borrar</a>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
