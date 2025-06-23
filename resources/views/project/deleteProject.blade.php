@extends('layouts.master')

@section('active_viaggiare', 'active')

@section('body')
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-12">
                <header>
                    <h1>
                        Delete project "{{ $project->title }}" from the list
                    </h1>
                </header>
                <p class="confirm">
                    Deleting project. Confirm?
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <div class="card border-secondary">
                    <div class="card-header">
                        Confirm
                    </div>
                    <div class="card-body">
                        <p>
                            The project <strong>will be permanently removed</strong> from the data base
                        </p>
                        <form name="project.delete" method="post"
                            action="{{ route('project.destroy', ['project' => $project->id]) }}">
                            @method('DELETE')
                            @csrf
                            <label for="mySubmit" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Delete">
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 order-md-1">
                <div class="card border-secondary">
                    <div class="card-header">
                        Revert
                    </div>
                    <div class="card-body">
                        <p>
                            The book <strong>will not be removed</strong> from the data base
                        </p>
                        <a class="btn btn-secondary" href="{{ route('book.index') }}"><i class="bi bi-box-arrow-left"></i>
                            Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
