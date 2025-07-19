@extends('layouts.master')

@section('title', 'Atelier Europeo - Scambi Giovanili')

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
                    Scambi Giovanili
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
            <h1 class="display-4 fw-bold text-primary mb-3">Scambi Giovanili</h1>
            <p class="lead text-muted">
                Esperienze di mobilità internazionale che favoriscono l'incontro tra culture diverse 
                e lo sviluppo di competenze interculturali e linguistiche.
            </p>
        </div>
    </div>

    <!-- Sezione Cosa sono -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-people-fill me-2"></i>Cosa sono gli Scambi Giovanili
            </h2>
            <p class="text-muted mb-4">
                I <strong>Youth Exchanges</strong> sono progetti di mobilità internazionale co-finanziati 
                dal programma <strong>Erasmus+</strong>, rivolti a giovani tra i 13 e i 30 anni. 
                Durante questi incontri, gruppi di giovani provenienti da diversi paesi europei 
                si riuniscono per condividere esperienze culturali, apprendere reciprocamente 
                e migliorare le proprie competenze linguistiche, principalmente in inglese.
            </p>
            
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning-fill me-2"></i>In breve
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            <i class="bi bi-calendar-event text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Durata</h6>
                            <p class="text-muted mb-0">7-10 giorni</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-person-hearts text-success" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Età</h6>
                            <p class="text-muted mb-0">13-30 anni</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="bi bi-globe text-info" style="font-size: 2.5rem;"></i>
                            <h6 class="mt-2 mb-1">Focus</h6>
                            <p class="text-muted mb-0">Cultura e lingue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Requisiti -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-check-square me-2"></i>Requisiti per partecipare
            </h2>
            <div class="list-group">
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-calendar-check text-primary me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Età</h6>
                        <small class="text-muted">Avere tra i 13 e i 30 anni (o più di 30 per il ruolo di team leader)</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-geo-alt text-success me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Residenza</h6>
                        <small class="text-muted">Essere residenti in Italia</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-heart-fill text-danger me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Motivazione</h6>
                        <small class="text-muted">Forte motivazione e interesse per il confronto interculturale</small>
                    </div>
                </div>
                <div class="list-group-item d-flex align-items-center">
                    <i class="bi bi-chat-dots text-info me-3 fs-5"></i>
                    <div>
                        <h6 class="mb-1">Lingua</h6>
                        <small class="text-muted">Disponibilità a comunicare in inglese (livello base sufficiente)</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="bg-success bg-opacity-10 p-4 rounded-4 h-100 d-flex align-items-center">
                <div class="text-center w-100">
                    <i class="bi bi-people-fill text-success" style="font-size: 4rem;"></i>
                    <h4 class="text-success mt-3 mb-2">Inclusività</h4>
                    <p class="text-muted mb-0">
                        Gli scambi giovanili sono aperti a tutti i giovani, 
                        indipendentemente dal background sociale, economico 
                        o educativo. L'importante è la voglia di imparare!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Costi -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-currency-euro me-2"></i>Costi
            </h2>
            
            <div class="alert alert-success border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-gift-fill me-3 fs-3"></i>
                    <div>
                        <h5 class="alert-heading mb-2">
                            <strong>Partecipazione completamente gratuita!</strong>
                        </h5>
                        <p class="mb-0">
                            Il programma Erasmus+ copre interamente tutti i costi, permettendo 
                            a ogni giovane di vivere questa esperienza senza oneri finanziari.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-3">
                <div class="col-md-6">
                    <h6 class="fw-bold text-success mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>Cosa è coperto
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-airplane text-primary me-2"></i>
                            Viaggio (con massimale basato sulla distanza)
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-house text-primary me-2"></i>
                            Vitto e alloggio per tutta la durata
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-calendar-event text-primary me-2"></i>
                            Tutte le attività previste dal programma
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold text-success mb-3">
                        <i class="bi bi-plus-circle-fill me-2"></i>Servizi inclusi
                    </h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="bi bi-shield-check text-primary me-2"></i>
                            Assicurazione sanitaria completa
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-book text-primary me-2"></i>
                            Materiali didattici e risorse
                        </li>
                        <li class="mb-2">
                            <i class="bi bi-award text-primary me-2"></i>
                            Certificato di partecipazione YouthPass
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione Come partecipare -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-list-ol me-2"></i>Come partecipare
            </h2>
            <ol class="list-group list-group-numbered">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-search text-primary me-2"></i>
                            Informarsi
                        </div>
                        Seguire i canali di comunicazione di Atelier Europeo (sito web, social media, newsletter) 
                        per rimanere aggiornati sui progetti disponibili.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-telephone text-success me-2"></i>
                            Contattare
                        </div>
                        Manifestare il proprio interesse contattando Atelier Europeo con anticipo, 
                        specificando le proprie motivazioni e disponibilità.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-file-earmark-person text-info me-2"></i>
                            Preparare il CV
                        </div>
                        Redigere un CV in formato Europass in lingua inglese, evidenziando 
                        esperienze, competenze e motivazioni per la partecipazione.
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold d-flex align-items-center">
                            <i class="bi bi-people text-warning me-2"></i>
                            Supporto
                        </div>
                        Lo staff di Atelier Europeo assisterà i partecipanti selezionati 
                        nella preparazione e durante tutto il percorso dello scambio.
                    </div>
                </li>
            </ol>
        </div>
    </div>

    <!-- Benefici dell'esperienza -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h3 fw-bold text-primary mb-4">
                <i class="bi bi-trophy me-2"></i>Cosa otterrai da questa esperienza
            </h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-chat-square-text text-primary" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Competenze Linguistiche</h5>
                            <p class="text-muted">
                                Migliora il tuo inglese e scopri altre lingue europee 
                                attraverso l'immersione culturale.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-globe-americas text-success" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Consapevolezza Culturale</h5>
                            <p class="text-muted">
                                Sviluppa una mentalità aperta e comprensione 
                                delle diverse culture europee.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <i class="bi bi-person-hearts text-info" style="font-size: 3rem;"></i>
                            <h5 class="mt-3 mb-3">Network Internazionale</h5>
                            <p class="text-muted">
                                Crea amicizie durature con giovani da tutta Europa 
                                e costruisci il tuo network internazionale.
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
            <div class="bg-success text-white p-5 rounded-4 text-center">
                <h3 class="fw-bold mb-3">Pronto per un'avventura interculturale?</h3>
                <p class="lead mb-4">
                    Gli scambi giovanili sono un'opportunità unica di crescita personale e culturale. 
                    Scopri il mondo, fai nuove amicizie e arricchisci il tuo bagaglio di esperienze 
                    senza alcun costo!
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-envelope me-2"></i>Manifestiamo il tuo interesse
                    </a>
                    <a href="{{ route('corpo-europeo') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-arrow-right me-2"></i>Scopri altre opportunità
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
