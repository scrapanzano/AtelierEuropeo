@extends('layouts.master')

@section('title', 'AE - Project Details')

@section('active_progetti', 'active')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                @php
                    $projectCategory = [
                        'ESC' => 'Corpo Europeo di Solidarietà',
                        'YTH' => 'Scambi Giovanili',
                        'TRG' => 'Corsi di Formazione',
                    ];

                    $category = $project->category;
                    $breadcrumbCategory = $projectCategory[$category->tag];
                @endphp
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">Progetti
                        Disponibili</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">
                        {{ $breadcrumbCategory }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $project->title }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
    <div class="container px-2 px-md-4 pb-5">
        <div class="hero-section d-flex align-items-center justify-content-center mb-4 px-2"
            style="background-image: url('{{ asset('img/progetti/elf-start.png') }}'); min-height: 220px;">
            <div class="hero-overlay"></div>
            <div class="container position-relative text-center text-white py-4 py-md-5">
                <h1 class="section-title">{{ $project->title }}</h1>
            </div>
        </div>
        <div class="row py-2 py-md-3 mb-3 g-2 align-items-center">
            <div class="col-8 col-md-6">
                <h3 class="fw-bold mb-0 fs-4 fs-md-3">Informazioni essenziali</h3>
            </div>
            <div class="col-4 col-md-6 text-end">
                <button type="button" class="btn btn-outline-primary btn-rounded d-inline-flex align-items-center px-3 py-2"><i
                        class="bi bi-heart me-2 fs-4"></i> Salva</button>
            </div>
        </div>
        <ul class="list-unstyled mb-4">
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-person-fill me-2"></i> <span>{{
                    $project->requested_people }} persona/e</span></li>
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-geo-alt-fill me-2"></i> <span>{{
                    $project->location }}</span></li>
            <li class="mb-2 d-flex align-items-center flex-wrap"><i class="bi bi-calendar-event-fill me-2"></i> <span>Da
                    {{ $project->start_date }} a {{ $project->end_date }}</span></li>
            <li class="text-danger d-flex align-items-center flex-wrap"><i class="bi bi-calendar2-x-fill me-2"></i> <span>Scadenza:
                    {{ $project->expire_date }}</span></li>
        </ul>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Chi è l'associazione {{ $project->association->name }}</h3>
        <p class="lead">{{ $project->association->description}}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Il viaggio in pillole</h3>
        <p class="lead">{{ $project->full_description }}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Requisiti di partecipazione</h3>
        <p class="lead">{{ $project->requirements }}</p>
        <h3 class="fw-bold py-3 fs-4 fs-md-3">Condizioni economiche e di viaggio</h3>
        <p class="lead">{{ $project->travel_conditions }}</p>
        <div class="container text-center">
            <h1 class="fw-bold py-3 fs-3 fs-md-2">Presenta la tua candidatura!</h1>
            <button class="btn btn-primary btn-lg btn-rounded px-4 py-2"><i class="bi bi-bookmark-plus-fill"></i>
                Canditati</button>
        </div>
    </div>
@endsection
