@extends('layouts.master')

@section('title', 'AE - Portfolio Progetti')

@section('active_portfolio', 'active')

@section('body')

    <div class="container py-5">
        <h1 class="section-title fw-bold text-center">Portfolio Progetti</h1>
        <h1 class="section-subtitle text-center">Scopri i progetti completati con le testimonianze di chi li ha vissuti.
            Le storie di successo che dimostrano l'impatto dei nostri programmi europei.
        </h1>
        
        <div class="row mb-4 g-2 align-items-center py-5">
            <div class="col-8 col-md-6">
                <h3 class="fw-bold mb-0 fs-2 fs-lg-1">Portfolio Progetti</h3>
            </div>
        </div>

        @if($completedProjects->count() > 0)
            <!-- Container principale: row-cols per griglia su desktop, flex-nowrap per scroll su mobile -->
            <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4">
                @foreach ($completedProjects as $project)
                    <!-- Card container: dimensioni reattive e flex-shrink-0 per scroll -->
                    <div class="col-6 col-sm-7 col-md-5 col-lg-4 mb-4 flex-shrink-0 flex-lg-shrink-1">
                        <x-project-card 
                            :project="$project" 
                            :showAdminOptions="auth()->check() && auth()->user()->role === 'admin'" 
                            :showFavoriteIcon="false" 
                            :showTestimonials="true" 
                        />
                    </div>
                @endforeach
            </div>
        @else
            <!-- Messaggio se non ci sono progetti completati -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-folder-x display-1 text-muted"></i>
                </div>
                <h3 class="fw-bold text-muted mb-3">Nessun progetto completato</h3>
                <p class="text-muted mb-4">Non ci sono ancora progetti completati con testimonianze da mostrare.</p>
                <a href="{{ route('project.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left me-2"></i>Torna ai Progetti Disponibili
                </a>
            </div>
        @endif
    </div>        
        <!-- Call to action -->
    <div class="container-fluid">
            <div class="text-center bg-light p-4 p-md-5">
                <h3 class="fw-bold mb-3">Vuoi essere il prossimo?</h3>
                <p class="text-muted mb-4">Unisciti ai nostri progetti e vivi un'esperienza unica che cambierà la tua vita.</p>
                <a href="{{ route('project.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-rocket-takeoff me-2"></i>Scopri i Progetti Disponibili
                </a>
            </div>
    </div>

@endsection
