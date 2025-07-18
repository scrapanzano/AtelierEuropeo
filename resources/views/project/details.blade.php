@extends('layouts.master')

@section('title', 'AE - Project Details')

@section('active_progetti', 'active')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                @php
                    $projectCategory = [
                        'ESC' => 'Corpo Europeo di Solidarietà',
                        'YTH' => 'Scambi Giovanili',
                        'TRG' => 'Corsi di Formazione',
                    ];

                    $category = $project->category;
                    $breadcrumbCategory = $projectCategory[$category->tag];
                @endphp
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">Progetti
                        Disponibili</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">
                        {{ $breadcrumbCategory }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
    <div class="container px-2 px-md-4 pb-5">
        <div class="hero-section d-flex align-items-center justify-content-center mb-4 px-2"
            style="background-image: url('{{ $project->image_url }}'); min-height: 220px;">
            <div class="hero-overlay"></div>
            <div class="container position-relative text-center text-white py-4 py-md-5">
                <h1 class="section-title">{{ $project->title }}</h1>
            </div>
        </div>
        <div class="row py-2 py-md-3 mb-3 g-2 align-items-center">
            <div class="col-8 col-md-6">
                <h3 class="fw-bold mb-0 fs-4 fs-md-3">Informazioni essenziali</h3>
            </div>
            <div class="col-4 col-md-6 text-end">
                @if (auth()->check())
                    @if (auth()->user()->role === 'admin')
                        {{-- Admin: pulsante per modificare il progetto --}}
                        @if($project->status === 'completed')
                            <span class="btn btn-outline-secondary btn-rounded d-inline-flex align-items-center px-3 py-2" disabled>
                                <i class="bi bi-check-circle me-2"></i> Completato
                            </span>
                        @else
                            <a href="{{ route('project.edit', ['id' => $project->id]) }}" class="btn btn-outline-primary btn-rounded d-inline-flex align-items-center px-3 py-2">
                                <i class="bi bi-pen me-2"></i> Modifica
                            </a>
                        @endif
                    @else
                        {{-- Utente registrato: pulsante salva nei preferiti --}}
                        <button type="button" class="btn btn-outline-primary btn-rounded d-inline-flex align-items-center px-3 py-2" onclick="addToFavorites({{ $project->id }})">
                            <i class="bi bi-heart me-2 fs-4"></i> Salva
                        </button>
                    @endif
                @else
                    {{-- Utente non loggato: mostra modal per autenticazione --}}
                    <button type="button" class="btn btn-outline-primary btn-rounded d-inline-flex align-items-center px-3 py-2" data-bs-toggle="modal" data-bs-target="#authModalDetail">
                        <i class="bi bi-heart me-2"></i> Salva
                    </button>
                    
                    {{-- Modal per l'autenticazione --}}
                    <div class="modal fade" id="authModalDetail" tabindex="-1" aria-labelledby="authModalDetailLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="authModalDetailLabel">Accedi per salvare nei preferiti</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p>Per salvare questo progetto nei tuoi preferiti, devi prima accedere al tuo account.</p>
                                    <p>Se non hai un account, puoi registrarti gratuitamente.</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Accedi</a>
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrati</a>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <ul class="list-unstyled mb-4">
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-person-fill me-2"></i> <span>{{
                    $project->requested_people }} persona/e</span></li>
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-geo-alt-fill me-2"></i> <span>{{
                    $project->location }}</span></li>
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-calendar-event-fill me-2"></i> <span>Da
                    {{ $project->start_date }} a {{ $project->end_date }}</span></li>
            <li class="mb-2 text-danger d-flex align-items-center flex-wrap"><i class="bi bi-calendar2-x-fill me-2"></i> <span>Scadenza:
                    {{ $project->expire_date }}</span></li>
            @if (auth()->check() && auth()->user()->role === 'admin')
                {{-- Informazione status solo per admin --}}
                <li class="mb-2 d-flex align-items-center flex-wrap">
                    <i class="bi bi-info-circle-fill me-2"></i> 
                    <span>Status: 
                        @php
                            $statusColors = [
                                'draft' => 'text-secondary',
                                'published' => 'text-success',
                                'completed' => 'text-danger',
                            ];
                            $statusLabels = [
                                'draft' => 'Bozza',
                                'published' => 'Pubblicato',
                                'completed' => 'Completato',
                            ];
                            $statusColor = $statusColors[$project->status] ?? 'text-dark';
                            $statusLabel = $statusLabels[$project->status] ?? $project->status;
                        @endphp
                        <span class="{{ $statusColor }} fw-bold">{{ $statusLabel }}</span>
                    </span>
                </li>
            @endif
        </ul>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Chi è l'associazione {{ $project->association->name }}</h3>
        <p class="lead">{{ $project->association->description}}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Il viaggio in pillole</h3>
        <p class="lead">{{ $project->full_description }}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Requisiti di partecipazione</h3>
        <p class="lead">{{ $project->requirements }}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Condizioni economiche e di viaggio</h3>
        <p class="lead">{{ $project->travel_conditions }}</p>
        
        {{-- Sezione testimonianze per progetti completati --}}
        @if($project->status === 'completed')
            <h3 class="fw-bold py-3 fs-4 fs-md-3">
                <i class="bi bi-chat-quote me-2"></i>Testimonianze
            </h3>
            @if($project->testimonial && $project->testimonial->count() > 0)
                <div class="row g-4 mb-4">
                    @foreach($project->testimonial as $testimonial)
                        <div class="col-12 col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                            <i class="bi bi-person text-white fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $testimonial->author->name }}</h6>
                                            <small class="text-muted">Partecipante</small>
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $testimonial->content }}</p>
                                    <div class="text-end">
                                        <i class="bi bi-quote text-primary fs-3"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    Non sono ancora disponibili testimonianze per questo progetto completato.
                </div>
            @endif
        @endif

        <div class="container text-center">
            @if($project->status === 'completed')
                {{-- Sezione per progetti completati --}}
                <h1 class="fw-bold py-3 fs-3 fs-md-2">Progetto Completato</h1>
                <p class="lead mb-4">Questo progetto è stato completato con successo. Scopri altri progetti disponibili o lasciati ispirare dalle testimonianze!</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    <a href="{{ route('project.index') }}" class="btn btn-primary btn-lg btn-rounded px-4 py-2">
                        <i class="bi bi-search me-2"></i> Scopri Altri Progetti
                    </a>
                    <a href="{{ route('project.portfolio') }}" class="btn btn-outline-primary btn-lg btn-rounded px-4 py-2">
                        <i class="bi bi-collection me-2"></i> Vedi Portfolio
                    </a>
                </div>
            @elseif (auth()->check() && auth()->user()->role === 'admin')
                {{-- Sezione per amministratori --}}
                <h1 class="fw-bold py-3 fs-3 fs-md-2">Gestisci questo progetto</h1>
                <p class="lead mb-4">Visualizza e gestisci le candidature ricevute per questo progetto.</p>
                <button class="btn btn-success btn-lg btn-rounded px-4 py-2">
                    <i class="bi bi-people-fill me-2"></i> Gestisci Candidature
                </button>
            @else
                {{-- Sezione per utenti normali con progetti attivi --}}
                <h1 class="fw-bold py-3 fs-3 fs-md-2">Presenta la tua candidatura!</h1>
                @if (auth()->check())
                    {{-- Utente registrato: pulsante per candidarsi --}}
                    <button class="btn btn-primary btn-lg btn-rounded px-4 py-2">
                        <i class="bi bi-bookmark-plus-fill me-2"></i> Candidati
                    </button>
                @else
                    {{-- Utente non loggato: mostra modal per autenticazione --}}
                    <button class="btn btn-primary btn-lg btn-rounded px-4 py-2" data-bs-toggle="modal" data-bs-target="#authModalApply">
                        <i class="bi bi-bookmark-plus-fill me-2"></i> Candidati
                    </button>
                    
                    {{-- Modal per l'autenticazione candidatura --}}
                    <div class="modal fade" id="authModalApply" tabindex="-1" aria-labelledby="authModalApplyLabel">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="authModalApplyLabel">Accedi per candidarti</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <p>Per candidarti a questo progetto, devi prima accedere al tuo account.</p>
                                    <p>Se non hai un account, puoi registrarti gratuitamente e iniziare subito a esplorare le opportunità europee!</p>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('login') }}" class="btn btn-primary">Accedi</a>
                                    <a href="{{ route('register') }}" class="btn btn-secondary">Registrati</a>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Chiudi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection


