<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = \App\Models\Game::where('published', true)->get();
        return view('player.games.index', compact('games'));
    }

    public function show(\App\Models\Game $game)
    {
        if (!$game->published) {
            abort(404);
        }
        return view('player.games.play', compact('game'));
    }
}
