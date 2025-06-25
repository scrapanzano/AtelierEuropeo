@props(['project', 'showOptions' => false])

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
    <span class="badge badge-project {{ $badgeColor }} fw-bold">{{ $category->tag }}</span>
    <i class="bi bi-heart badge-favourite text-white"></i>
    <div class="position-relative">
        <img src="{{ asset('img/progetti/elf-start.png') }}"
            class="card-img-top rounded-top-4 card-img-bright" alt="...">
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
                        $remainingDays = $durationDays % 30;

                        $durationText = $months . ' ' . ($months == 1 ? 'mese' : 'mesi');
                        if ($remainingDays > 0) {
                            $durationText .= ' e ' . $remainingDays . ' ' . ($remainingDays == 1 ? 'giorno' : 'giorni');
                        }
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
            @if($showOptions)
                <div class="dropdown">
                    <button class="btn p-0 position-relative" style="z-index: 2;" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false" title="Opzioni">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li><a class="dropdown-item py-2 text-primary" href="#"><i
                                    class="bi bi-pen-fill me-2"></i> Modifica</a></li>
                        <li>
                            <hr class="dropdown-divider my-1">
                        </li>
                        <li><a class="dropdown-item py-2 text-danger" href="#" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmModal"><i class="bi bi-trash-fill me-2"></i>
                                Elimina</a></li>
                    </ul>
                </div>
            @endif
        </div>
        <p class="card-text pt-2">{{ $project->sum_description }}</p>
    </div>
</div>
