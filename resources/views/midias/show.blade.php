@extends('layouts.app')

@section('content')
    <div class="container-fluid px-3">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-eye-fill text-primary me-2 fs-4"></i>
            <h2 class="mb-0 fw-bold">Detalhes da Mídia</h2>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h3 class="card-title fw-bold mb-2">{{ $midia->nome }}</h3>
                    <span class="badge bg-primary fs-6">
                        <i class="bi bi-{{ $midia->categoria == 'filme' ? 'camera-reels' : 'tv' }} me-1"></i>
                        {{ ucfirst($midia->categoria) }}
                    </span>
                </div>

                @if ($midia->descricao)
                    <div class="mb-4">
                        <h6 class="fw-semibold text-muted mb-2">Descrição</h6>
                        <p class="text-secondary mb-0">{{ $midia->descricao }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <h6 class="fw-semibold text-muted mb-3">Status</h6>
                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge {{ $midia->assistido ? 'bg-success' : 'bg-secondary' }} fs-6 py-2 px-3">
                            <i class="bi bi-{{ $midia->assistido ? 'check-circle-fill' : 'clock' }} me-1"></i>
                            {{ $midia->assistido ? 'Assistido' : 'Não Assistido' }}
                        </span>
                        <span class="badge {{ $midia->baixado ? 'bg-info' : 'bg-secondary' }} fs-6 py-2 px-3">
                            <i class="bi bi-{{ $midia->baixado ? 'download' : 'cloud-arrow-down' }} me-1"></i>
                            {{ $midia->baixado ? 'Baixado' : 'Não Baixado' }}
                        </span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <small class="text-muted">
                            <i class="bi bi-calendar-plus me-1"></i>
                            <strong>Cadastrado em:</strong> {{ $midia->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    @if ($midia->updated_at != $midia->created_at)
                        <div class="col-12">
                            <small class="text-muted">
                                <i class="bi bi-pencil-square me-1"></i>
                                <strong>Última atualização:</strong> {{ $midia->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-6 col-md-3">
                <a href="{{ route('midias.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i>
                    Voltar
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="{{ route('midias.edit', $midia) }}" class="btn btn-outline-warning w-100">
                    <i class="bi bi-pencil me-1"></i>
                    Editar
                </a>
            </div>
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-{{ $midia->assistido ? 'outline-danger' : 'outline-success' }} w-100"
                    data-bs-toggle="modal" data-bs-target="#assistidoModal">
                    <i class="bi bi-{{ $midia->assistido ? 'x-circle' : 'check-circle' }} me-1"></i>
                    {{ $midia->assistido ? 'Desmarcar' : 'Assistido' }}
                </button>
            </div>
            <div class="col-6 col-md-3">
                <button type="button" class="btn btn-{{ $midia->baixado ? 'outline-danger' : 'outline-info' }} w-100"
                    data-bs-toggle="modal" data-bs-target="#baixadoModal">
                    <i class="bi bi-{{ $midia->baixado ? 'x-circle' : 'download' }} me-1"></i>
                    {{ $midia->baixado ? 'Desmarcar' : 'Baixado' }}
                </button>
            </div>
        </div>

        <div class="modal fade" id="assistidoModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-{{ $midia->assistido ? 'x-circle' : 'check-circle' }} me-2"></i>
                            Confirmar Ação
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">
                            Deseja realmente {{ $midia->assistido ? 'desmarcar como assistido' : 'marcar como assistido' }}
                            <strong>"{{ $midia->nome }}"</strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('midias.assistido', $midia) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $midia->assistido ? 'danger' : 'success' }}">
                                Sim, {{ $midia->assistido ? 'desmarcar' : 'marcar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="baixadoModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-{{ $midia->baixado ? 'x-circle' : 'download' }} me-2"></i>
                            Confirmar Ação
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">
                            Deseja realmente {{ $midia->baixado ? 'desmarcar como baixado' : 'marcar como baixado' }}
                            <strong>"{{ $midia->nome }}"</strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="{{ route('midias.baixado', $midia) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $midia->baixado ? 'danger' : 'warning' }}">
                                Sim, {{ $midia->baixado ? 'desmarcar' : 'marcar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
