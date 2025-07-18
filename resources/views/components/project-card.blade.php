@props(['project', 'showAdminOptions' => false, 'showFavoriteIcon' => false])

<div class="card border-0 shadow-sm rounded-4 position-relative h-100 d-flex flex-column w-100">
    <a href="{{ route('project.show', ['project' => $project->id]) }}" class="stretched-link"></a>
    @php
        $categoryColors = [
            'ESC' => 'text-bg-success',
            'YTH' => 'text-bg-primary',
            'TRG' => 'text-bg-warning',
        ];
        $category = $project->category;
        $badgeColor = $categoryColors[$category->tag];
    @endphp
    <span class="badge {{ $badgeColor }} fw-bold position-absolute top-0 start-0 shadow-sm"
        style="border-radius: 0; border-top-left-radius: 0.75rem; border-bottom-right-radius: 0.75rem; z-index: 1; padding: 0.5rem 0.75rem; font-size: 1rem;">{{ $category->tag }}</span>

    {{-- Icona cuore per utenti non admin --}}
    @if ($showFavoriteIcon)
        @if (auth()->guest())
            <button type="button" class="btn p-0 position-absolute top-0 end-0 m-2"
                style="z-index: 3; width: 40px; height: 40px;" data-bs-toggle="modal"
                data-bs-target="#authModal-{{ $project->id }}">
                <i class="bi bi-heart text-white d-flex justify-content-center align-items-center"
                    style="font-size: 1.5rem; width: 100%; height: 100%;"></i>
            </button>

            {{-- Modal per l'autenticazione --}}
            <div class="modal fade" id="authModal-{{ $project->id }}" tabindex="-1"
                aria-labelledby="authModalLabel-{{ $project->id }}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="authModalLabel-{{ $project->id }}">Accedi per salvare ai
                                preferiti</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Per salvare questo progetto ai tuoi preferiti, devi prima accedere al tuo account.</p>
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
        @else
            {{-- Utente loggato non admin - Implementa qui la logica per salvare ai preferiti --}}
            <button type="button" class="btn p-0 position-absolute top-0 end-0 m-2"
                style="z-index: 3; width: 40px; height: 40px;" onclick="addToFavorites({{ $project->id }})">
                <i class="bi bi-heart text-white d-flex justify-content-center align-items-center"
                    style="font-size: 1.5rem; width: 100%; height: 100%;"></i>
            </button>
        @endif
    @endif
    <div class="position-relative">
        <img src="{{ $project->image_url }}" class="card-img-top rounded-top-4 card-img-bright" alt="...">
        <div class="card-img-gradient rounded-top-4"></div>
        <span class="badge badge-bottom-left fw-bold">
            <i class="bi bi-calendar-event me-1"></i>
            @php
                $durationText = 'N/D';
                if (!empty($project->start_date) && !empty($project->end_date)) {
                    $startDate = \Carbon\Carbon::parse($project->start_date);
                    $endDate = \Carbon\Carbon::parse($project->end_date);

                    $durationDays = $startDate->diffInDays($endDate);

                    if ($durationDays > 60) {
                        // Se supera i 60 giorni, mostra in mesi e giorni
                        $months = floor($durationDays / 30);

                        $durationText = $months . ' ' . ($months == 1 ? 'mese' : 'mesi');
                    } else {
                        $durationText = $durationDays . ' ' . ($durationDays == 1 ? 'giorno' : 'giorni');
                    }
                }
            @endphp
            {{ $durationText }}
        </span>
    </div>
    <div class="card-body d-flex flex-column flex-grow-1">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">{{ $project->title }}</h4>
            @if ($showAdminOptions)
                <div class="dropdown">
                    <button class="btn p-0 position-relative" style="z-index: 2;" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Opzioni">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        @if($project->status !== 'completed')
                            <li><a class="dropdown-item py-2 text-primary"
                                    href="{{ route('project.edit', ['id' => $project->id]) }}"><i
                                        class="bi bi-pen-fill me-2"></i> Modifica</a></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                        @else
                            <li><span class="dropdown-item py-2 text-muted"><i
                                        class="bi bi-check-circle me-2"></i> Progetto Completato</span></li>
                            <li>
                                <hr class="dropdown-divider my-1">
                            </li>
                        @endif
                        <li><a class="dropdown-item py-2 text-danger"
                                href="{{ route('project.destroy.confirm', ['id' => $project->id]) }}"><i
                                class="bi bi-trash-fill me-2"></i> Elimina</a>
                        </li>
                    </ul>
                </div>

                {{-- Modal di conferma eliminazione --}}
            @endif
        </div>
        <p class="card-text pt-2">{{ $project->sum_description }}</p>
        
        {{-- Informazioni amministrative per admin --}}
        @if ($showAdminOptions)
            <div class="admin-info mt-3 pt-3 border-top">
                <div class="row g-2 small text-muted">
                    <div class="col-6">
                        <strong>Status:</strong>
                        @php
                            $statusLabels = [
                                'draft' => ['text' => 'Bozza', 'class' => 'text-secondary'],
                                'published' => ['text' => 'Pubblicato', 'class' => 'text-success'],
                                'completed' => ['text' => 'Completato', 'class' => 'text-warning']
                            ];
                            $status = $statusLabels[$project->status] ?? ['text' => $project->status, 'class' => 'text-muted'];
                        @endphp
                        <span class="{{ $status['class'] }} fw-semibold">{{ $status['text'] }}</span>
                    </div>
                    <div class="col-6">
                        <strong>Candidature:</strong> {{ $project->application->count() }}/{{ $project->requested_people }}
                    </div>
                    <div class="col-6">
                        <strong>Scadenza:</strong>
                        @php
                            $expireDate = \Carbon\Carbon::parse($project->expire_date);
                            $isExpired = $expireDate->isPast();
                            $daysToExpire = (int) $expireDate->diffInDays(now());
                        @endphp
                        <span class="{{ $isExpired ? 'text-danger' : ($daysToExpire <= 7 ? 'text-danger' : 'text-muted') }}">
                            {{ $expireDate->format('d/m/Y') }}
                            @if (!$isExpired && $daysToExpire <= 7)
                                ({{ $daysToExpire }} giorni)
                            @elseif ($isExpired)
                                (Scaduto)
                            @endif
                        </span>
                    </div>
                    <div class="col-6">
                        <strong>Associazione:</strong> {{ $project->association->name ?? 'N/D' }}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Script per gestire i preferiti --}}
<script>
    function addToFavorites(projectId) {
        // TODO: Implementare la logica per salvare ai preferiti
        console.log('Salvare il progetto ' + projectId + ' ai preferiti');

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
