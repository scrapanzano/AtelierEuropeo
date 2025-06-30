@extends('layouts.master')

@section('title')
    @if (isset($project))
        AE - Edit Project
    @else
        AE - Add New Project
    @endif
@endsection

@section('active_progetti', 'active')

@section('body')
    <div class="container-fluid px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <!-- Simple Header -->
                <div class="mb-4">
                    <h2 class="mb-2 text-primary">
                        <i class="bi bi-folder me-2"></i>
                        @if (isset($project))
                            Edit Project
                        @else
                            Create New Project
                        @endif
                    </h2>
                    <p class="text-muted">
                        @if (isset($project))
                            Modify the details of "{{ $project->title }}"
                        @else
                            Fill in the information to create a new project
                        @endif
                    </p>
                </div>

                <!-- Form Card -->
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        @if (isset($project))
                            <form class="needs-validation" name="project" method="post"
                                action="{{ route('project.update', ['id' => $project->id]) }}" novalidate>
                                @method('PUT')
                        @else
                            <form class="needs-validation" name="project" method="post" action="{{ route('project.store') }}" novalidate>
                        @endif
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-primary border-bottom border-primary border-opacity-25 pb-2">
                                <i class="bi bi-info-circle me-2"></i>Basic Information
                            </h5>
                            
                            <div class="row g-3">
                                <!-- Title -->
                                <div class="col-12">
                                    <label for="title" class="form-label fw-medium">
                                        Project Title <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('title') is-invalid @enderror"
                                        type="text" name="title" id="title"
                                        value="{{ old('title', $project->title ?? '') }}"
                                        placeholder="Enter a descriptive project title" required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category and Association Row -->
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label fw-medium">
                                        Category <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        name="category_id" id="category_id" required>
                                        <option value="">Choose a category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('category_id', $project->category_id ?? '') == $category->id) selected @endif>
                                                {{ $category->tag }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="association_id" class="form-label fw-medium">
                                        Association <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select @error('association_id') is-invalid @enderror"
                                        name="association_id" id="association_id" required>
                                        <option value="">Choose an association...</option>
                                        @foreach ($associations as $association)
                                            <option value="{{ $association->id }}"
                                                @if (old('association_id', $project->association_id ?? '') == $association->id) selected @endif>
                                                {{ $association->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('association_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Creator Info -->
                                @if (isset($project))
                                    <div class="col-12">
                                        <label class="form-label fw-medium">Project Creator</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-secondary text-white">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input class="form-control" type="text" 
                                                   value="{{ $project->user->name }}" disabled />
                                        </div>
                                        <small class="text-muted">The project creator cannot be modified</small>
                                    </div>
                                @else
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
                                    <div class="col-12">
                                        <label class="form-label fw-medium">Project Creator</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-success text-white">
                                                <i class="bi bi-person-check"></i>
                                            </span>
                                            <input class="form-control" type="text" 
                                                   value="{{ auth()->user()->name }}" disabled />
                                        </div>
                                        <small class="text-success">You will be set as the project creator</small>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Project Details Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-info border-bottom border-info border-opacity-25 pb-2">
                                <i class="bi bi-gear me-2"></i>Project Details
                            </h5>
                            
                            <div class="row g-3">
                                <!-- Status and People Row -->
                                <div class="col-md-6">
                                    <label for="status" class="form-label fw-medium">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                        <option value="draft" @if (old('status', $project->status ?? 'draft') == 'draft') selected @endif>
                                            Draft
                                        </option>
                                        <option value="published" @if (old('status', $project->status ?? '') == 'published') selected @endif>
                                            Published
                                        </option>
                                        <option value="archived" @if (old('status', $project->status ?? '') == 'archived') selected @endif>
                                            Archived
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="requested_people" class="form-label fw-medium">Requested People</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-info text-white">
                                            <i class="bi bi-people"></i>
                                        </span>
                                        <input class="form-control @error('requested_people') is-invalid @enderror"
                                            type="number" name="requested_people" id="requested_people" min="1"
                                            value="{{ old('requested_people', $project->requested_people ?? '') }}"
                                            placeholder="Number of people needed" />
                                        @error('requested_people')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="col-12">
                                    <label for="location" class="form-label fw-medium">Location</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-warning text-dark">
                                            <i class="bi bi-geo-alt"></i>
                                        </span>
                                        <input class="form-control @error('location') is-invalid @enderror"
                                            type="text" name="location" id="location"
                                            value="{{ old('location', $project->location ?? '') }}"
                                            placeholder="Project location or 'Remote'" />
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dates Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-warning border-bottom border-warning border-opacity-25 pb-2">
                                <i class="bi bi-calendar3 me-2"></i>Important Dates
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input class="form-control @error('start_date') is-invalid @enderror"
                                        type="date" name="start_date" id="start_date"
                                        value="{{ old('start_date', $project->start_date ?? '') }}" />
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input class="form-control @error('end_date') is-invalid @enderror"
                                        type="date" name="end_date" id="end_date"
                                        value="{{ old('end_date', $project->end_date ?? '') }}" />
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="expire_date" class="form-label">Application Deadline</label>
                                    <input class="form-control @error('expire_date') is-invalid @enderror"
                                        type="date" name="expire_date" id="expire_date"
                                        value="{{ old('expire_date', $project->expire_date ?? '') }}" />
                                    @error('expire_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Descriptions Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-success border-bottom border-success border-opacity-25 pb-2">
                                <i class="bi bi-file-text me-2"></i>Project Description
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="sum_description" class="form-label">Summary Description</label>
                                    <textarea class="form-control @error('sum_description') is-invalid @enderror" name="sum_description"
                                        id="sum_description" rows="3" 
                                        placeholder="Write a brief and engaging summary of your project...">{{ old('sum_description', $project->sum_description ?? '') }}</textarea>
                                    @error('sum_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">This will be shown in project lists and previews</div>
                                </div>

                                <div class="col-12">
                                    <label for="full_description" class="form-label">Full Description</label>
                                    <textarea class="form-control @error('full_description') is-invalid @enderror" name="full_description"
                                        id="full_description" rows="6"
                                        placeholder="Provide a detailed description of the project, its goals, activities, and expected outcomes...">{{ old('full_description', $project->full_description ?? '') }}</textarea>
                                    @error('full_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Requirements Section -->
                        <div class="mb-4">
                            <h5 class="mb-3 text-danger border-bottom border-danger border-opacity-25 pb-2">
                                <i class="bi bi-list-check me-2"></i>Requirements & Conditions
                            </h5>
                            
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="requirements" class="form-label">Requirements</label>
                                    <textarea class="form-control @error('requirements') is-invalid @enderror" name="requirements" id="requirements"
                                        rows="4"
                                        placeholder="List the required skills, qualifications, language proficiency, or any prerequisites...">{{ old('requirements', $project->requirements ?? '') }}</textarea>
                                    @error('requirements')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="travel_conditions" class="form-label">Travel Conditions</label>
                                    <textarea class="form-control @error('travel_conditions') is-invalid @enderror" name="travel_conditions"
                                        id="travel_conditions" rows="3"
                                        placeholder="Describe travel arrangements, accommodation details, expense coverage, visa requirements...">{{ old('travel_conditions', $project->travel_conditions ?? '') }}</textarea>
                                    @error('travel_conditions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="border-top border-primary border-opacity-25 pt-4">
                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between">
                                <a class="btn btn-outline-secondary" href="{{ route('project.index') }}">
                                    <i class="bi bi-arrow-left me-2"></i>Cancel & Return
                                </a>
                                @if (isset($project))
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Update Project
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-rocket-takeoff me-2"></i>Launch Your Project
                                    </button>
                                @endif
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
