@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_progetti', 'active')

@section('body')

    <div class="container py-5">

        <div class="row">
            <div class="col">
                <div class="card border-0 shadow-sm rounded-4" style="width: 18rem;">
                    <span class="badge badge-project text-bg-primary fw-bold">TAG</span>
                    <img src="{{ asset('img/progetti/elf-start.png') }}" class="card-img-top rounded-top-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Titolo Progetto</h4>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    title="Opzioni">
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
                        <ul class="list-group list-group-flush py-3">
                            <li class="list-group-item"><i class="bi bi-person-fill"></i> Chi</li>
                            <li class="list-group-item"><i class="bi bi-geo-alt-fill"></i> Dove</li>
                            <li class="list-group-item"><i class="bi bi-calendar-fill"></i> Quando</li>
                            <li class="list-group-item text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Scadenza
                            </li>
                        </ul>

                        <div class="container text-center">
                            <a href="#" class="btn btn-primary btn-rounded"><i class="bi bi-info-circle"></i> Info</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
