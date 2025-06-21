@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_progetti', 'active')

@section('body')

    <div class="container py-5">

        <div class="row">
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4 position-relative" style="width: 18rem;">
                    <a href="{{ route('project.show', ['project' => 1]) }}" class="stretched-link"></a>

                    <span class="badge badge-project text-bg-primary fw-bold">TAG</span>
                    <img src="{{ asset('img/progetti/elf-start.png') }}" class="card-img-top rounded-top-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Titolo Progetto</h4>
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
                        <p class="card-text pt-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit, illum!
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
