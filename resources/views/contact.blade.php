@extends('layouts.master')

@section('title', 'Atelier Europeo - Contatti')

@section('active_contatti', 'active')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Contatti
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
<div class="container my-5">
    <!-- Titolo -->
    <h1 class="display-4 fw-bold text-primary mb-3 text-center">Contatti</h1>
    <hr class="mb-5">

    <!-- Prima Riga (Contenuti) -->
    <div class="row g-4">
        <!-- Colonna Sinistra (Info) -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>Informazioni di Contatto
                    </h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center py-3">
                            <i class="bi bi-geo-alt-fill text-primary me-3 fs-5"></i>
                            <div>
                                <strong>Indirizzo</strong><br>
                                <span class="text-muted">C/o CSV, Via Salgari 43/b<br>25125 Brescia</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-3">
                            <i class="bi bi-telephone-fill text-success me-3 fs-5"></i>
                            <div>
                                <strong>Telefono</strong><br>
                                <a href="tel:+390302284900" class="text-decoration-none">+39 030 22 84 900</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-3">
                            <i class="bi bi-envelope-fill text-info me-3 fs-5"></i>
                            <div>
                                <strong>Email</strong><br>
                                <a href="mailto:info@ateliereuropeo.eu" class="text-decoration-none">info@ateliereuropeo.eu</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-3">
                            <i class="bi bi-envelope-at-fill text-warning me-3 fs-5"></i>
                            <div>
                                <strong>PEC</strong><br>
                                <a href="mailto:ateliereuropeo@pec.it" class="text-decoration-none">ateliereuropeo@pec.it</a>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Sezione Dati Fiscali -->
                <div class="card-footer bg-light">
                    <h6 class="fw-bold text-secondary mb-2">
                        <i class="bi bi-file-earmark-text me-2"></i>Dati Fiscali
                    </h6>
                    <div class="row g-2">
                        <div class="col-12">
                            <small class="text-muted">
                                <strong>P.IVA:</strong> 03747110983
                            </small>
                        </div>
                        <div class="col-12">
                            <small class="text-muted">
                                <strong>C.F:</strong> 98174020176
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Sezione Social Media -->
                <div class="card-footer bg-white border-top">
                    <h6 class="fw-bold text-secondary mb-3">
                        <i class="bi bi-share me-2"></i>Seguici sui Social
                    </h6>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/AtelierEuropeo/" target="_blank" 
                           class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-facebook me-2"></i>Facebook
                        </a>
                        <a href="https://www.instagram.com/ateliereuropeo/" target="_blank" 
                           class="btn btn-outline-danger btn-sm d-flex align-items-center">
                            <i class="bi bi-instagram me-2"></i>Instagram
                        </a>
                        <a href="https://www.linkedin.com/company/atelier-europeo/" target="_blank" 
                           class="btn btn-outline-info btn-sm d-flex align-items-center">
                            <i class="bi bi-linkedin me-2"></i>LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonna Destra (Form) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-envelope-paper-fill me-2"></i>Invia un Messaggio
                    </h5>
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nome" class="form-label">
                                        <i class="bi bi-person me-1"></i>Nome *
                                    </label>
                                    <input type="text" class="form-control" id="nome" name="nome" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope me-1"></i>Email *
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="oggetto" class="form-label">
                                <i class="bi bi-tag me-1"></i>Oggetto *
                            </label>
                            <select class="form-control" id="oggetto" name="oggetto" required>
                                <option value="">Seleziona un oggetto...</option>
                                <option value="informazioni-generali">Informazioni Generali</option>
                                <option value="corpo-europeo">Corpo Europeo di Solidarietà</option>
                                <option value="scambi-giovanili">Scambi Giovanili</option>
                                <option value="corsi-formazione">Corsi di Formazione</option>
                                <option value="progetti-disponibili">Progetti Disponibili</option>
                                <option value="partnership">Partnership e Collaborazioni</option>
                                <option value="altro">Altro</option>
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="messaggio" class="form-label">
                                <i class="bi bi-chat-text me-1"></i>Messaggio *
                            </label>
                            <textarea class="form-control" id="messaggio" name="messaggio" rows="6" 
                                      placeholder="Scrivi qui il tuo messaggio..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                                <label class="form-check-label" for="privacy">
                                    <small>
                                        Accetto il trattamento dei dati personali secondo la 
                                        <a href="#" class="text-decoration-none">Privacy Policy</a> *
                                    </small>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="bi bi-send me-2"></i>Invia Messaggio
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Ti risponderemo entro 24-48 ore lavorative. Per richieste urgenti, 
                        contattaci direttamente via telefono.
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Seconda Riga (Mappa) -->
    <div class="row mt-5">
        <!-- Colonna Unica -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-geo-alt-fill me-2"></i>Dove Siamo
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="ratio ratio-21x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.305594954824!2d10.187656076858766!3d45.50379962979921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478177b738542d99%3A0x4884934139747595!2sVia%20Emilio%20Salgari%2C%2043b%2C%2025125%20Brescia%20BS!5e0!3m2!1sit!2sit!4v1689786543210!5m2!1sit!2sit" 
                                width="100%" 
                                height="450" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <small class="text-muted">
                                <i class="bi bi-clock me-1"></i>
                                <strong>Orari di ricevimento:</strong> Lunedì - Venerdì: 9:00 - 17:00
                            </small>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="https://www.google.com/maps/dir//Via+Emilio+Salgari,+43b,+25125+Brescia+BS" 
                               target="_blank" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-signpost me-1"></i>Ottieni Indicazioni
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione informativa aggiuntiva -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-lightbulb-fill me-3 fs-3"></i>
                    <div>
                        <h5 class="alert-heading mb-2">
                            <strong>Hai domande sui nostri programmi?</strong>
                        </h5>
                        <p class="mb-2">
                            Il nostro team è sempre disponibile per fornire informazioni dettagliate 
                            sui progetti di mobilità europea, sui programmi Erasmus+ e sulle opportunità 
                            di volontariato internazionale.
                        </p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('corpo-europeo') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-heart me-1"></i>Corpo Europeo di Solidarietà
                            </a>
                            <a href="{{ route('scambi-giovanili') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-people me-1"></i>Scambi Giovanili
                            </a>
                            <a href="{{ route('corsi-formazione') }}" class="btn btn-outline-info btn-sm">
                                <i class="bi bi-mortarboard me-1"></i>Corsi di Formazione
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
