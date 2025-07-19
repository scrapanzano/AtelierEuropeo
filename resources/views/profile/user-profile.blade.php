@extends('layouts.master')

@section('title', 'AE - Il Mio Profilo')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Il Mio Profilo
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center mb-3">
                <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                    <i class="bi bi-person-fill fs-2"></i>
                </div>
                <div>
                    <h1 class="h2 mb-1">{{ $user->name }}</h1>
                    <p class="text-muted mb-0">
                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                    </p>
                    <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }} mt-1">
                        {{ $user->role === 'admin' ? 'Amministratore' : 'Utente Registrato' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert per messaggi di sessione -->
    @if(session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Perfetto!</strong> Il profilo è stato aggiornato con successo.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-shield-check me-2"></i>
            <strong>Perfetto!</strong> La password è stata aggiornata con successo.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Sezione Utente Non Admin -->
        @if($user->role !== 'admin')
            <div class="col-lg-8">
                <!-- Le Mie Candidature -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="bi bi-file-earmark-text me-2"></i>Le Mie Candidature
                        </h5>
                        <a href="{{ route('applications.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-eye me-1"></i>Vedi tutte
                        </a>
                    </div>
                    <div class="card-body">
                        @php
                            $recentApplications = $user->applications()->with('project')->latest()->take(3)->get();
                        @endphp
                        
                        @if($recentApplications->count() > 0)
                            @foreach($recentApplications as $application)
                                <div class="border-bottom pb-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $application->project->title }}</h6>
                                            <p class="text-muted small mb-1">
                                                <i class="bi bi-calendar me-1"></i>
                                                {{ $application->created_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <span class="badge bg-{{ $application->status === 'approved' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'warning') }}">
                                            {{ $application->status === 'approved' ? 'Approvata' : ($application->status === 'rejected' ? 'Rifiutata' : 'In Attesa') }}
                                        </span>
                                    </div>
                                    <a href="{{ route('applications.show', $application) }}" class="btn btn-outline-secondary btn-xs">
                                        <i class="bi bi-eye me-1"></i>Dettagli
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox display-4 text-muted"></i>
                                <p class="text-muted mt-2">Non hai ancora inviato candidature.</p>
                                <a href="{{ route('project.index') }}" class="btn btn-primary">
                                    <i class="bi bi-search me-1"></i>Esplora i progetti
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Sezione Admin -->
            <div class="col-lg-8">
                <!-- Dashboard Admin -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-speedometer2 me-2"></i>Dashboard Amministratore
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="card-title">Progetti Attivi</h6>
                                                <h3 class="mb-0">{{ \App\Models\Project::where('status', 'published')->count() }}</h3>
                                            </div>
                                            <i class="bi bi-folder-open fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('project.index') }}" class="text-white text-decoration-none">
                                            <i class="bi bi-arrow-right me-1"></i>Gestisci progetti
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h6 class="card-title">Candidature Totali</h6>
                                                <h3 class="mb-0">{{ \App\Models\Application::count() }}</h3>
                                            </div>
                                            <i class="bi bi-people fs-1"></i>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <span class="text-white">
                                            <i class="bi bi-info-circle me-1"></i>Tutte le candidature
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="mt-4">
                            <h6>Azioni Rapide</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('project.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i>Nuovo Progetto
                                </a>
                                <a href="{{ route('project.index') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-list me-1"></i>Gestisci Progetti
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Sidebar Destra -->
        <div class="col-lg-4">
            <!-- Informazioni Profilo -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>Impostazioni Profilo
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Form Aggiorna Informazioni -->
                    <form method="post" action="{{ route('profile.update') }}" class="mb-4">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bi bi-check-circle me-1"></i>Aggiorna Profilo
                        </button>
                    </form>

                    <hr>

                    <!-- Form Cambia Password -->
                    <form method="post" action="{{ route('password.update') }}" class="mb-4">
                        @csrf
                        @method('put')

                        <h6 class="mb-3">Cambia Password</h6>

                        <div class="mb-3">
                            <label for="update_password_current_password" class="form-label">Password Attuale</label>
                            <input type="password" class="form-control" id="update_password_current_password" 
                                   name="current_password" required>
                            @error('current_password', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password" class="form-label">Nuova Password</label>
                            <input type="password" class="form-control" id="update_password_password" 
                                   name="password" required>
                            @error('password', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password_confirmation" class="form-label">Conferma Password</label>
                            <input type="password" class="form-control" id="update_password_password_confirmation" 
                                   name="password_confirmation" required>
                            @error('password_confirmation', 'updatePassword')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="bi bi-key me-1"></i>Aggiorna Password
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistiche Utente -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-bar-chart me-2"></i>Le Tue Statistiche
                    </h5>
                </div>
                <div class="card-body">
                    @if($user->role !== 'admin')
                        <div class="row text-center">
                            <div class="col-6">
                                <h4 class="text-primary">{{ $user->applications()->count() }}</h4>
                                <small class="text-muted">Candidature</small>
                            </div>
                            <div class="col-6">
                                <h4 class="text-success">{{ $user->applications()->where('status', 'approved')->count() }}</h4>
                                <small class="text-muted">Approvate</small>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center">
                            <small class="text-muted">
                                <i class="bi bi-calendar me-1"></i>
                                Membro dal {{ $user->created_at->format('F Y') }}
                            </small>
                        </div>
                    @else
                        <div class="row text-center">
                            <div class="col-6">
                                <h4 class="text-primary">{{ \App\Models\Project::count() }}</h4>
                                <small class="text-muted">Progetti</small>
                            </div>
                            <div class="col-6">
                                <h4 class="text-success">{{ \App\Models\User::where('role', 'registered_user')->count() }}</h4>
                                <small class="text-muted">Utenti</small>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 80px;
    height: 80px;
}

.btn-xs {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>
@endsection
