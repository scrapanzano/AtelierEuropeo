@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_progetti', 'active')

@section('body')

    <div class="container py-5">
        <div class="row">
            @foreach ($projectsList as $project)
                <div class="col">
                    <div class="card border-0 shadow-sm rounded-4 position-relative" style="width: 18rem;">
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
                        <i class="bi bi-heart badge-favourite"></i>

                        <div class="position-relative">
                            <img src="{{ asset('img/progetti/elf-start.png') }}"
                                class="card-img-top rounded-top-4 card-img-bright" alt="...">
                            <div class="card-img-gradient rounded-top-4"></div>
                            <span class="badge badge-bottom-left fw-bold">
                                <i class="bi bi-calendar-event me-1"></i>10 giorni
                            </span>
                        </div>

                        <div class="card-body">
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
