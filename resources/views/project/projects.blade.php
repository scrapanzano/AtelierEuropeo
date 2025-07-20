@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_progetti', 'active')

@section('breadcrumb')
<div class="bg-light py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Progetti Disponibili</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('body')

    <!-- Messaggi di successo/errore -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show mx-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show mx-3" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            {{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container py-5">
        <h1 class="section-title fw-bold text-center">Parti con noi!</h1>
        <h1 class="section-subtitle text-center">Scopri i nostri progetti di volontariato, scambi giovanili e corsi di
            formazione in tutta Europa.
            Unisciti a noi per un'esperienza unica!</h1>

        <!-- Sezione di Ricerca -->
        <div class="row justify-content-center py-4">
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row g-3 align-items-end">
                            <!-- Campo di ricerca principale -->
                            <div class="col-12 col-md-8">
                                <label for="searchInput" class="form-label fw-semibold">
                                    <i class="bi bi-search me-2"></i>Cerca progetti
                                </label>
                                <input type="text" class="form-control form-control-lg" id="searchInput" 
                                       placeholder="Cerca per titolo, descrizione, paese..." data-column="all">
                            </div>
                            
                            <!-- Filtro per categoria -->
                            <div class="col-12 col-md-4">
                                <label for="categoryFilter" class="form-label fw-semibold">Categoria</label>
                                <select class="form-select form-select-lg" id="categoryFilter">
                                    <option value="all">Tutte le categorie</option>
                                    <option value="ESC">Corpo Europeo di Solidarietà</option>
                                    <option value="YTH">Scambi Giovanili</option>
                                    <option value="TRG">Corsi di Formazione</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Pulsante cancella filtri sempre visibile -->
                        <div class="row g-3 mt-2">
                            <div class="col-12 d-flex gap-2">
                                <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                                    <i class="bi bi-x-circle me-2"></i>Cancella filtri
                                </button>
                                
                                <!-- Filtri avanzati solo per admin -->
                                @if (auth()->check() && auth()->user()->role === 'admin')
                                <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#advancedFilters" aria-expanded="false" aria-controls="advancedFilters">
                                    <i class="bi bi-funnel me-2"></i>Filtri avanzati
                                </button>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Sezione filtri avanzati solo per admin -->
                        @if (auth()->check() && auth()->user()->role === 'admin')
                        <div class="collapse mt-3" id="advancedFilters">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="statusFilter" class="form-label fw-semibold">Stato</label>
                                    <select class="form-select" id="statusFilter">
                                        <option value="all">Tutti gli stati</option>
                                        <option value="published">Pubblicato</option>
                                        <option value="draft">Bozza</option>
                                        <option value="completed">Completato</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Risultati della ricerca -->
                        <div class="mt-4" id="searchResults" style="display: none;">
                            <div class="d-flex align-items-center" id="searchResultsContent">
                                <i class="bi bi-info-circle text-primary me-2" id="searchResultsIcon"></i>
                                <span id="searchResultsText"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4 g-2 align-items-center">
            <div class="col-8 col-md-6">
                <h3 class="fw-bold mb-0 fs-2 fs-lg-1">Progetti Disponibili</h3>
            </div>
            @if (auth()->check() && auth()->user()->role === 'admin')
                <div class="col-4 col-md-6 text-end">
                    <a href="{{ route('project.create') }}"
                        class="btn btn-success btn-rounded d-inline-flex align-items-center px-3 py-2 px-md-4">
                        <i class="bi bi-plus-circle me-2 fs-5"></i>

                        <span class="d-none d-sm-inline">Crea Progetto</span>
                        <span class="d-inline d-sm-none">Crea</span>

                    </a>
                </div>
            @endif
        </div>

        <!-- Container principale: row-cols per griglia su desktop, flex-nowrap per scroll su mobile -->
        <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4" id="projectsContainer">
            @foreach ($projectsList as $project)
                <!-- Card container: dimensioni reattive e flex-shrink-0 per scroll -->
                <div class="col-6 col-sm-7 col-md-5 col-lg-4 mb-4 flex-shrink-0 flex-lg-shrink-1">
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
            @endforeach
        </div>
        
        <!-- Messaggio quando non ci sono risultati -->
        <div class="row" id="noResults" style="display: none;">
            <div class="col-12">
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="bi bi-search text-muted" style="font-size: 4rem;"></i>
                    </div>
                    <h3 class="text-muted mb-3">Nessun progetto trovato</h3>
                    <p class="text-muted mb-4">
                        Non sono stati trovati progetti che corrispondono ai tuoi criteri di ricerca.
                    </p>
                    <button type="button" class="btn btn-outline-primary" onclick="clearAllFilters()">
                        <i class="bi bi-arrow-clockwise me-2"></i>Cancella tutti i filtri
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast per notifiche -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="favoriteToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bi bi-heart-fill text-danger me-2"></i>
                <strong class="me-auto">Preferiti</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastMessage">
                <!-- Il messaggio verrà inserito qui dinamicamente -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Script caricato per projects.blade.php');
            
            // Inizializza il sistema di ricerca
            initializeProjectSearch();

            // Gestione pulsanti preferiti
            document.querySelectorAll('.favorite-btn').forEach(function(button) {
                console.log('Trovato pulsante preferiti:', button);
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Click sul pulsante preferiti');
                    const projectId = this.dataset.projectId;
                    console.log('Project ID:', projectId);
                    toggleFavorite(projectId, this);
                });
            });
        });

        // Sistema di ricerca avanzato
        function initializeProjectSearch() {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter'); // Potrebbe essere null se non admin
            const clearFiltersBtn = document.getElementById('clearFilters');
            const projectsContainer = document.getElementById('projectsContainer');
            const noResults = document.getElementById('noResults');
            const searchResults = document.getElementById('searchResults');
            const searchResultsText = document.getElementById('searchResultsText');

            // Ottieni tutti i progetti dal container
            const allProjects = Array.from(projectsContainer.children);
            
            // Event listeners per i filtri
            searchInput.addEventListener('input', performSearch);
            categoryFilter.addEventListener('change', performSearch);
            
            // Aggiungi listener per statusFilter solo se esiste (admin)
            if (statusFilter) {
                statusFilter.addEventListener('change', performSearch);
            }
            
            clearFiltersBtn.addEventListener('click', function() {
                clearAllFiltersAndUpdate();
            });

            function clearAllFiltersAndUpdate() {
                // Reset tutti i campi
                searchInput.value = '';
                categoryFilter.value = 'all';
                
                // Reset statusFilter solo se esiste (admin)
                if (statusFilter) {
                    statusFilter.value = 'all';
                }
                
                // Triggera la ricerca per aggiornare l'interfaccia
                performSearch();
            }

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedCategory = categoryFilter.value;
                const selectedStatus = statusFilter ? statusFilter.value : 'all'; // Gestisce il caso non-admin

                console.log('Performing search with:', {
                    searchTerm,
                    selectedCategory,
                    selectedStatus
                });

                let visibleProjects = 0;
                let hasActiveFilters = searchTerm || selectedCategory !== 'all' || selectedStatus !== 'all';

                allProjects.forEach(function(projectElement) {
                    let isVisible = true;
                    
                    // Estrai i dati del progetto dalla card
                    const projectData = extractProjectData(projectElement);
                    
                    // Filtro per ricerca testuale (include paese nella ricerca generale)
                    if (searchTerm && isVisible) {
                        // Prima prova con campi specifici
                        const specificText = [
                            projectData.title,
                            projectData.description,
                            projectData.country,
                            projectData.organization
                        ].join(' ').toLowerCase();
                        
                        // Se non trova nei campi specifici, cerca in tutto il testo della card
                        isVisible = specificText.includes(searchTerm) || 
                                   projectData.allText.includes(searchTerm);
                    }

                    // Filtro per categoria
                    if (selectedCategory !== 'all' && isVisible) {
                        isVisible = projectData.category === selectedCategory;
                    }

                    // Filtro per stato (solo se il filtro esiste e non è 'all')
                    if (statusFilter && selectedStatus !== 'all' && isVisible) {
                        console.log('Filtering by status:', selectedStatus, 'Project status:', projectData.status);
                        isVisible = projectData.status === selectedStatus;
                        console.log('Project visible after status filter:', isVisible);
                    }

                    // Debug per il primo progetto
                    if (projectElement === allProjects[0] && hasActiveFilters) {
                        console.log('=== DEBUG FIRST PROJECT ===');
                        console.log('Selected status:', selectedStatus);
                        console.log('Project data:', projectData);
                        console.log('Project visible:', isVisible);
                        console.log('========================');
                    }

                    // Mostra/nascondi progetto
                    projectElement.style.display = isVisible ? '' : 'none';
                    if (isVisible) visibleProjects++;
                });

                console.log('Visible projects:', visibleProjects, 'of', allProjects.length);

                // Aggiorna risultati di ricerca
                updateSearchResults(visibleProjects, hasActiveFilters);
            }

            function extractProjectData(projectElement) {
                // Estrai i dati dalla card del progetto
                const card = projectElement.querySelector('.card');
                
                // Estrai tutte le informazioni testuali dalla card per la ricerca generale (definisci subito)
                const allCardText = card.textContent || '';
                
                // Estrai il titolo dalla card
                const title = card.querySelector('.card-title')?.textContent || 
                            card.querySelector('h5')?.textContent || 
                            card.querySelector('.fw-bold')?.textContent || '';
                
                // Estrai la descrizione dalla card
                const description = card.querySelector('.card-text')?.textContent || '';
                
                // Estrai la categoria dal badge (primo badge che contiene ESC, YTH, o TRG)
                let category = '';
                const badges = card.querySelectorAll('.badge');
                badges.forEach(function(badgeEl) {
                    const badgeText = badgeEl.textContent.trim();
                    if (['ESC', 'YTH', 'TRG'].includes(badgeText)) {
                        category = badgeText;
                    }
                });
                
                // Estrai lo stato del progetto (published/draft/completed)
                let status = 'published'; // Default
                
                // Cerca lo stato nella sezione admin-info (per admin)
                const adminInfo = card.querySelector('.admin-info');
                if (adminInfo) {
                    const statusText = adminInfo.textContent;
                    console.log('Admin info text:', statusText);
                    
                    // Cerca il pattern "Status:" seguito dal valore dello stato
                    const statusMatch = statusText.match(/Status:\s*([^\n]+)/i);
                    if (statusMatch) {
                        const statusValue = statusMatch[1].trim().toLowerCase();
                        console.log('Found status value:', statusValue);
                        
                        if (statusValue.includes('bozza') || statusValue.includes('draft')) {
                            status = 'draft';
                            console.log('Status set to DRAFT from admin info');
                        } else if (statusValue.includes('completato') || statusValue.includes('completed')) {
                            status = 'completed';
                            console.log('Status set to COMPLETED from admin info');
                        } else if (statusValue.includes('pubblicato') || statusValue.includes('published')) {
                            status = 'published';
                            console.log('Status set to PUBLISHED from admin info');
                        }
                    }
                } else {
                    // Fallback: se non c'è admin-info, cerca nel testo generale della card
                    const cardTextLower = allCardText.toLowerCase();
                    if (cardTextLower.includes('bozza') || cardTextLower.includes('draft')) {
                        status = 'draft';
                        console.log('Status set to DRAFT from card text fallback');
                    } else if (cardTextLower.includes('completato') || cardTextLower.includes('completed') || 
                              cardTextLower.includes('finito') || cardTextLower.includes('terminato')) {
                        status = 'completed';
                        console.log('Status set to COMPLETED from card text fallback');
                    }
                }
                
                console.log('Final status for project:', status);
                
                // Cerca pattern per paese - prima prova con le nuove classi CSS, poi fallback
                let country = '';
                const countryElement = card.querySelector('.country-info');
                if (countryElement) {
                    country = countryElement.textContent.trim();
                } else {
                    // Fallback ai pattern esistenti
                    const countryMatch = allCardText.match(/(?:🌍|Paese:|Country:)\s*([A-Za-z\s]+?)(?:\n|,|$|🏢)/i);
                    if (countryMatch) {
                        country = countryMatch[1].trim();
                    }
                }
                
                // Cerca pattern per organizzazione (dopo emoji edificio o parole chiave)
                let organization = '';
                const orgMatch = allCardText.match(/(?:�|Organizzazione:|Organization:)\s*([A-Za-z\s]+?)(?:\n|,|$)/i);
                if (orgMatch) {
                    organization = orgMatch[1].trim();
                }
                
                
                if (adminInfo && !organization) {
                    const associationText = adminInfo.textContent;
                    const assocMatch = associationText.match(/Associazione:\s*([^0-9\n]+)/);
                    if (assocMatch) {
                        organization = assocMatch[1].trim();
                    }
                }

                console.log('Extracted data:', {
                    title: title.trim(),
                    description: description.trim(),
                    category: category,
                    country: country,
                    organization: organization,
                    status: status,
                    allText: allCardText.substring(0, 100) + '...' // Per debug
                });

                return {
                    title: title.trim(),
                    description: description.trim(),
                    category: category,
                    country: country,
                    organization: organization,
                    status: status,
                    allText: allCardText.toLowerCase() // Per ricerca generale
                };
            }

            function updateSearchResults(visibleCount, hasFilters) {
                const totalProjects = allProjects.length;
                const searchResultsIcon = document.getElementById('searchResultsIcon');
                const searchResultsContent = document.getElementById('searchResultsContent');
                
                if (hasFilters) {
                    searchResults.style.display = 'block';
                    if (visibleCount === 0) {
                        searchResultsText.textContent = 'Nessun progetto trovato';
                        searchResultsContent.className = 'd-flex align-items-center text-danger';
                        if (searchResultsIcon) {
                            searchResultsIcon.className = 'bi bi-exclamation-circle text-danger me-2';
                        }
                        noResults.style.display = 'block';
                        projectsContainer.style.display = 'none';
                    } else {
                        searchResultsText.textContent = `${visibleCount} di ${totalProjects} progetti trovati`;
                        searchResultsContent.className = 'd-flex align-items-center text-success';
                        if (searchResultsIcon) {
                            searchResultsIcon.className = 'bi bi-info-circle text-success me-2';
                        }
                        noResults.style.display = 'none';
                        projectsContainer.style.display = '';
                    }
                } else {
                    searchResults.style.display = 'none';
                    searchResultsContent.className = 'd-flex align-items-center';
                    searchResultsText.textContent = ''; // Reset del testo
                    if (searchResultsIcon) {
                        searchResultsIcon.className = 'bi bi-info-circle text-primary me-2'; // Reset dell'icona
                    }
                    noResults.style.display = 'none';
                    projectsContainer.style.display = '';
                }
            }
        }

        // Funzione globale per cancellare tutti i filtri (chiamata dal pulsante "Cancella tutti i filtri" nella sezione no results)
        function clearAllFilters() {
            // Reset tutti i campi di input
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const statusFilter = document.getElementById('statusFilter');
            
            if (searchInput) searchInput.value = '';
            if (categoryFilter) categoryFilter.value = 'all';
            if (statusFilter) statusFilter.value = 'all';
            
            // Triggera una nuova ricerca per aggiornare tutto correttamente
            if (typeof initializeProjectSearch !== 'undefined') {
                // Se la funzione di ricerca è disponibile, triggera una ricerca
                const event = new Event('input');
                if (searchInput) searchInput.dispatchEvent(event);
            } else {
                // Fallback: reset manuale
                const projectsContainer = document.getElementById('projectsContainer');
                const searchResults = document.getElementById('searchResults');
                const noResults = document.getElementById('noResults');
                
                if (projectsContainer) {
                    Array.from(projectsContainer.children).forEach(function(project) {
                        project.style.display = '';
                    });
                    projectsContainer.style.display = '';
                }
                
                if (searchResults) {
                    searchResults.style.display = 'none';
                }
                
                if (noResults) {
                    noResults.style.display = 'none';
                }
            }
        }

        // Mantieni le funzioni esistenti per i preferiti
        function toggleFavorite(projectId, button) {
            console.log('toggleFavorite chiamata con projectId:', projectId);

            // Disabilita il pulsante durante la richiesta
            button.disabled = true;

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            console.log('CSRF Token trovato:', csrfToken ? csrfToken.getAttribute('content') : 'NESSUN TOKEN');

            fetch('/favorites/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : ''
                    },
                    body: JSON.stringify({
                        project_id: projectId
                    })
                })
                .then(response => {
                    console.log('Risposta ricevuta:', response);
                    return response.json();
                })
                .then(data => {
                    console.log('Dati ricevuti:', data);
                    if (data.success) {
                        // Aggiorna l'interfaccia
                        const icon = button.querySelector('i');

                        if (data.is_favorite) {
                            // Il progetto è ora nei preferiti
                            icon.className =
                                'bi bi-heart-fill text-white d-flex justify-content-center align-items-center';
                            button.dataset.isFavorite = 'true';
                        } else {
                            // Il progetto è stato rimosso dai preferiti
                            icon.className = 'bi bi-heart text-white d-flex justify-content-center align-items-center';
                            button.dataset.isFavorite = 'false';
                        }

                        // Mostra toast
                        showToast(data.message);
                    } else {
                        showToast(data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Errore:', error);
                    showToast('Si è verificato un errore. Riprova più tardi.', 'error');
                })
                .finally(() => {
                    // Riabilita il pulsante
                    button.disabled = false;
                });
        }

        function showToast(message, type = 'success') {
            console.log('Mostra toast:', message, type);
            const toast = document.getElementById('favoriteToast');
            if (!toast) {
                console.error('Toast element non trovato');
                return;
            }

            const toastMessage = document.getElementById('toastMessage');
            const toastHeader = toast.querySelector('.toast-header');

            // Aggiorna il messaggio
            toastMessage.textContent = message;

            // Aggiorna lo stile in base al tipo
            if (type === 'error') {
                toastHeader.className = 'toast-header bg-danger text-white';
                const icon = toastHeader.querySelector('i');
                if (icon) icon.className = 'bi bi-exclamation-triangle-fill text-white me-2';
            } else {
                toastHeader.className = 'toast-header';
                const icon = toastHeader.querySelector('i');
                if (icon) icon.className = 'bi bi-heart-fill text-danger me-2';
            }

            // Mostra il toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }
    </script>
@endsection
