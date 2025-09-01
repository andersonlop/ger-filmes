<?php

namespace App\Http\Controllers;

use App\Models\Midia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MidiaController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $query = Midia::where('usuario_id', Auth::id());

        // Filtros
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('assistido')) {
            $query->where('assistido', $request->assistido === '1');
        }

        if ($request->filled('baixado')) {
            $query->where('baixado', $request->baixado === '1');
        }

        if ($request->filled('busca')) {
            $query->where('nome', 'like', '%' . $request->busca . '%');
        }

        $midias = $query->orderBy('created_at', 'desc')->get();

        return view('midias.index', compact('midias'));
    }

    public function create()
    {
        return view('midias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|in:Filme,Serie',
            'descricao' => 'nullable|string',
        ]);

        Midia::create([
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'descricao' => $request->descricao,
            'assistido' => false,
            'baixado' => false,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('midias.index')->with('sucesso', 'Mídia cadastrada com sucesso!');
    }

    public function show(Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }
        return view('midias.show', compact('midia'));
    }

    public function edit(Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }
        return view('midias.edit', compact('midia'));
    }

    public function update(Request $request, Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'categoria' => 'required|in:Filme,Serie',
            'descricao' => 'nullable|string',
        ]);

        $midia->update($request->only(['nome', 'categoria', 'descricao']));

        return redirect()->route('midias.index')->with('sucesso', 'Mídia atualizada com sucesso!');
    }

    public function destroy(Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }
        $midia->delete();

        return redirect()->route('midias.index')->with('sucesso', 'Mídia excluída com sucesso!');
    }

    public function marcarAssistido(Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }
        $midia->update(['assistido' => !$midia->assistido]);

        return redirect()->back()->with('sucesso', 'Status de assistido atualizado!');
    }

    public function marcarBaixado(Midia $midia)
    {
        if ($midia->usuario_id !== Auth::id()) {
            abort(403);
        }
        $midia->update(['baixado' => !$midia->baixado]);

        return redirect()->back()->with('sucesso', 'Status de baixado atualizado!');
    }
}