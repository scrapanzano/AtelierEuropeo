@extends('layouts.master')

@section('title', 'AE - Chi siamo')

@section('active_chi-siamo', 'active')

@section('breadcrumb')
<div class="bg-light py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Chi siamo</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('body')
    <div class="container py-5">
        <!-- Header della pagina -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="section-title fw-bold text-center">Chi siamo</h1>
            </div>
        </div>

        <!-- La nostra storia -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="h-100">
                    <h3 class="fw-bold mb-3 fs-2 fs-lg-1">La nostra storia</h3>
                    <p class="lead">
                        Atelier Europeo nasce il <strong>9 maggio 2013</strong>, in occasione della
                        <strong>Festa d'Europa</strong>, da un'idea condivisa e visionaria di cinque enti
                        di secondo livello del territorio bresciano.
                    </p>
                    <p class="lead">
                        I nostri soci fondatori rappresentano una rete capillare di circa <strong>3.000 realtà
                            bresciane</strong> e almeno <strong>300.000 cittadini</strong>, includendo
                        realtà di prestigio come il Forum Provinciale del Terzo Settore di Brescia,
                        il CSV Brescia e il Patronato San Vincenzo.
                    </p>
                    <p class="lead">
                        Questa data simbolica sottolinea fin dalla nascita il nostro profondo legame
                        con i valori europei e l'impegno nella costruzione di un futuro comune.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="w-100">
                    <img src="{{ asset('img/hero-background.jpg') }}" alt="" class="img-fluid rounded-4 shadow-sm">
                </div>
            </div>
        </div>

        <!-- Missione e Valori -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="fw-bold mb-3 fs-2 fs-lg-1">Missione e Valori</h3>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-heart text-danger" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 mb-3">Finalità Sociali</h5>
                                <p class="text-muted">
                                    Siamo un'associazione <strong>senza scopo di lucro e apartitica</strong>
                                    che persegue esclusivamente finalità di carattere sociale per il bene
                                    della comunità.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-people text-success" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 mb-3">Partecipazione Attiva</h5>
                                <p class="text-muted">
                                    Promuoviamo la partecipazione delle associazioni bresciane e lombarde
                                    alle <strong>opportunità offerte dall'Unione Europea</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body text-center p-4">
                                <i class="bi bi-globe-europe-africa" style="font-size: 3rem; color: #1a2442;"></i>
                                <h5 class="mt-3 mb-3">Cittadinanza Europea</h5>
                                <p class="text-muted">
                                    Diffondiamo e incentiviamo la partecipazione ai programmi UE per
                                    favorire la creazione di una <strong>cittadinanza europea consapevole</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Il nostro Consiglio Direttivo -->
        <div class="row mb-5">
            <div class="col-12">
                <h3 class="fw-bold mb-3 fs-2 fs-lg-1">Il nostro Consiglio Direttivo</h3>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-person-badge text-primary fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Giovanni Vezzoni</h5>
                                <p class="text-primary fw-semibold mb-0">Presidente</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-person text-success fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Dante Mantovani</h5>
                                <p class="text-success fw-semibold mb-0">Consigliere</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-person text-success fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Don Marco Perrucchini</h5>
                                <p class="text-success fw-semibold mb-0">Consigliere</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-success bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-person text-success fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Renzo Fracassi</h5>
                                <p class="text-success fw-semibold mb-0">Consigliere</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-warning bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-calculator text-warning fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Francesco Piovani</h5>
                                <p class="text-warning fw-semibold mb-0">Revisore Unico</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card border-0 shadow-sm text-center h-100">
                            <div class="card-body p-4">
                                <div class="bg-info bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-pen text-info fs-2"></i>
                                </div>
                                <h5 class="fw-bold">Francesca Fiini</h5>
                                <p class="text-info fw-semibold mb-0">Segretario</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trasparenza -->
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <h3 class="fw-bold mb-3 fs-2 fs-lg-1">
                    <i class="bi bi-shield-check me-2"></i>Trasparenza
                </h3>
                <p class="text-muted mb-4">
                    La trasparenza è uno dei nostri valori fondamentali. Per questo motivo,
                    mettiamo a disposizione di tutti i cittadini i nostri documenti ufficiali,
                    garantendo piena visibilità sulle nostre attività e sulla gestione delle risorse.
                </p>
                <div class="list-group">
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-file-earmark-text text-primary me-3 fs-5"></i>
                        <div>
                            <h6 class="mb-1">Atto Costitutivo e Statuto</h6>
                            <small class="text-muted">Documenti fondativi dell'associazione</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-graph-up text-success me-3 fs-5"></i>
                        <div>
                            <h6 class="mb-1">Bilancio di Missione 2018</h6>
                            <small class="text-muted">Rendiconto delle attività e risultati</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-graph-up text-success me-3 fs-5"></i>
                        <div>
                            <h6 class="mb-1">Bilancio di Missione 2016</h6>
                            <small class="text-muted">Rendiconto delle attività e risultati</small>
                        </div>
                    </div>
                    <div class="list-group-item d-flex align-items-center">
                        <i class="bi bi-shield-lock text-info me-3 fs-5"></i>
                        <div>
                            <h6 class="mb-1">Privacy e Cookie Policy</h6>
                            <small class="text-muted">Protezione dei dati personali</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Come aderire -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="bg-light p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="fw-bold mb-3 fs-2 fs-lg-1">Come aderire</h3>
                            <p class="text-muted mb-3">
                                L'adesione ad Atelier Europeo è aperta a tutti gli <strong>enti pubblici e privati</strong>
                                che condividono le nostre finalità e desiderano contribuire alla costruzione
                                di una cittadinanza europea più forte e consapevole.
                            </p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-check-circle text-primary me-2 mt-1"></i>
                                        <div>
                                            <h6 class="mb-1">Procedura semplice</h6>
                                            <small class="text-muted">La domanda va presentata al Consiglio
                                                Direttivo</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="bi bi-people text-primary me-2 mt-1"></i>
                                        <div>
                                            <h6 class="mb-1">Diverse tipologie</h6>
                                            <small class="text-muted">Soci con governance (€20.000) o sostenitori (quote
                                                inferiori)</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <div class="bg-white p-4 rounded-3 shadow-sm">
                                <i class="bi bi-handshake text-primary" style="font-size: 3rem;"></i>
                                <h5 class="mt-3 text-primary">Unisciti a noi</h5>
                                <p class="text-muted small mb-3">
                                    Diventa parte della rete che promuove l'Europa sul territorio
                                </p>
                                <a href="{{ route('contact') }}" class="btn btn-primary">
                                    <i class="bi bi-envelope me-2"></i>Contattaci
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action finale -->
        <div class="row">
            <div class="col-12 text-center">
                <div class="bg-europe text-white p-5 rounded-4 text-center">
                    <h3 class="fw-bold mb-3">Costruiamo insieme il futuro europeo</h3>
                    <p class="lead mb-4">
                        Dal 2013 lavoriamo per avvicinare il territorio alle opportunità europee.
                        Scopri i nostri progetti e partecipa alla costruzione di una cittadinanza europea attiva.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="{{ route('project.index') }}" class="btn btn-light btn-lg">
                            <i class="bi bi-folder-open me-2"></i>Scopri i Progetti
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-telephone me-2"></i>Contattaci
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
