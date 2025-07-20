@extends('layouts.master')

@section('title', __('common.language') . ' Test')

@section('body')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="bi bi-translate me-2"></i>
                        Test Multilingua - {{ __('home.welcome_title') }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>{{ __('common.language') }}</h4>
                            <p><strong>Lingua Corrente:</strong> {{ app()->getLocale() }}</p>
                            <p><strong>Italiano:</strong> {{ app()->getLocale() === 'it' ? '✓ Attiva' : '✗ Non attiva' }}</p>
                            <p><strong>Inglese:</strong> {{ app()->getLocale() === 'en' ? '✓ Attiva' : '✗ Non attiva' }}</p>
                            
                            <h5 class="mt-4">{{ __('common.switch_language') }}</h5>
                            <div class="btn-group" role="group">
                                <a href="{{ route('lang.switch', 'it') }}" 
                                   class="btn {{ app()->getLocale() === 'it' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    🇮🇹 {{ __('common.italian') }}
                                </a>
                                <a href="{{ route('lang.switch', 'en') }}" 
                                   class="btn {{ app()->getLocale() === 'en' ? 'btn-primary' : 'btn-outline-primary' }}">
                                    🇬🇧 {{ __('common.english') }}
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h4>{{ __('home.welcome_title') }}</h4>
                            <p>{{ __('home.welcome_subtitle') }}</p>
                            
                            <h5>Navigazione</h5>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-house"></i> {{ __('common.home') }}</li>
                                <li><i class="bi bi-info-circle"></i> {{ __('common.about') }}</li>
                                <li><i class="bi bi-folder"></i> {{ __('common.projects') }}</li>
                                <li><i class="bi bi-envelope"></i> {{ __('common.contact') }}</li>
                            </ul>
                            
                            <h5>Stati</h5>
                            <ul class="list-unstyled">
                                <li><span class="badge bg-success">{{ __('common.active') }}</span></li>
                                <li><span class="badge bg-warning">{{ __('common.pending') }}</span></li>
                                <li><span class="badge bg-primary">{{ __('common.approved') }}</span></li>
                                <li><span class="badge bg-secondary">{{ __('common.draft') }}</span></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <h4>{{ __('about.values_title') }}</h4>
                            <div class="row">
                                @foreach(__('about.values') as $key => $value)
                                    <div class="col-md-6 col-lg-3 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <h6 class="card-title">{{ $value['title'] }}</h6>
                                                <p class="card-text small">{{ $value['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="alert alert-success">
                                <h5><i class="bi bi-check-circle"></i> {{ __('common.success') }}</h5>
                                <p class="mb-0">
                                    Il sistema multilingua sta funzionando correttamente!
                                </p>
                                <hr>
                                <p class="mb-0">
                                    <strong>Data:</strong> {{ now()->format('d/m/Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
