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
            <div class="text-center mb-5">
                <h1 class="section-title">Scopri.<br>Partecipa.</h1>
                <h1 class="section-subtitle">Vivi nuove esperienze ed entra nel cuore dell'Europa.</h1>
            </div>
            
            <!-- CTA Cards responsive -->
            <div class="row g-4">
                <!-- Corpo Europeo di Solidarietà -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-3">
                                <i class="bi bi-heart-fill text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Corpo Europeo di Solidarietà</h5>
                            <p class="card-text flex-grow-1 mb-4">
                                Dedica fino a 12 mesi al volontariato in Europa. Aiuta le comunità, sviluppa competenze e vivi un'esperienza che cambierà la tua vita.
                            </p>
                            <a href="{{ route('corpo-europeo') }}" class="btn btn-success btn-rounded px-4">
                                <i class="bi bi-arrow-right me-2"></i>Scopri di più
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Scambi Giovanili -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-3">
                                <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Scambi Giovanili</h5>
                            <p class="card-text flex-grow-1 mb-4">
                                Partecipa a progetti internazionali con giovani da tutta Europa. Condividi culture, crea legami e scopri nuove prospettive.
                            </p>
                            <a href="{{ route('scambi-giovanili') }}" class="btn btn-primary btn-rounded px-4">
                                <i class="bi bi-arrow-right me-2"></i>Scopri di più
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Corsi di Formazione -->
                <div class="col-12 col-md-12 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-3">
                                <i class="bi bi-mortarboard-fill text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title fw-bold mb-3">Corsi di Formazione</h5>
                            <p class="card-text flex-grow-1 mb-4">
                                Acquisisci nuove competenze attraverso corsi specializzati. Formazione professionale e personale per il tuo futuro in Europa.
                            </p>
                            <a href="{{ route('corsi-formazione') }}" class="btn btn-warning btn-rounded px-4">
                                <i class="bi bi-arrow-right me-2"></i>Scopri di più
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
                <!-- Griglia per schermi grandi (lg e superiori) -->
                <div class="d-none d-lg-block">
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
                </div>

                <!-- Carosello per schermi piccoli (md e inferiori) -->
                <div class="d-lg-none mb-5" style="height: 450px;">
                    <div id="testimonialsCarousel" class="carousel carousel-dark slide slide h-100" data-bs-ride="carousel">
                        <!-- Indicatori sopra il carosello -->
                        @if($randomTestimonials->count() > 1)
                            <div class="carousel-indicators">
                                @foreach($randomTestimonials as $index => $testimonial)
                                    <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="{{ $index === 0 ? 'active' : '' }}" 
                                            aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                                            aria-label="Testimonianza {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                        
                        <div class="carousel-inner h-100">
                            @foreach($randomTestimonials as $index => $testimonial)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }} h-100">
                                    <div class="d-flex justify-content-center align-items-center h-100">
                                        <div class="col-10 col-md-8">
                                            <div class="card border-0 h-100 d-flex flex-column" style="background-color: transparent !important;">
                                                <a href="{{ route('project.show', ['project' => $testimonial->project->id]) }}" class="stretched-link"></a>
                                                <div class="card-header border-0 text-center flex-shrink-0" style="background-color: transparent !important;">
                                                    <i class="bi bi-quote" style="font-size: 1.4rem;"></i>
                                                </div>
                                                <div class="card-body border-0 text-center p-4 d-flex flex-column justify-content-center flex-grow-1">
                                                    <p class="lead fw-bold mb-3">{{ $testimonial->content }}</p>
                                                </div>
                                                <div class="card-footer border-0 text-center pt-3 flex-shrink-0" style="background-color: transparent !important;">
                                                    <h6 class="fw-bold mb-1">{{ $testimonial->author->name }}</h6>
                                                    <small class="opacity-75">{{ $testimonial->project->title }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            
            
            <div class="text-center">
                <a href="{{ route('project.portfolio') }}" class="btn btn-lg btn-outline-primary btn-rounded">
                    <i class="bi bi-chat-quote me-2"></i>Leggi tutte le testimonianze
                </a>
            </div>
        </div>
    </section>
@endsection
