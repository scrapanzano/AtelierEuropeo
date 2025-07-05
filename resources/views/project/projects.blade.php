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
            @if (auth()->check() && auth()->user()->role === 'project_admin')
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

        <!-- Search and Filter Form -->
        <div class="row py-3">
            <div class="col-12">
                <form method="GET" action="{{ route('project.index') }}" id="filterForm" class="bg-light p-3 rounded shadow-sm">
                    <div class="row g-2 align-items-end">
                        <!-- Category Filter -->
                        <div class="col-6 col-md-2">
                            <select class="form-select filter-select" id="category" name="category_id">
                                <option value="">Categoria</option>
                                @if (isset($categories))
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->tag }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Association Filter -->
                        <div class="col-6 col-md-2">
                            <select class="form-select filter-select" id="association" name="association_id">
                                <option value="">Associazione</option>
                                @if (isset($associations))
                                    @foreach ($associations as $association)
                                        <option value="{{ $association->id }}"
                                            {{ request('association_id') == $association->id ? 'selected' : '' }}>
                                            {{ $association->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- Location Filter -->
                        <div class="col-8 col-md-2">
                            <input type="text" class="form-control filter-input" id="location" name="location"
                                placeholder="Località..." value="{{ request('location') }}">
                        </div>

                        <!-- Status Filter (only for project_admin) -->
                        @if (auth()->check() && auth()->user()->role === 'project_admin')
                            <div class="col-6 col-md-2">
                                <select class="form-select filter-select" id="status" name="status">
                                    <option value="">Stato</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bozza</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Pubblicato</option>
                                </select>
                            </div>
                        @endif

                        <!-- Search Bar (moved to right) -->
                        <div class="col-12 {{ auth()->check() && auth()->user()->role === 'project_admin' ? 'col-md-4' : 'col-md-6' }}">
                            <div class="input-group">
                                <input type="text" class="form-control filter-input" id="search" name="search"
                                    placeholder="Cerca progetti..." value="{{ request('search') }}">
                                <button type="button" class="btn btn-outline-secondary" onclick="clearAllFilters()">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Active Filters Display -->
                @if(request()->hasAny(['search', 'category_id', 'association_id', 'location', 'status']))
                    <div class="mt-3">
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <small class="text-muted fw-semibold">Filtri attivi:</small>
                            
                            @if(request('search'))
                                <span class="badge bg-primary d-flex align-items-center gap-1">
                                    Ricerca: "{{ request('search') }}"
                                    <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6rem;" onclick="clearFilter('search')"></button>
                                </span>
                            @endif

                            @if(request('category_id') && isset($categories))
                                @php
                                    $selectedCategory = $categories->where('id', request('category_id'))->first();
                                @endphp
                                @if($selectedCategory)
                                    <span class="badge bg-info d-flex align-items-center gap-1">
                                        Categoria: {{ $selectedCategory->tag }}
                                        <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6rem;" onclick="clearFilter('category_id')"></button>
                                    </span>
                                @endif
                            @endif

                            @if(request('association_id') && isset($associations))
                                @php
                                    $selectedAssociation = $associations->where('id', request('association_id'))->first();
                                @endphp
                                @if($selectedAssociation)
                                    <span class="badge bg-success d-flex align-items-center gap-1">
                                        Associazione: {{ $selectedAssociation->name }}
                                        <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6rem;" onclick="clearFilter('association_id')"></button>
                                    </span>
                                @endif
                            @endif

                            @if(request('location'))
                                <span class="badge bg-warning d-flex align-items-center gap-1">
                                    Località: "{{ request('location') }}"
                                    <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6rem;" onclick="clearFilter('location')"></button>
                                </span>
                            @endif

                            @if(request('status'))
                                <span class="badge bg-secondary d-flex align-items-center gap-1">
                                    Stato: {{ request('status') == 'draft' ? 'Bozza' : 'Pubblicato' }}
                                    <button type="button" class="btn-close btn-close-white ms-1" style="font-size: 0.6rem;" onclick="clearFilter('status')"></button>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <script>
            // Auto-submit form when filters change
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('filterForm');
                const filterSelects = document.querySelectorAll('.filter-select');
                const filterInputs = document.querySelectorAll('.filter-input');

                // Auto-submit on select change
                filterSelects.forEach(select => {
                    select.addEventListener('change', function() {
                        form.submit();
                    });
                });

                // Auto-submit on input with debounce
                filterInputs.forEach(input => {
                    let timeout;
                    input.addEventListener('input', function() {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            form.submit();
                        }, 500); // 500ms debounce
                    });
                });
            });

            // Clear specific filter
            function clearFilter(filterName) {
                const url = new URL(window.location);
                url.searchParams.delete(filterName);
                window.location.href = url.toString();
            }

            // Clear all filters
            function clearAllFilters() {
                window.location.href = '{{ route("project.index") }}';
            }
        </script>

        <!-- Container principale: row-cols per griglia su desktop, flex-nowrap per scroll su mobile -->
        <div class="row flex-lg-wrap flex-nowrap overflow-auto pb-3 gx-4">
            @forelse ($projectsList as $project)
                <!-- Card container: dimensioni reattive e flex-shrink-0 per scroll -->
                <div class="col-9 col-sm-7 col-md-5 col-lg-4 mb-4 flex-shrink-0 flex-lg-shrink-1">
                    @if (auth()->check())
                        @if (auth()->user()->role === 'project_admin')
                            <x-project-card :project="$project" :showAdminOptions="true" :showFavoriteIcon="false" />
                        @else
                            <x-project-card :project="$project" :showAdminOptions="false" :showFavoriteIcon="true" />
                        @endif
                    @else
                        <x-project-card :project="$project" :showAdminOptions="false" :showFavoriteIcon="true" />
                    @endif
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Nessun progetto trovato con i criteri di ricerca selezionati.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection