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
@endsection
