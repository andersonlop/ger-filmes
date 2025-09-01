<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Gerenciador de Filmes') }}</title>

    <!-- Removed gradient background and glass effects for clean design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .mobile-container {
            max-width: 428px;
            margin: 0 auto;
            min-height: 100vh;
            background: white;
        }

        .navbar-brand {
            font-weight: 700;
            color: #495057 !important;
        }

        .nav-pills .nav-link {
            border-radius: 8px;
            font-weight: 500;
            color: #6c757d;
        }

        .nav-pills .nav-link.active {
            background-color: #0d6efd;
            color: white;
        }

        .btn-primary {
            border-radius: 8px;
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .card {
            border-radius: 12px;
            border: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="mobile-container">
        <!-- Simplified header with clean Bootstrap navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i class="bi bi-film me-2 text-primary"></i>
                    Meus Filmes & Séries
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Clean navigation tabs -->
        <div class="bg-white border-bottom">
            <div class="container-fluid">
                <ul class="nav nav-pills nav-fill py-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">
                            <i class="bi bi-graph-up me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('midias.*') && !request()->routeIs('midias.create') ? 'active' : '' }}"
                            href="{{ route('midias.index') }}">
                            <i class="bi bi-collection me-1"></i>
                            Mídias
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('midias.create') ? 'active' : '' }}"
                            href="{{ route('midias.create') }}">
                            <i class="bi bi-plus-lg me-1"></i>
                            Adicionar
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <main class="container-fluid py-4">
            <!-- Simplified alert messages -->
            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
