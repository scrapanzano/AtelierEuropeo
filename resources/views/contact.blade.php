@extends('layouts.master')

@section('title', 'AE - Contatti')

@section('active_contatti', 'active')

@section('breadcrumb')
<div class="bg-light py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Contatti</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('body')
<div class="container py-4">
    <!-- Titolo -->
    <h1 class="section-title fw-bold text-center mb-3">Contatti</h1>
    <hr class="mb-4">

    <!-- Prima Riga (Contenuti) -->
    <div class="row g-3">
        <!-- Colonna Sinistra (Info) -->
        <div class="col-lg-5 mb-3 mb-lg-0">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-info-circle-fill me-2"></i>Informazioni di Contatto
                    </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center py-2">
                            <i class="bi bi-geo-alt-fill text-primary me-3 fs-6"></i>
                            <div>
                                <strong class="small">Indirizzo</strong><br>
                                <span class="text-muted small">C/o CSV, Via Salgari 43/b<br>25125 Brescia</span>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-2">
                            <i class="bi bi-telephone-fill text-primary me-3 fs-6"></i>
                            <div>
                                <strong class="small">Telefono</strong><br>
                                <a href="tel:+390302284900" class="text-decoration-none small">+39 030 22 84 900</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-2">
                            <i class="bi bi-envelope-fill text-primary me-3 fs-6"></i>
                            <div>
                                <strong class="small">Email</strong><br>
                                <a href="mailto:info@ateliereuropeo.eu" class="text-decoration-none small">info@ateliereuropeo.eu</a>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-2">
                            <i class="bi bi-envelope-at-fill text-primary me-3 fs-6"></i>
                            <div>
                                <strong class="small">PEC</strong><br>
                                <a href="mailto:ateliereuropeo@pec.it" class="text-decoration-none small">ateliereuropeo@pec.it</a>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Sezione Dati Fiscali -->
                <div class="card-footer bg-light py-2">
                    <h6 class="fw-bold text-secondary mb-2 small">
                        <i class="bi bi-file-earmark-text me-2"></i>Dati Fiscali
                    </h6>
                    <div class="row g-1">
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
                <div class="card-footer bg-white border-top py-2">
                    <h6 class="fw-bold text-secondary mb-2 small">
                        <i class="bi bi-share me-2"></i>Seguici sui Social
                    </h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="https://www.facebook.com/AtelierEuropeo/" target="_blank" 
                           class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-facebook me-1"></i><small>Facebook</small>
                        </a>
                        <a href="https://www.instagram.com/ateliereuropeo/" target="_blank" 
                           class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-instagram me-1"></i><small>Instagram</small>
                        </a>
                        <a href="https://www.linkedin.com/company/atelier-europeo/" target="_blank" 
                           class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="bi bi-linkedin me-1"></i><small>LinkedIn</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonna Destra (Form) -->
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-envelope-paper-fill me-2"></i>Invia un Messaggio
                    </h6>
                </div>
                <div class="card-body py-3">
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-2">
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="nome" class="form-label small">
                                        <i class="bi bi-person me-1"></i>Nome *
                                    </label>
                                    <input type="text" class="form-control form-control-sm" id="nome" name="nome" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="email" class="form-label small">
                                        <i class="bi bi-envelope me-1"></i>Email *
                                    </label>
                                    <input type="email" class="form-control form-control-sm" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-2">
                            <label for="oggetto" class="form-label small">
                                <i class="bi bi-tag me-1"></i>Oggetto *
                            </label>
                            <select class="form-control form-control-sm" id="oggetto" name="oggetto" required>
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
                        
                        <div class="mb-3">
                            <label for="messaggio" class="form-label small">
                                <i class="bi bi-chat-text me-1"></i>Messaggio *
                            </label>
                            <textarea class="form-control form-control-sm" id="messaggio" name="messaggio" rows="5" 
                                      placeholder="Scrivi qui il tuo messaggio..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                                <label class="form-check-label small" for="privacy">
                                    Accetto il trattamento dei dati personali secondo la 
                                    <a href="#" class="text-decoration-none">Privacy Policy</a> *
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send me-2"></i>Invia Messaggio
                        </button>
                    </form>
                </div>
                <div class="card-footer bg-light py-2">
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
    <div class="row mt-4">
        <!-- Colonna Unica -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-geo-alt-fill me-2"></i>Dove Siamo
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.305594954824!2d10.187656076858766!3d45.50379962979921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478177b738542d99%3A0x4884934139747595!2sVia%20Emilio%20Salgari%2C%2043b%2C%2025125%20Brescia%20BS!5e0!3m2!1sit!2sit!4v1689786543210!5m2!1sit!2sit" 
                                width="100%" 
                                height="350" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                <div class="card-footer bg-light py-2">
                    <div class="row g-2 align-items-center">
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
                                <i class="bi bi-signpost me-1"></i><small>Ottieni Indicazioni</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sezione informativa aggiuntiva -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-primary border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="bi bi-lightbulb-fill me-3 fs-4"></i>
                    <div>
                        <h6 class="alert-heading mb-1">
                            <strong>Hai domande sui nostri programmi?</strong>
                        </h6>
                        <p class="mb-2 small">
                            Il nostro team è sempre disponibile per fornire informazioni dettagliate 
                            sui progetti di mobilità europea, sui programmi Erasmus+ e sulle opportunità 
                            di volontariato internazionale.
                        </p>
                        <div class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('corpo-europeo') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-heart me-1"></i><small>Corpo Europeo di Solidarietà</small>
                            </a>
                            <a href="{{ route('scambi-giovanili') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-people me-1"></i><small>Scambi Giovanili</small>
                            </a>
                            <a href="{{ route('corsi-formazione') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-mortarboard me-1"></i><small>Corsi di Formazione</small>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
