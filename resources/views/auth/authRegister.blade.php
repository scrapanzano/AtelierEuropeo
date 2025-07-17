@extends('layouts.master')

@section('title', 'AE - Registrati')

@section('body')
    <script>
        $(document).ready(function() {
            $("#register-form").submit(function(event) {
                var name = $("input[name='name']").val();
                var email = $("#register-form input[name='email']").val();
                var password = $("#register-form input[name='password']").val();
                var confirmPassword = $("input[name='password_confirmation']").val();
                var passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var hasErrors = false;

                // Reset errori precedenti
                $(".invalid-input").text("");

                // Verifica nome
                if (name.trim() === "") {
                    hasErrors = true;
                    $("#invalid-name").text("Il nome è obbligatorio.");
                }

                // Verifica email
                if (email.trim() === "") {
                    hasErrors = true;
                    $("#invalid-email").text("L'indirizzo email è obbligatorio.");
                } else if (!emailRegex.test(email)) {
                    hasErrors = true;
                    $("#invalid-email").text("Inserisci un indirizzo email valido.");
                }

                // Verifica password
                if (password.trim() === "") {
                    hasErrors = true;
                    $("#invalid-password").text("La password è obbligatoria.");
                } else if (!passwordRegex.test(password)) {
                    hasErrors = true;
                    $("#invalid-password").text(
                        "La password deve contenere almeno 8 caratteri, almeno una cifra e almeno un carattere speciale."
                        );
                }

                // Verifica conferma password
                if (confirmPassword.trim() === "") {
                    hasErrors = true;
                    $("#invalid-password-confirmation").text("La conferma password è obbligatoria.");
                } else if (password !== confirmPassword) {
                    hasErrors = true;
                    $("#invalid-password-confirmation").text("Le password non coincidono.");
                }

                // Se ci sono errori, blocca l'invio e focalizza il primo campo con errore
                if (hasErrors) {
                    event.preventDefault();
                    console.log("Validazione fallita - invio bloccato");
                    $(".invalid-input").filter(function() {
                        return $(this).text() !== "";
                    }).first().prev().focus();
                    return;
                }

                // Controllo email duplicata via AJAX
                event.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: '/ajaxUser',
                    data: {
                        email: email.trim()
                    },
                    success: function(data) {
                        if (data.found) {
                            $("#invalid-email").text("Questa email è già registrata.");
                            $("#email").focus();
                        } else {
                            $("#register-form")[0].submit();
                        }
                    },
                    error: function() {
                        // Se AJAX fallisce, invia comunque il form (fallback lato server)
                        $("#register-form")[0].submit();
                    }
                });
            });
        });
    </script>

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
                                        <ul class="mb-0 mt-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form id="register-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Nome completo</label>
                                <input type="text" name="name" id="name"
                                    class="form-control form-control-lg border-0 shadow-sm rounded-3 @error('name') is-invalid @enderror"
                                    placeholder="Inserisci il tuo nome completo" value="{{ old('name') }}">
                                <span class="invalid-input text-danger" id="invalid-name"></span>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-control form-control-lg border-0 shadow-sm rounded-3 @error('email') is-invalid @enderror"
                                    placeholder="Inserisci la tua email" value="{{ old('email') }}">
                                <span class="invalid-input text-danger" id="invalid-email"></span>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control form-control-lg border-0 shadow-sm rounded-3 @error('password') is-invalid @enderror"
                                    placeholder="Crea una password sicura">
                                <span class="invalid-input text-danger" id="invalid-password"></span>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Conferma Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control form-control-lg border-0 shadow-sm rounded-3"
                                    placeholder="Reinserisci la password">
                                <span class="invalid-input text-danger" id="invalid-password-confirmation"></span>
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
