<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Game;
use App\Models\GameSession;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_games' => Game::count(),
            'total_sessions' => GameSession::count(),
            'recent_sessions' => GameSession::with(['user', 'game'])->orderBy('created_at', 'desc')->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
