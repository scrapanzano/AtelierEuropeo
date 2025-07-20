@extends('layouts.master')

@section('title', 'AE - I Miei Preferiti')

@section('active_preferiti', 'active')

@section('breadcrumb')
<div class="bg-light py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">I Miei Preferiti</li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('body')
    <div class="container px-2 px-md-4 pb-5">
        <!-- Messaggi di sessione -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Perfetto!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Attenzione!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h1 class="section-title fw-bold text-center">I miei preferiti</h1>
        <h1 class="section-subtitle text-center pb-5">Non perdere mai di vista i progetti di tuo interesse</h1>

        <!-- Contatore progetti -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold mb-0 fs-4 fs-md-3">
                        <i class="bi bi-bookmark-heart me-2"></i>
                        @if ($favoriteProjects->total() > 0)
                            {{ $favoriteProjects->total() }}
                            {{ $favoriteProjects->total() === 1 ? 'progetto preferito' : 'progetti preferiti' }}
                        @else
                            Nessun progetto preferito
                        @endif
                    </h3>
                    <a href="{{ route('project.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-search me-1"></i>Scopri progetti
                    </a>
                </div>
            </div>
        </div>

        @if ($favoriteProjects->count() > 0)
            <!-- Lista progetti preferiti -->
            <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4">
                @foreach ($favoriteProjects as $project)
                    <!-- Card container: dimensioni reattive e flex-shrink-0 per scroll -->
                    <div class="col-6 col-sm-7 col-md-5 col-lg-4 mb-4 flex-shrink-0 flex-lg-shrink-1">
                        <x-project-card :project="$project" :showAdminOptions="false" :showFavoriteIcon="true" />
                    </div>
                @endforeach
            </div>

            <!-- Paginazione -->
            @if ($favoriteProjects->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $favoriteProjects->links() }}
                </div>
            @endif
        @else
            <!-- Messaggio se non ci sono preferiti -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-heart text-muted" style="font-size: 4rem;"></i>
                </div>
                <h4 class="text-muted mb-3">Nessun progetto preferito</h4>
                <p class="text-muted mb-4">
                    Non hai ancora salvato nessun progetto nei tuoi preferiti.<br>
                    Esplora i progetti disponibili e salva quelli che ti interessano di più!
                </p>
                <a href="{{ route('project.index') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-search me-2"></i>Scopri i Progetti
                </a>
            </div>
        @endif
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
            console.log('Script caricato per favorites/index.blade.php');

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
                        // Mostra toast
                        showToast(data.message);

                        if (data.action === 'removed') {
                            // Rimuovi la card del progetto con animazione
                            const card = button.closest('.col-6');
                            if (card) {
                                card.style.opacity = '0.5';
                                card.style.transform = 'scale(0.95)';

                                setTimeout(() => {
                                    card.remove();
                                    // Aggiorna il contatore se necessario
                                    updateProjectCounter();
                                }, 300);
                            }
                        } else {
                            // Aggiorna l'interfaccia per il caso di aggiunta (dovrebbe essere raro in questa pagina)
                            const icon = button.querySelector('i');
                            if (icon) {
                                icon.className =
                                    'bi bi-heart-fill text-white d-flex justify-content-center align-items-center';
                                button.dataset.isFavorite = 'true';
                            }
                        }
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

            // Aggiorna l'icona e il colore in base al tipo
            const icon = toastHeader.querySelector('i');
            if (type === 'error') {
                icon.className = 'bi bi-exclamation-triangle-fill text-danger me-2';
                toastHeader.className = 'toast-header bg-danger text-white';
            } else {
                icon.className = 'bi bi-heart-fill text-danger me-2';
                toastHeader.className = 'toast-header';
            }

            // Mostra il toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }

        function updateProjectCounter() {
            const projectCards = document.querySelectorAll('.col-6.col-sm-7.col-md-5.col-lg-4').length;

            if (projectCards === 0) {
                // Ricarica la pagina per mostrare il messaggio "nessun progetto preferito"
                location.reload();
            } else {
                // Aggiorna il contatore nel titolo
                const counterElement = document.querySelector('h3.fw-bold');
                if (counterElement) {
                    const newText = projectCards === 1 ?
                        '1 progetto preferito' :
                        `${projectCards} progetti preferiti`;
                    counterElement.innerHTML = `<i class="bi bi-bookmark-heart me-2"></i>${newText}`;
                }
            }
        }
    </script>
@endsection
