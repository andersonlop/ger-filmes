@extends('layouts.app')

@section('content')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center">
                <i class="bi bi-graph-up text-primary me-2 fs-5"></i>
                <div>
                    <h2 class="h5 mb-0 fw-bold">Dashboard</h2>
                    <small class="text-muted">Acompanhe suas estatísticas</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2 mb-3">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-film text-primary fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-primary">{{ $estatisticas['total_filmes'] }}</h3>
                    <small class="text-muted">Filmes</small>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-tv text-info fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-info">{{ $estatisticas['total_series'] }}</h3>
                    <small class="text-muted">Séries</small>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-check-circle text-success fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-success">{{ $estatisticas['filmes_assistidos'] }}</h3>
                    <small class="text-muted">Filmes Assistidos</small>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-check-circle text-success fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-success">{{ $estatisticas['series_assistidas'] }}</h3>
                    <small class="text-muted">Séries Assistidas</small>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-download text-warning fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-warning">{{ $estatisticas['filmes_baixados'] }}</h3>
                    <small class="text-muted">Filmes Baixados</small>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card h-100">
                <div class="card-body text-center py-2">
                    <i class="bi bi-download text-warning fs-3 mb-1"></i>
                    <h3 class="h4 mb-0 fw-bold text-warning">{{ $estatisticas['series_baixadas'] }}</h3>
                    <small class="text-muted">Séries Baixadas</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body py-2">
            <h3 class="h6 fw-bold mb-2">Ações Rápidas</h3>
            <div class="d-grid gap-1">
                <a href="{{ route('midias.create') }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-2"></i>
                    Adicionar Nova Mídia
                </a>
                <a href="{{ route('midias.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-list me-2"></i>
                    Ver Todas as Mídias
                </a>
            </div>
        </div>
    </div>
@endsection
