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
            </div>            <div class="col-4 col-md-6 text-end">
                <a href="{{ route('project.create') }}"
                    class="btn btn-success btn-rounded d-inline-flex align-items-center px-3 py-2 px-md-4">
                    <i class="bi bi-plus-circle me-2 fs-5"></i>
                    <span class="d-none d-sm-inline">Crea Progetto</span>
                    <span class="d-inline d-sm-none">Crea</span>
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($projectsList as $project)
                <div class="col-12 col-sm-6 col-lg-4 mb-4 d-flex">
                    <div class="card border-0 shadow-sm rounded-4 position-relative h-100 d-flex flex-column w-100">
                        <a href="{{ route('project.show', ['project' => $project->getID()]) }}" class="stretched-link"></a>
                        @php
                            $categoryColors = [
                                'ESC' => 'text-bg-success',
                                'YTH' => 'text-bg-primary',
                                'TRG' => 'text-bg-warning',
                            ];
                            $category = $project->getCategory();
                            $badgeColor = $categoryColors[$category];
                        @endphp
                        <span class="badge badge-project {{ $badgeColor }} fw-bold">{{ $category }}</span>
                        <i class="bi bi-heart badge-favourite text-white"></i>
                        <div class="position-relative">
                            <img src="{{ asset('img/progetti/elf-start.png') }}"
                                class="card-img-top rounded-top-4 card-img-bright" alt="...">
                            <div class="card-img-gradient rounded-top-4"></div>
                            <span class="badge badge-bottom-left fw-bold">
                                <i class="bi bi-calendar-event me-1"></i>10 giorni
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">{{ $project->getTitle() }}</h4>
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
                            </div>
                            <p class="card-text pt-2">{{ $project->getSumDescription() }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
