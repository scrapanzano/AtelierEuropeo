@extends('layouts.master')

@section('title', 'Atelier Europeo - Corpo Europeo di Solidarietà')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Viaggiare all'estero
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Corpo Europeo di Solidarietà
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
<div class="container py-5">
    <!-- Header della pagina -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">Corpo Europeo di Solidarietà</h1>
            <p class="lead text-muted">
                Un'opportunità unica per i giovani di contribuire alla solidarietà europea 
                attraverso progetti di volontariato, tirocinio e lavoro in tutta Europa.
            </p>
        </div>
    </div>

    <!-- Sezione Cos'è -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-info-circle me-2"></i>Cos'è il Corpo Europeo di Solidarietà
            </h2>
            <p class="text-muted mb-4">
                Il Corpo Europeo di Solidarietà (ESC) è un programma che offre a giovani di età compresa 
                tra i 18 e i 30 anni l'opportunità di partecipare a progetti di <strong>volontariato, 
                tirocinio e lavoro</strong> in Europa, per periodi che vanno da <strong>2 settimane 
                a 1 anno</strong>. Atelier Europeo è un'organizzazione di invio accreditata che 
                supporta i giovani in questo percorso di crescita personale e professionale.
            </p>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-gear-fill me-2"></i>Settori di intervento
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-people-fill text-primary me-3 fs-4"></i>
                                <span>Assistenza a richiedenti asilo</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-heart-fill text-danger me-3 fs-4"></i>
                                <span>Settore sociale</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-palette-fill text-warning me-3 fs-4"></i>
                                <span>Arte e cultura</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-tree-fill text-success me-3 fs-4"></i>
                                <span>Ambiente</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book-fill text-info me-3 fs-4"></i>
                                <span>Educazione</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-heart-pulse-fill text-danger me-3 fs-4"></i>
                                <span>Salute</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Chi può partecipare -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-person-check-fill me-2"></i>Chi può partecipare
            </h2>
            <div class="list-group">
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-calendar-event text-primary me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Età</h6>
                        <small class="text-muted">Iscrizione a partire dai 17 anni, ma è necessario averne 18 per iniziare. Età massima 30 anni.</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-gear text-success me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Competenze specifiche</h6>
                        <small class="text-muted">Non sono richieste competenze particolari, salvo eccezioni specifiche del progetto (es. patente, genere specifico).</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-heart text-danger me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Motivazione</h6>
                        <small class="text-muted">Forte desiderio di contribuire alla solidarietà europea e crescere personalmente.</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-primary bg-opacity-10 p-4 rounded-4 h-100 d-flex align-items-center">
                <div class="text-center w-100">
                    <i class="bi bi-globe-europe-africa text-primary" style="font-size: 4rem;"></i>
                    <h4 class="text-primary mt-3 mb-2">Un'esperienza che cambia la vita</h4>
                    <p class="text-muted mb-0">
                        Contribuisci a progetti di solidarietà mentre sviluppi competenze 
                        personali e professionali in un contesto internazionale.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Cosa copre il programma -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>Cosa copre il programma
            </h2>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-airplane text-primary me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Viaggio</h6>
                                <small class="text-muted">Spese di viaggio coperte con massimale in base alla distanza</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-house text-success me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Vitto e alloggio</h6>
                                <small class="text-muted">Sistemazione e pasti completamente coperti</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-shield-check text-info me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Assicurazione</h6>
                                <small class="text-muted">Copertura assicurativa completa per tutta la durata</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="list-group">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-currency-euro text-warning me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Pocket Money</h6>
                                <small class="text-muted">Supporto economico mensile variabile in base al paese di destinazione</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-calendar-check text-primary me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Attività</h6>
                                <small class="text-muted">Tutte le attività del progetto e la formazione incluse</small>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="bi bi-translate text-info me-3 fs-5"></i>
                            <div>
                                <h6 class="mb-1">Supporto linguistico</h6>
                                <small class="text-muted">Accesso gratuito alla piattaforma OLS (Online Linguistic Support)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Come candidarsi -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-list-ol me-2"></i>Come candidarsi
            </h2>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Informarsi
                        </div>
                        Contattare Atelier Europeo per ricevere informazioni dettagliate sui progetti disponibili e sui requisiti specifici.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-file-earmark-text text-success me-2"></i>
                            Preparare il CV
                        </div>
                        Creare un CV in formato Europass in lingua inglese, evidenziando le proprie competenze ed esperienze.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-person-plus text-info me-2"></i>
                            Iscriversi
                        </div>
                        Registrarsi sul portale ufficiale del Corpo Europeo di Solidarietà per creare il proprio profilo.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-send text-warning me-2"></i>
                            Candidarsi
                        </div>
                        Inviare la propria candidatura ai progetti di interesse tramite il supporto di Atelier Europeo.
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row">
        <div class="col-12">
            <div class="bg-primary text-white p-5 rounded-4 text-center">
                <h3 class="fw-bold mb-3">Pronto a fare la differenza?</h3>
                <p class="lead mb-4">
                    Unisciti al Corpo Europeo di Solidarietà e vivi un'esperienza che arricchirà 
                    la tua vita personale e professionale, contribuendo al contempo a costruire 
                    un'Europa più solidale e inclusiva.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-envelope me-2"></i>Contattaci per informazioni
                    </a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-info-circle me-2"></i>Scopri Atelier Europeo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
