@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_progetti', 'active')

@section('body')

    <div class="container py-5">
        <h1 class="section-title fw-bold text-center">Parti con noi!</h1>
        <h1 class="section-subtitle text-center">Scopri i nostri progetti di volontariato, scambi giovanili e corsi di
            formazione in tutta Europa.
            Unisciti a noi per un'esperienza unica!</h1>
        <div class="row mb-4 g-2 align-items-center py-5">
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
        <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4">
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
    </script>
