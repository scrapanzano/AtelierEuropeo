@extends('layouts.master')

@section('title', 'Atelier Europeo - Corsi di Formazione')

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
                    Corsi di Formazione
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
            <h1 class="display-4 fw-bold text-primary mb-3">Corsi di Formazione</h1>
            <p class="lead text-muted">
                Opportunità di sviluppo professionale per Youth Workers e operatori giovanili, 
                con focus su metodologie innovative e competenze specialistiche nel settore giovanile.
            </p>
        </div>
    </div>

    <!-- Sezione Cosa sono -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-mortarboard-fill me-2"></i>Cosa sono i Corsi di Formazione
            </h2>
            <p class="text-muted mb-4">
                I <strong>Training Courses</strong> sono percorsi formativi specializzati co-finanziati 
                dal programma <strong>Erasmus+</strong>, progettati specificamente per <strong>Youth Workers</strong> 
                e operatori del settore giovanile. Questi corsi intensivi combinano formazione teorica 
                e pratica per sviluppare competenze avanzate nella gestione di progetti giovanili, 
                metodologie di educazione non formale e leadership nel terzo settore.
            </p>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>Caratteristiche principali
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-3 text-center">
                            <i class="bi bi-calendar-week text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Durata</h6>
                            <p class="text-muted mb-0">3-10 giorni</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-person-workspace text-success" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Target</h6>
                            <p class="text-muted mb-0">Youth Workers</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-tools text-info" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Focus</h6>
                            <p class="text-muted mb-0">Competenze pratiche</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <i class="bi bi-award text-warning" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Certificazione</h6>
                            <p class="text-muted mb-0">YouthPass</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione A chi si rivolgono -->
    <div class="row mb-5">
        <div class="col-lg-8 mb-4">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-people-fill me-2"></i>A chi si rivolgono
            </h2>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-start border-5 border-primary h-100">
                        <div class="card-body">
                            <h6 class="fw-bold text-primary mb-2">
                                <i class="bi bi-person-badge me-2"></i>Youth Workers
                            </h6>
                            <p class="text-muted mb-0 small">
                                Operatori che lavorano direttamente con i giovani in contesti educativi, 
                                associativi o del volontariato
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-5 border-success h-100">
                        <div class="card-body">
                            <h6 class="fw-bold text-success mb-2">
                                <i class="bi bi-building me-2"></i>Operatori del Terzo Settore
                            </h6>
                            <p class="text-muted mb-0 small">
                                Professionisti di ONG, associazioni, cooperative sociali 
                                e organizzazioni giovanili
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-5 border-info h-100">
                        <div class="card-body">
                            <h6 class="fw-bold text-info mb-2">
                                <i class="bi bi-person-raised-hand me-2"></i>Volontari Esperti
                            </h6>
                            <p class="text-muted mb-0 small">
                                Volontari con esperienza significativa nell'ambito 
                                dei progetti giovanili e della mobilità
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-start border-5 border-warning h-100">
                        <div class="card-body">
                            <h6 class="fw-bold text-warning mb-2">
                                <i class="bi bi-mortarboard me-2"></i>Formatori ed Educatori
                            </h6>
                            <p class="text-muted mb-0 small">
                                Professionisti dell'educazione non formale 
                                e della formazione per adulti
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bg-info bg-opacity-10 p-4 rounded-4 h-100 d-flex align-items-center">
                <div class="text-center w-100">
                    <i class="bi bi-lightbulb-fill text-info" style="font-size: 4rem;"></i>
                    <h4 class="text-info mt-3 mb-2">Sviluppo Professionale</h4>
                    <p class="text-muted mb-0">
                        I corsi di formazione rappresentano un investimento 
                        nel tuo futuro professionale nel settore giovanile
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Aree tematiche -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-bookmark-star me-2"></i>Aree tematiche principali
            </h2>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">
                                <i class="bi bi-gear-fill me-2"></i>Metodologie e Strumenti
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Educazione non formale e informale
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Gestione di gruppi e dinamiche di team
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Tecniche di facilitazione e mediazione
                                </li>
                                <li class="mb-0">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Strumenti digitali per l'educazione
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0">
                                <i class="bi bi-heart-fill me-2"></i>Inclusione e Diversity
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-info me-2"></i>
                                    Lavoro con giovani con minori opportunità
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-info me-2"></i>
                                    Interculturalità e gestione delle diversità
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-info me-2"></i>
                                    Prevenzione della discriminazione
                                </li>
                                <li class="mb-0">
                                    <i class="bi bi-check-circle text-info me-2"></i>
                                    Promozione dei diritti umani
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="mb-0">
                                <i class="bi bi-briefcase-fill me-2"></i>Project Management
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-warning me-2"></i>
                                    Progettazione europea (Erasmus+, ESC)
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-warning me-2"></i>
                                    Gestione amministrativa e finanziaria
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-warning me-2"></i>
                                    Monitoraggio e valutazione progetti
                                </li>
                                <li class="mb-0">
                                    <i class="bi bi-check-circle text-warning me-2"></i>
                                    Fundraising e sostenibilità
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-danger text-white">
                            <h6 class="mb-0">
                                <i class="bi bi-graph-up-arrow me-2"></i>Competenze Trasversali
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-danger me-2"></i>
                                    Leadership e gestione del cambiamento
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-danger me-2"></i>
                                    Comunicazione efficace e public speaking
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle text-danger me-2"></i>
                                    Networking e partnership strategiche
                                </li>
                                <li class="mb-0">
                                    <i class="bi bi-check-circle text-danger me-2"></i>
                                    Innovazione sociale e creatività
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Costi -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-currency-euro me-2"></i>Investimento e coperture
            </h2>
            
            <div class="alert alert-success border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-piggy-bank-fill me-3 fs-3"></i>
                    <div>
                        <h5 class="alert-heading mb-2">
                            <strong>Costi minimali per massimo beneficio!</strong>
                        </h5>
                        <p class="mb-0">
                            Erasmus+ copre la maggior parte dei costi, rendendo l'investimento 
                            nella tua formazione professionale molto accessibile.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-md-6">
                    <h6 class="fw-bold text-success mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>Completamente coperto
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-house-door text-primary me-2"></i>
                            Vitto e alloggio per tutta la durata
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-book-half text-primary me-2"></i>
                            Materiali formativi e risorse didattiche
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-shield-plus text-primary me-2"></i>
                            Assicurazione sanitaria completa
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-award text-primary me-2"></i>
                            Certificazione YouthPass finale
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-info mb-3">
                        <i class="bi bi-airplane-fill me-2"></i>Viaggio
                    </h6>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <p class="mb-2">
                            <strong>Rimborso basato sulla distanza:</strong>
                        </p>
                        <ul class="list-unstyled small">
                            <li>• 100-499 km: fino a €180</li>
                            <li>• 500-1999 km: fino a €275</li>
                            <li>• 2000-2999 km: fino a €360</li>
                            <li>• 3000+ km: fino a €530</li>
                        </ul>
                        <small class="text-muted">
                            Percentuale coperta: 70-100% in base alla destinazione
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Come partecipare -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-list-ol me-2"></i>Processo di candidatura
            </h2>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-search text-primary me-2"></i>
                            Identificazione delle opportunità
                        </div>
                        Monitora regolarmente il sito di Atelier Europeo e i social media per rimanere 
                        aggiornato sui Training Courses disponibili per Youth Workers.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-file-text text-success me-2"></i>
                            Preparazione della candidatura
                        </div>
                        CV in formato Europass (inglese), lettera motivazionale specifica per il corso, 
                        portfolio delle esperienze nel settore giovanile (se disponibile).
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-send text-info me-2"></i>
                            Invio della candidatura
                        </div>
                        Invia la candidatura completa rispettando scadenze e requisiti specifici 
                        indicati per ogni Training Course.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-person-video3 text-warning me-2"></i>
                            Selezione e preparazione
                        </div>
                        Possibile colloquio di selezione, briefing pre-partenza e supporto 
                        nella preparazione logistica e contenutistica.
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <!-- Benefici professionali -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-graph-up-arrow me-2"></i>Impatto sulla tua carriera
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-trophy-fill text-warning" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Riconoscimento Professionale</h5>
                            <p class="text-muted">
                                Certificazioni riconosciute a livello europeo 
                                che arricchiscono il tuo profilo professionale.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-people-fill text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Network Professionale</h5>
                            <p class="text-muted">
                                Connessioni con Youth Workers e organizzazioni 
                                da tutta Europa per collaborazioni future.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-lightbulb-fill text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Metodologie Innovative</h5>
                            <p class="text-muted">
                                Strumenti pratici e approcci all'avanguardia 
                                da applicare immediatamente nel tuo lavoro.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row">
        <div class="col-12">
            <div class="bg-primary text-white p-5 rounded-4 text-center">
                <h3 class="fw-bold mb-3">Investi nel tuo futuro professionale</h3>
                <p class="lead mb-4">
                    I Training Courses sono l'opportunità ideale per Youth Workers che vogliono 
                    eccellere nel settore giovanile, acquisendo competenze specialistiche e 
                    costruendo una carriera di impatto sociale.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-briefcase me-2"></i>Candidati ora
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
