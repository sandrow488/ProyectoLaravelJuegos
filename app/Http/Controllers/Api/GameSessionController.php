<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\GameSession;
use Illuminate\Support\Facades\Auth;

class GameSessionController extends Controller
{
    public function start(Request $request, Game $game)
    {
        $session = GameSession::create([
            'user_id'    => Auth::id(),
            'game_id'    => $game->id,
            'started_at' => now(),
        ]);

        return response()->json([
            'session_id' => $session->id,
            'message'    => 'Sesión iniciada correctamente'
        ]);
    }

    public function update(Request $request, GameSession $session)
    {
        $validated = $request->validate([
            'score'      => 'required|numeric',
            'ended'      => 'boolean',
            'best_score' => 'nullable|numeric',
        ]);

        $session->update([
            'result'     => (int) $validated['score'],
            'best_score' => isset($validated['best_score']) ? (int) $validated['best_score'] : null,
        ]);

        if (!empty($validated['ended'])) {
            $session->update([
                'ended_at' => now(),
                'duration' => now()->diffInSeconds($session->started_at),
            ]);
        }

        return response()->json([
            'message' => 'Partida guardada en tu historial',
            'score'   => $session->result,
        ]);
    }
}
