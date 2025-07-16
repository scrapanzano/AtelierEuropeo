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
            <div class="col-12">
                <h3 class="fw-bold mb-0 fs-2 fs-lg-1 text-center">Progetti Completati</h3>
                <p class="text-center text-muted">Esplora i progetti che hanno già lasciato il segno</p>
            </div>
        </div>

        @if($completedProjects->count() > 0)
            <!-- Container principale: griglia responsive -->
            <div class="row g-4">
                @foreach ($completedProjects as $project)
                    <div class="col-12 col-md-6 col-lg-4">
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

        <!-- Call to action -->
        <div class="text-center mt-5 pt-5">
            <div class="bg-light rounded-4 p-4 p-md-5">
                <h3 class="fw-bold mb-3">Vuoi essere il prossimo?</h3>
                <p class="text-muted mb-4">Unisciti ai nostri progetti e vivi un'esperienza unica che cambierà la tua vita.</p>
                <a href="{{ route('project.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-rocket-takeoff me-2"></i>Scopri i Progetti Disponibili
                </a>
            </div>
        </div>
    </div>

@endsection
