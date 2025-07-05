@extends('layouts.master')

@section('active_viaggiare', 'active')

@section('body')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 3rem;"></i>
                    </div>
                    <h1 class="display-5 fw-bold text-dark mb-3">
                        Delete Project
                    </h1>
                    <h2 class="h4 text-muted mb-3">
                        "{{ $project->title }}"
                    </h2>
                    <p class="lead text-danger">
                        <i class="bi bi-info-circle me-2"></i>
                        This action cannot be undone. Please confirm your choice.
                    </p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="card border-danger shadow-sm h-100">
                    <div class="card-header bg-danger text-white text-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-trash me-2"></i>Confirm Deletion
                        </h5>
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <div class="mb-4">
                            <i class="bi bi-exclamation-diamond-fill text-danger mb-3" style="font-size: 2.5rem;"></i>
                            <p class="text-dark mb-0">
                                The project <strong class="text-danger">will be permanently removed</strong> from the database.
                            </p>
                        </div>
                        <div class="mt-auto">
                            <form name="project.delete" method="post"
                                action="{{ route('project.destroy', ['id' => $project->id]) }}">
                                @method('DELETE')
                                @csrf
                                <label for="mySubmit" class="btn btn-danger btn-lg px-4">
                                    <i class="bi bi-trash me-2"></i>Delete Project
                                </label>
                                <input id="mySubmit" class="d-none" type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-header bg-success text-white text-center">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-arrow-left-circle me-2"></i>Cancel Operation
                        </h5>
                    </div>
                    <div class="card-body text-center d-flex flex-column">
                        <div class="mb-4">
                            <i class="bi bi-shield-check-fill text-success mb-3" style="font-size: 2.5rem;"></i>
                            <p class="text-dark mb-0">
                                The project <strong class="text-success">will remain safe</strong> in the database.
                            </p>
                        </div>
                        <div class="mt-auto">
                            <a class="btn btn-success btn-lg px-4" href="{{ route('project.index') }}">
                                <i class="bi bi-arrow-left me-2"></i>Keep Project
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-auto">
                <a href="{{ route('project.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-list me-2"></i>Back to Projects List
                </a>
            </div>
        </div>
    </div>
@endsection
