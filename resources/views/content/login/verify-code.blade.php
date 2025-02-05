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
                        <h4>Verificar Código de Recuperación</h4>
                        <p>Hemos enviado un código a tu correo. Ingresa el código para continuar.</p>

                        <form action="{{ route('password.check') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ session('email') ?? old('email') }}" block readonly>
                            </div>
                            <input type="text" name="code" class="form-control" placeholder="Código de 6 dígitos"
                                required maxlength="6" autofocus>
                            <br>
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <button class="btn btn-primary">Continuar</button>
                            <a href="/login" class="btn btn-secondary">Cancelar</a>
                        </form>
                        
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
