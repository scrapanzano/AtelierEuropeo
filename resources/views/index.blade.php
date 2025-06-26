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
                            @if (auth()->user()->role === 'project_admin')
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
            
            <div class="text-center">
                <a href="{{ route('project.index') }}" class="btn btn-lg btn-primary btn-rounded">Vedi tutti i progetti</a>
            </div>
        </div>
    </section>

    <!-- Testimonianze -->
    <section class="bg-light">
        <div class="container py-5">
            <h1 class="section-title">Viviamo.<br>Raccontiamo.</h1>
            <h1 class="section-subtitle">Le testimonianze di chi ha vissuto l'Europa con Atelier Europeo.</h1>
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
