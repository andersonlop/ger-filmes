@extends('layouts.app')

@section('content')
    <div class="container-fluid px-3">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="mb-1 fw-bold">Editar Mídia</h4>
                <p class="text-muted mb-0 small">Atualize as informações da mídia</p>
            </div>
            <a href="{{ route('midias.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('midias.update', $midia) }}">
                    @csrf
                    @method('PATCH')

                    Nome
                    <div class="mb-4">
                        <label for="nome" class="form-label fw-semibold">
                            <i class="bi bi-film text-primary me-2"></i>Nome do Filme/Série
                        </label>
                        <input type="text" id="nome" name="nome"
                            class="form-control form-control-lg @error('nome') is-invalid @enderror"
                            value="{{ old('nome', $midia->nome) }}" placeholder="Digite o nome..." required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    Categoria
                    <div class="mb-4">
                        <label for="categoria" class="form-label fw-semibold">
                            <i class="bi bi-tag text-success me-2"></i>Categoria
                        </label>
                        <select id="categoria" name="categoria"
                            class="form-select form-select-lg @error('categoria') is-invalid @enderror" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="Filme" {{ old('categoria', $midia->categoria) == 'Filme' ? 'selected' : '' }}>
                                🎬 Filme
                            </option>
                            <option value="Serie" {{ old('categoria', $midia->categoria) == 'Serie' ? 'selected' : '' }}>
                                📺 Série
                            </option>
                        </select>
                        @error('categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    Descrição
                    <div class="mb-4">
                        <label for="descricao" class="form-label fw-semibold">
                            <i class="bi bi-card-text text-info me-2"></i>Descrição
                            <span class="text-muted fw-normal">(Opcional)</span>
                        </label>
                        <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4"
                            placeholder="Adicione uma descrição sobre a mídia...">{{ old('descricao', $midia->descricao) }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('midias.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Atualizar Mídia
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
