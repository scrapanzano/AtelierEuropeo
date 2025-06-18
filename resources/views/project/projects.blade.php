@extends('layouts.master')

@section('title', "AE - Viaggiare all'Estero")

@section('active_viaggiare', 'active')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <p>
                    <a href="{{ route('project.create') }}" class="btn btn-success">
                        <i class="bi bi-database-add"></i>
                        Crete new project
                    </a>
                </p>
            </div>
        </div>


        <div class="row">
            @foreach ($projectsList as $project)
                <div class="col col-lg-3">
                    <div class="card border-0 shadow-sm" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->getTitle() }}</h5>
                            <p class="text-muted">da Davide Leone</p>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, ratione.
                            </p>
                            <a class="btn btn-primary"
                                href="{{ route('project.edit', ['project' => $project->getId()]) }}"><i
                                    class="bi bi-pencil-square"></i> Edit</a>
                            <a class="btn btn-danger"
                                href="{{ route('project.destroy.confirm', ['id' => $project->getId()]) }}"><i
                                    class="bi bi-trash"></i> Delete</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
