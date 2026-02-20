@extends('layouts.master')

@section('title', 'AE - Dashboard Admin')

@section('breadcrumb')
<div class="bg-light py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    @if(app()->getLocale() === 'it')
                        Dashboard Admin
                    @else
                        Admin Dashboard
                    @endif
                </li>
            </ol>
        </nav>
    </div>
</div>
@endsection

@section('body')
<div class="container py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-2">
                <i class="bi bi-speedometer2 me-2 text-primary"></i>
                @if(app()->getLocale() === 'it')
                    Dashboard Amministratore
                @else
                    Admin Dashboard
                @endif
            </h1>
            <p class="text-muted">
                @if(app()->getLocale() === 'it')
                    Gestisci tutti i progetti dell'organizzazione
                @else
                    Manage all organization projects
                @endif
            </p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('project.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                @if(app()->getLocale() === 'it')
                    Nuovo Progetto
                @else
                    New Project
                @endif
            </a>
        </div>
    </div>

    <!-- Alert per messaggi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistiche -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-folder-fill text-primary fs-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="h4 mb-0 fw-bold">{{ $projects->count() }}</div>
                            <div class="text-muted small text-uppercase">
                                @if(app()->getLocale() === 'it')
                                    Totale Progetti
                                @else
                                    Total Projects
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-eye-fill text-success fs-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="h4 mb-0 fw-bold">{{ $projects->where('status', 'published')->count() }}</div>
                            <div class="text-muted small text-uppercase">
                                @if(app()->getLocale() === 'it')
                                    Pubblicati
                                @else
                                    Published
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-pencil-fill text-secondary fs-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="h4 mb-0 fw-bold">{{ $projects->where('status', 'draft')->count() }}</div>
                            <div class="text-muted small text-uppercase">
                                @if(app()->getLocale() === 'it')
                                    Bozze
                                @else
                                    Drafts
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-info fs-2"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="h4 mb-0 fw-bold">{{ $projects->where('status', 'completed')->count() }}</div>
                            <div class="text-muted small text-uppercase">
                                @if(app()->getLocale() === 'it')
                                    Completati
                                @else
                                    Completed
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabella progetti -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="bi bi-list-ul me-2"></i>
                        @if(app()->getLocale() === 'it')
                            Elenco Progetti
                        @else
                            Projects List
                        @endif
                    </h5>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control form-control-sm" id="searchProject" 
                           placeholder="{{ app()->getLocale() === 'it' ? 'Cerca progetto...' : 'Search project...' }}">
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            @if($projects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" id="projectsTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 5%;">ID</th>
                                <th scope="col" style="width: 30%;">
                                    @if(app()->getLocale() === 'it')
                                        Titolo
                                    @else
                                        Title
                                    @endif
                                </th>
                                <th scope="col" style="width: 15%;">
                                    @if(app()->getLocale() === 'it')
                                        Categoria
                                    @else
                                        Category
                                    @endif
                                </th>
                                <th scope="col" style="width: 15%;">
                                    @if(app()->getLocale() === 'it')
                                        Paese
                                    @else
                                        Country
                                    @endif
                                </th>
                                <th scope="col" style="width: 10%;">
                                    @if(app()->getLocale() === 'it')
                                        Stato
                                    @else
                                        Status
                                    @endif
                                </th>
                                <th scope="col" style="width: 10%;">
                                    @if(app()->getLocale() === 'it')
                                        Scadenza
                                    @else
                                        Deadline
                                    @endif
                                </th>
                                <th scope="col" class="text-center" style="width: 15%;">
                                    @if(app()->getLocale() === 'it')
                                        Azioni
                                    @else
                                        Actions
                                    @endif
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td class="align-middle">
                                        <span class="badge bg-secondary">{{ $project->id }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            @if($project->image_path)
                                                <img src="{{ $project->image_url }}" 
                                                     alt="{{ $project->title }}" 
                                                     class="rounded me-2"
                                                     style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center"
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold">{{ Str::limit($project->title, 40) }}</div>
                                                @if($project->association)
                                                    <small class="text-muted">
                                                        <i class="bi bi-building"></i> {{ $project->association->name }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        @if($project->category)
                                            @php
                                                $categoryColors = [
                                                    'ESC' => 'success',  // Corpo Europeo di Solidarietà
                                                    'YTH' => 'primary',  // Scambi Giovanili
                                                    'TRG' => 'warning'   // Corsi di Formazione
                                                ];
                                                $badgeColor = $categoryColors[$project->category->tag] ?? 'secondary';
                                            @endphp
                                            <span class="badge rounded-pill bg-{{ $badgeColor }}">
                                                {{ $project->category->name }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <i class="bi bi-geo-alt-fill text-muted"></i>
                                        {{ $project->location }}
                                    </td>
                                    <td class="align-middle">
                                        @php
                                            $statusConfig = [
                                                'published' => ['badge' => 'success', 'icon' => 'eye-fill', 'text_it' => 'Pubblicato', 'text_en' => 'Published'],
                                                'draft' => ['badge' => 'secondary', 'icon' => 'pencil   \-fill', 'text_it' => 'Bozza', 'text_en' => 'Draft'],
                                                'completed' => ['badge' => 'info', 'icon' => 'check-circle-fill', 'text_it' => 'Completato', 'text_en' => 'Completed']
                                            ];
                                            $config = $statusConfig[$project->status] ?? $statusConfig['draft'];
                                        @endphp
                                        <span class="badge bg-{{ $config['badge'] }}">
                                            <i class="bi bi-{{ $config['icon'] }} me-1"></i>
                                            @if(app()->getLocale() === 'it')
                                                {{ $config['text_it'] }}
                                            @else
                                                {{ $config['text_en'] }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        @if($project->expire_date)
                                            <small>
                                                {{ $project->expire_date->format('d/m/Y') }}
                                            </small>
                                            @if($project->expire_date->isPast() && $project->status !== 'completed')
                                                <br><small class="text-danger"><i class="bi bi-exclamation-circle"></i> 
                                                    @if(app()->getLocale() === 'it')
                                                        Scaduto
                                                    @else
                                                        Expired
                                                    @endif
                                                </small>
                                            @endif
                                        @else
                                            <small class="text-muted">-</small>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- Dettagli -->
                                            <a href="{{ route('project.show', $project->id) }}" 
                                               class="btn btn-outline-primary"
                                               title="{{ app()->getLocale() === 'it' ? 'Visualizza dettagli' : 'View details' }}"
                                               data-bs-toggle="tooltip">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            
                                            <!-- Modifica (solo se non completato) -->
                                            @if($project->status !== 'completed')
                                                <a href="{{ route('project.edit', $project->id) }}" 
                                                   class="btn btn-outline-secondary"
                                                   title="{{ app()->getLocale() === 'it' ? 'Modifica' : 'Edit' }}"
                                                   data-bs-toggle="tooltip">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            @else
                                                <button type="button" 
                                                        class="btn btn-outline-secondary" 
                                                        disabled
                                                        title="{{ app()->getLocale() === 'it' ? 'Progetto completato' : 'Project completed' }}"
                                                        data-bs-toggle="tooltip">
                                                    <i class="bi bi-lock"></i>
                                                </button>
                                            @endif
                                            
                                            <!-- Elimina -->
                                            <a href="{{ route('project.destroy.confirm', $project->id) }}" 
                                               class="btn btn-outline-danger"
                                               title="{{ app()->getLocale() === 'it' ? 'Elimina' : 'Delete' }}"
                                               data-bs-toggle="tooltip">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-folder-x text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">
                        @if(app()->getLocale() === 'it')
                            Nessun progetto disponibile. Crea il primo progetto!
                        @else
                            No projects available. Create your first project!
                        @endif
                    </p>
                    <a href="{{ route('project.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>
                        @if(app()->getLocale() === 'it')
                            Crea Progetto
                        @else
                            Create Project
                        @endif
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Inizializza i tooltip di Bootstrap
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Funzionalità di ricerca nella tabella
        const searchInput = document.getElementById('searchProject');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                const table = document.getElementById('projectsTable');
                const rows = table.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endsection
