@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">@include('_partials.macros', ['width' => 25, 'withbg' => '#696cff'])</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <h4>Restablecer Contraseña</h4>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $email }}" block
                                    readonly>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Nueva Contraseña"
                                required>
                            <br>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirmar Contraseña" required>
                            <br>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Guardar</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
