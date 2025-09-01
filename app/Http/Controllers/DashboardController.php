<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();

        $estatisticas = [
            'total_filmes' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Filme')->count(),
            'total_series' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Serie')->count(),
            'filmes_assistidos' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Filme')->where('assistido', true)->count(),
            'series_assistidas' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Serie')->where('assistido', true)->count(),
            'filmes_baixados' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Filme')->where('baixado', true)->count(),
            'series_baixadas' => Midia::where('usuario_id', $usuarioId)->where('categoria', 'Serie')->where('baixado', true)->count(),
        ];

        return view('dashboard', compact('estatisticas'));
    }
}