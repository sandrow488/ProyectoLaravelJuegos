<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class GameController extends Controller
{
    /**
     * Escanea la carpeta public/games/ y devuelve los juegos disponibles
     * con su URL relativa para servir desde el navegador.
     */
    private function getAvailableGameFiles(): array
    {
        $gamesPath = public_path('games');
        $available = [];

        if (!File::isDirectory($gamesPath)) {
            return $available;
        }

        foreach (File::directories($gamesPath) as $gameDir) {
            $gameName = basename($gameDir);
            // Buscar index.html en /dist o directamente en la carpeta
            foreach (['/dist/index.html', '/index.html'] as $suffix) {
                $fullPath = $gameDir . $suffix;
                if (File::exists($fullPath)) {
                    $url = '/games/' . $gameName . $suffix;
                    $available[$url] = $gameName . ' (' . $suffix . ')';
                    break;
                }
            }
        }

        return $available;
    }

    public function index()
    {
        $games = Game::withCount('sessions')->orderBy('created_at', 'desc')->get();
        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        $availableFiles = $this->getAvailableGameFiles();
        return view('admin.games.create', compact('availableFiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'url'         => 'required|string',
            'image'       => 'nullable|string|max:500',
        ]);

        Game::create([
            'title'       => $request->title,
            'description' => $request->description ?? '',
            'url'         => $request->url,
            'image'       => $request->image ?: '/images/runner_thumb.png',
            'published'   => $request->boolean('published', true),
            'user_id'     => Auth::id(),
        ]);

        return redirect()->route('admin.games.index')->with('success', '¡Juego "' . $request->title . '" creado y publicado!');
    }

    public function edit(Game $game)
    {
        $availableFiles = $this->getAvailableGameFiles();
        return view('admin.games.edit', compact('game', 'availableFiles'));
    }

    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'url'         => 'required|string',
            'image'       => 'nullable|string|max:500',
        ]);

        $game->update([
            'title'       => $request->title,
            'description' => $request->description ?? '',
            'url'         => $request->url,
            'image'       => $request->image ?: $game->image,
            'published'   => $request->boolean('published', true),
        ]);

        return redirect()->route('admin.games.index')->with('success', 'Juego actualizado correctamente.');
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games.index')->with('success', 'Juego eliminado.');
    }
}
