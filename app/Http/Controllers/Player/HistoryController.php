<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller;
use App\Models\GameSession;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $sessions = GameSession::with(['game', 'user'])
            ->orderBy('result', 'desc')
            ->get();

        return view('player.history.index', compact('sessions'));
    }
}
