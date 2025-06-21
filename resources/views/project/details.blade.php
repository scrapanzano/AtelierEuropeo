@extends('layouts.master')

@section('title', 'AE - Project Details')

@section('active_progetti', 'active')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">Progetti Disponibili</a></li>

    @php
        $projectCategory = [
            'ESC' => 'Corpo Europeo di Solidarietà',
            'YTH' => 'Scambi Giovanili',
            'TRG' => 'Corsi di Formazione',
        ];

        $category = $project->getCategory();
        $breadcrumbCategory = $projectCategory[$category];
    @endphp

    <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('project.index') }}">
            {{ $breadcrumbCategory }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $project->getTitle() }}</li>
@endsection

@section('body')
    <div class="container pb-5">
        <div class="hero-section d-flex align-items-center justify-content-center mb-4"
            style="background-image: url('{{ asset('img/progetti/elf-start.png') }}');">
            <div class="hero-overlay"></div>
            <div class="container position-relative text-center text-white py-5">
                <h1 class="section-title">{{ $project->getTitle() }}</h1>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center py-3">
            <h3 class="fw-bold mb-0">Informazioni essenziali</h3>
            <button type="button" class="btn btn-outline-primary btn-rounded d-flex align-items-center"><i
                    class="bi bi-heart me-2 fs-4"></i> Salva</button>
        </div>

        <ul class="list-unstyled">
            <li class="mb-2"><i class="bi bi-person-fill"></i> {{ $project->getRequestedPeople() }} persona/e</li>
            <li class="mb-2"><i class="bi bi-geo-alt-fill"></i> {{ $project->getPlace() }}</li>
            <li class="mb-2"><i class="bi bi-calendar-event-fill"></i> Da {{ $project->getStartDate() }} a
                {{ $project->getEndDate() }}</li>
            <li class="text-danger"><i class="bi bi-calendar2-x-fill"></i> Scadenza: {{ $project->getExpireDate() }}</li>
        </ul>

        <h3 class="fw-bold py-3">Chi è l'associazione {{ $project->getAssociationName() }}</h3>
        <p class="lead">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dignissimos neque tenetur, nostrum
            voluptates enim at, voluptatibus harum exercitationem reprehenderit culpa pariatur dolorem ducimus recusandae
            asperiores, aperiam quasi repellat sequi non? Omnis est consectetur laudantium excepturi, suscipit totam?
            Beatae, minima at.</p>

        <h3 class="fw-bold py-3">Il viaggio in pillole</h3>
        <p class="lead">{{ $project->getFullDescription() }}</p>

        <h3 class="fw-bold py-3">Requisiti di partecipazione</h3>
        <p class="lead">{{ $project->getRequirements() }}</p>

        <h3 class="fw-bold py-3">Condizioni economiche e di viaggio</h3>
        <p class="lead">{{ $project->getTravelConditions() }}</p>

        <div class="container text-center">
            <h1 class="fw-bold py-3">Presenta la tua candidatura!</h1>
            <button class="btn btn-primary btn-lg btn-rounded"><i class="bi bi-bookmark-plus-fill"></i> Canditati</button>
        </div>
    </div>
@endsection
