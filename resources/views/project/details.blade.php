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
            style="background-image: url('{{ asset('img/progetti/elf-start.png') }}'); min-height: 220px;">
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
                    @if (auth()->user()->role === 'project_admin')
                        {{-- Admin: pulsante per modificare il progetto --}}
                        <a href="{{ route('project.edit', ['id' => $project->id]) }}" class="btn btn-outline-primary btn-rounded d-inline-flex align-items-center px-3 py-2">
                            <i class="bi bi-pen me-2"></i> Modifica
                        </a>
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
            @if (auth()->check() && auth()->user()->role === 'project_admin')
                {{-- Informazione status solo per admin --}}
                <li class="mb-2 d-flex align-items-center flex-wrap">
                    <i class="bi bi-info-circle-fill me-2"></i> 
                    <span>Status: 
                        @php
                            $statusColors = [
                                'draft' => 'text-secondary',
                                'published' => 'text-success',
                                'archived' => 'text-danger',
                            ];
                            $statusLabels = [
                                'draft' => 'Bozza',
                                'published' => 'Pubblicato',
                                'archived' => 'Chiuso',
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
        <div class="container text-center">
            @if (auth()->check() && auth()->user()->role === 'project_admin')
                {{-- Sezione per amministratori --}}
                <h1 class="fw-bold py-3 fs-3 fs-md-2">Gestisci questo progetto</h1>
                <p class="lead mb-4">Visualizza e gestisci le candidature ricevute per questo progetto.</p>
                <button class="btn btn-success btn-lg btn-rounded px-4 py-2">
                    <i class="bi bi-people-fill me-2"></i> Gestisci Candidature
                </button>
            @else
                {{-- Sezione per utenti normali --}}
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

{{-- Script per gestire i preferiti --}}
<script>
function addToFavorites(projectId) {
    // TODO: Implementare la logica per aggiungere ai preferiti
    console.log('Aggiungere il progetto ' + projectId + ' ai preferiti dalla pagina dettagli');
    
    // Placeholder: qui puoi implementare la chiamata AJAX per salvare il preferito
    // Esempio:
    // fetch('/favorites/' + projectId, {
    //     method: 'POST',
    //     headers: {
    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //         'Content-Type': 'application/json',
    //     },
    //     body: JSON.stringify({project_id: projectId})
    // })
    // .then(response => response.json())
    // .then(data => {
    //     // Gestire la risposta (cambiare icona, mostrare messaggio, etc.)
    // });
}
</script>
