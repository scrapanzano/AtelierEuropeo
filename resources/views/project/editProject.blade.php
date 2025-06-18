@extends('layouts.master')

@section('title')

    @if (isset($project))
        AE - Edit project
    @else
        AE - Add new project
    @endif
@endsection

@section('active_viaggiare', 'active')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (isset($project))
                    <form class="form-horizontal" name="project" method="post"
                        action="{{ route('project.update', ['project' => $project->getId()]) }}">
                        <!--<input type="hidden" name="_method" value="PUT">-->
                        @method('PUT')
                    @else
                        <form class="form-horizontal" name="project" method="post" action="{{ route('project.store') }}">
                @endif
                @csrf
                <div class="form-group row mb-3">
                    <div class="col-md-2">
                        <label for="title">Title</label>
                    </div>
                    <div class="col-md-10">
                        @if (isset($project))
                            <input class="form-control" type="text" name="title" value="{{ $project->getTitle() }}" />
                        @else
                            <input class="form-control" type="text" name="title" />
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-2">
                        <label for="creatorID">Creator</label>
                    </div>
                    <div class="col-md-10">
                        <select class="form-control" name="creatorID">
                            @foreach ($creatorsList as $creator)
                                @if (isset($project) && $creator->getId() == $project->getCreatorID())
                                    <option value="{{ $creator->getId() }}" selected="selected">{{ $creator->getLastName() }}
                                    </option>
                                @else
                                    <option value="{{ $creator->getId() }}">{{ $creator->getLastName() }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-10 offset-md-2">
                        @if (isset($project))
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                Save</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Save" />
                        @else
                            <label for="mySubmit" class="btn btn-primary w-100"><i class="bi bi-floppy2-fill"></i>
                                Create</label>
                            <input id="mySubmit" class="d-none" type="submit" value="Create" />
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-md-10 offset-md-2">
                        <a class="btn btn-danger w-100" href="{{ route('project.index') }}"><i
                                class="bi bi-box-arrow-left"></i>
                            Cancel</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
