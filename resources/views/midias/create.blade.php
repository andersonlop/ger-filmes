@extends('layouts.app')

@section('content')
    <!-- Removed container-fluid and simplified header -->
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-plus-circle text-primary fs-4 me-3"></i>
        <div>
            <h4 class="mb-0 fw-bold">Adicionar Mídia</h4>
            <small class="text-muted">Adicione um novo filme ou série</small>
        </div>
    </div>

    <!-- Simplified form card without shadows and gradients -->
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('midias.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label fw-semibold">
                        Nome do Filme/Série <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="nome" name="nome"
                        class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}"
                        placeholder="Digite o nome do filme ou série" required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label fw-semibold">
                        Categoria <span class="text-danger">*</span>
                    </label>
                    <select id="categoria" name="categoria" class="form-select @error('categoria') is-invalid @enderror"
                        required>
                        <option value="">Selecione uma categoria</option>
                        <option value="Filme" {{ old('categoria') == 'Filme' ? 'selected' : '' }}>Filme</option>
                        <option value="Serie" {{ old('categoria') == 'Serie' ? 'selected' : '' }}>Série</option>
                    </select>
                    @error('categoria')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descricao" class="form-label fw-semibold">
                        Descrição <small class="text-muted">(Opcional)</small>
                    </label>
                    <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="4"
                        placeholder="Adicione uma descrição, sinopse ou suas impressões...">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Simplified button layout -->
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('midias.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>
                        Salvar Mídia
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
