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

    <!-- Chi siamo -->
    <section>
        <div class="container py-5 text-center">
            <h1 class="section-title">Chi siamo</h1>
            
            <h1 class="main-text"><strong>Atelier Europeo</strong> è un'associazione <i>senza scopo di lucro</i> nata il <strong>9 maggio 2013</strong>, con l'obiettivo
                di promuovere la cittadinanza europea attiva e avvicinare i giovani e le realtà locali alle opportunità
                offerte dall'Unione Europea.
            </h1>

            <div class="card-group pt-5">
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

            <div class="container py-5">
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
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <i class="bi bi-quote display-4 mb-3"></i>
                                    <p class="card-text mb-3">{{ $testimonial->content }}</p>
                                    <div class="border-top pt-3">
                                        <h6 class="fw-bold mb-1">{{ $testimonial->author->name }}</h6>
                                        <small class="text-muted">{{ $testimonial->project->title }}</small>
                                    </div>
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
