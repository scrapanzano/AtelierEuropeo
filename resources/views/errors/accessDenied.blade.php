@extends('layouts.master')

@section('breadcrumb')
    <div class="container d-flex justify-content-start pt-4">
        <nav aria-label="breadcrumb" class="w-100">
            <ol class="breadcrumb bg-light bg-opacity-75 p-3 rounded-4 mb-4 align-items-center">
                <li class="breadcrumb-item" aria-current="page"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Access denied</li>
            </ol>
        </nav>
    </div>
@endsection

@section('body')
    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-danger">
                    <div class='card-header'>
                        <b>Illegal page access:</b> something <strong>wrong</strong> happened while accessing this page!
                    </div>
                    <div class='card-body'>
                        <p>{{ $message }}</p>
                        <p><a class="btn btn-danger" href="{{ route('home') }}"><i class="bi bi-box-arrow-left"></i> Back to
                                home!</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
