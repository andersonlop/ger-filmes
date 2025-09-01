@extends('layouts.app')

@section('content')
    <div class="container-fluid px-3" style="max-width: 100vw; overflow-x: hidden;">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-collection text-primary fs-4 me-3"></i>
            <div>
                <h4 class="mb-0 fw-bold">Minhas Mídias</h4>
                <small class="text-muted">Gerencie sua coleção</small>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-6 col-md-3">
                        <select name="categoria" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Todas as Categorias</option>
                            <option value="Filme" {{ request('categoria') == 'Filme' ? 'selected' : '' }}>Filmes</option>
                            <option value="Serie" {{ request('categoria') == 'Serie' ? 'selected' : '' }}>Séries</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <select name="assistido" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Todos (Assistido)</option>
                            <option value="1" {{ request('assistido') == '1' ? 'selected' : '' }}>Assistidos</option>
                            <option value="0" {{ request('assistido') == '0' ? 'selected' : '' }}>Não Assistidos
                            </option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <select name="baixado" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="">Todos (Baixado)</option>
                            <option value="1" {{ request('baixado') == '1' ? 'selected' : '' }}>Baixados</option>
                            <option value="0" {{ request('baixado') == '0' ? 'selected' : '' }}>Não Baixados</option>
                        </select>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="input-group input-group-sm">
                            <input type="text" name="busca" class="form-control" placeholder="Buscar..."
                                value="{{ request('busca') }}">
                            <button type="submit" class="btn btn-outline-secondary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @if ($midias->count() > 0)
            <div class="@if ($midias->count() > 2) overflow-y-auto @endif"
                @if ($midias->count() > 2) style="max-height: calc(100vh - 488px); overflow-x: hidden;" @endif>
                <div class="row g-3">
                    @foreach ($midias as $midia)
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0 text-truncate" style="max-width: 70%;">
                                            {{ $midia->nome }}</h5>
                                        <span
                                            class="badge bg-{{ $midia->categoria == 'Filme' ? 'primary' : 'info' }} flex-shrink-0">
                                            <i class="bi bi-{{ $midia->categoria == 'Filme' ? 'film' : 'tv' }} me-1"></i>
                                            {{ $midia->categoria }}
                                        </span>
                                    </div>

                                    @if ($midia->descricao)
                                        <p class="card-text text-muted small mb-3">{{ $midia->descricao }}</p>
                                    @endif

                                    <div class="d-flex gap-2 mb-3 flex-wrap">
                                        <span class="badge bg-{{ $midia->assistido ? 'success' : 'secondary' }}">
                                            <i class="bi bi-{{ $midia->assistido ? 'check-circle' : 'clock' }} me-1"></i>
                                            {{ $midia->assistido ? 'Assistido' : 'Não Assistido' }}
                                        </span>
                                        <span class="badge bg-{{ $midia->baixado ? 'warning' : 'secondary' }}">
                                            <i class="bi bi-{{ $midia->baixado ? 'download' : 'cloud' }} me-1"></i>
                                            {{ $midia->baixado ? 'Baixado' : 'Não Baixado' }}
                                        </span>
                                    </div>

                                    <div class="d-flex flex-wrap gap-1" style="max-width: 100%;">
                                        <a href="{{ route('midias.show', $midia) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('midias.edit', $midia) }}"
                                            class="btn btn-outline-warning btn-sm">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#assistidoModal{{ $midia->id }}">
                                            <i class="bi bi-{{ $midia->assistido ? 'x-circle' : 'check-circle' }}"></i>
                                        </button>

                                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#baixadoModal{{ $midia->id }}">
                                            <i class="bi bi-{{ $midia->baixado ? 'x-circle' : 'download' }}"></i>
                                        </button>

                                        <form method="POST" action="{{ route('midias.destroy', $midia) }}"
                                            class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="assistidoModal{{ $midia->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i
                                                class="bi bi-{{ $midia->assistido ? 'x-circle' : 'check-circle' }} me-2"></i>
                                            Confirmar Ação
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">
                                            Deseja realmente
                                            {{ $midia->assistido ? 'desmarcar como assistido' : 'marcar como assistido' }}
                                            <strong>"{{ $midia->nome }}"</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="{{ route('midias.assistido', $midia) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-{{ $midia->assistido ? 'danger' : 'success' }}">
                                                Sim, {{ $midia->assistido ? 'desmarcar' : 'marcar' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="baixadoModal{{ $midia->id }}" tabindex="-1">
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
                                            Deseja realmente
                                            {{ $midia->baixado ? 'desmarcar como baixado' : 'marcar como baixado' }}
                                            <strong>"{{ $midia->nome }}"</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <form method="POST" action="{{ route('midias.baixado', $midia) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-{{ $midia->baixado ? 'danger' : 'warning' }}">
                                                Sim, {{ $midia->baixado ? 'desmarcar' : 'marcar' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-collection text-muted fs-1 mb-3"></i>
                    <p class="text-muted mb-3">Nenhuma mídia encontrada.</p>
                    <a href="{{ route('midias.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-1"></i>
                        Adicionar Primeira Mídia
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
