@extends('layouts.master')

@section('title', 'Atelier Europeo')

@section('active_home', 'active')

@section('body')
    <!-- Hero -->
    <section style="background-color: #1a2442">
        <div class="container py-5 text-center">
            <h1 class="section-title text-warning">Atelier Europeo</h1>
            <h1 class="section-subtitle text-white" style="opacity: 1;">Opportunità per crescere, viaggiare e imparare.</h1>
        </div>
    </section>

    <!-- Messaggio di successo -->
    @if (session('success'))
        <div class="container py-3">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    <div>
                        <strong>Perfetto!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <!-- Chi siamo -->
    <section>
        <div class="container py-5 text-center">
            <h1 class="section-title">Chi siamo</h1>
            
            <h1 class="main-text"><strong>Atelier Europeo</strong> è un'associazione <i>senza scopo di lucro</i> nata il <strong>9 maggio 2013</strong>, con l'obiettivo
                di promuovere la cittadinanza europea attiva e avvicinare i giovani e le realtà locali alle opportunità
                offerte dall'Unione Europea.
            </h1>

            <div class="card-group mt-3 pt-5">
                <div class="card border-0 shadow-sm me-3">
                    <div class="card-body">
                        <h2 class="card-title text-primary fw-bold">10+</h2>
                        <p class="lead card-text">anni di esperienza</p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm me-3">
                    <div class="card-body">
                        <h2 class="card-title text-primary fw-bold">200+</h2>
                        <p class="lead card-text">progetti realizzati</p>
                    </div>
                </div>
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-primary fw-bold">100+</h2>
                        <p class="lead card-text">partner in tutta Europa</p>
                    </div>
                </div>
            </div>

            <div class="container pt-5">
                <a href="{{ route('about') }}" class="btn btn-lg btn-primary btn-rounded">Scopri chi siamo</a>
            </div>
        </div>
    </section>

    <!-- Attività -->
    <section class="bg-light">
        <div class="container py-5">
            <h1 class="section-title">Scopri.<br>Partecipa.</h1>
            <h1 class="section-subtitle ">Vivi nuove esperienze ed entra nel cuore dell'Europa.</h1>
        </div>
    </section>

    <!-- Progetti disponibili -->
    <section>
        <div class="container py-5">
            <h1 class="section-title">Creiamo.<br>Connettiamo.</h1>
            <h1 class="section-subtitle">Scopri i progetti in evidenza.</h1>
            
            <!-- Container progetti in evidenza con scroll orizzontale -->
            <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4 py-5">
                @forelse ($featuredProjects as $project)
                    <!-- Card container: dimensioni reattive e flex-shrink-0 per scroll -->
                    <div class="col-9 col-sm-7 col-md-5 col-lg-4 mb-4 flex-shrink-0 flex-lg-shrink-1">
                        @if (auth()->check())
                            @if (auth()->user()->role === 'admin')
                                <x-project-card :project="$project" :showAdminOptions="true" :showFavoriteIcon="false" />
                            @else
                                <x-project-card :project="$project" :showAdminOptions="false" :showFavoriteIcon="true" />
                            @endif
                        @else
                            <x-project-card :project="$project" :showAdminOptions="false" :showFavoriteIcon="true" />
                        @endif
                    </div>
                @empty
                    <div class="col-12 text-center py-4">
                        <p class="lead">Nessun progetto disponibile al momento.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="text-center mt-4 mt-md-3">
                <div class="row justify-content-center g-2 g-md-3">
                    <div class="col-12 col-md-auto">
                        <a href="{{ route('project.index') }}" class="btn btn-primary btn-rounded px-3 py-2 w-100">
                            <i class="bi bi-search me-2"></i>Vedi tutti i progetti
                        </a>
                    </div>
                    <div class="col-12 col-md-auto">
                        <a href="{{ route('project.portfolio') }}" class="btn btn-outline-primary btn-rounded px-3 py-2 w-100">
                            <i class="bi bi-collection me-2"></i>Portfolio progetti
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonianze -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h1 class="section-title">Viviamo.<br>Raccontiamo.</h1>
                <h1 class="section-subtitle">Le testimonianze di chi ha vissuto l'Europa con Atelier Europeo.</h1>
            </div>
            

            @if($randomTestimonials && $randomTestimonials->count() > 0)
                <div class="row g-4 mb-5">
                    @foreach($randomTestimonials as $testimonial)
                        <div class="col-12 col-lg-4">
                            <div class="card border-0 h-100" style="background-color: transparent !important;">
                                <a href="{{ route('project.show', ['project' => $testimonial->project->id]) }}" class="stretched-link"></a>
                                <div class="card-header border-0 text-center" style="background-color: transparent !important;">
                                    <i class="bi bi-quote" style="font-size: 1.4rem;"></i>
                                </div>
                                <div class="card-body border-0 text-center p-4">
                                    <p class="lead fw-bold mb-3">{{ $testimonial->content }}</p>
                                </div>
                                <div class="card-footer border-0 text-center pt-3" style="background-color: transparent !important;">
                                        <h6 class="fw-bold mb-1">{{ $testimonial->author->name }}</h6>
                                        <small class="opacity-75">{{ $testimonial->project->title }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            
            
            <div class="text-center">
                <a href="{{ route('project.portfolio') }}" class="btn btn-lg btn-outline-primary btn-rounded">
                    <i class="bi bi-chat-quote me-2"></i>Leggi tutte le testimonianze
                </a>
            </div>
        </div>
    </section>

    <!-- Partner -->
    <section>
        <div class="container py-5 text-center">
            <h1 class="section-title">I nostri partner</h1>
            <h1 class="section-subtitle">Collaboriamo per creare opportunità europee.</h1>
        </div>
    </section>
@endsection
