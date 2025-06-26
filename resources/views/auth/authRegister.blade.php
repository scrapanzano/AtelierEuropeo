@extends('layouts.master')

@section('title', 'AE - Registrati')

@section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h1 class="section-title mb-2" style="font-size: 3rem;">Unisciti a noi!</h1>
                        <p class="section-subtitle mb-0">Crea il tuo account e inizia a esplorare l'Europa</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 mb-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <div>
                                    <strong>Attenzione!</strong>
                                    <span class="d-block">{{ $errors->first() }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Nome completo</label>
                            <input type="text" name="name" id="name" required
                                   class="form-control form-control-lg border-0 shadow-sm rounded-3"
                                   placeholder="Inserisci il tuo nome completo"
                                   value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" id="email" required
                                   class="form-control form-control-lg border-0 shadow-sm rounded-3"
                                   placeholder="Inserisci la tua email"
                                   value="{{ old('email') }}">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" required
                                   class="form-control form-control-lg border-0 shadow-sm rounded-3"
                                   placeholder="Crea una password sicura">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-rounded w-100 py-3 mb-3">
                            <i class="bi bi-person-plus-fill me-2"></i>Registrati
                        </button>
                    </form>

                    <div class="text-center">
                        <p class="mb-0">Hai già un account? 
                            <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Accedi ora</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
