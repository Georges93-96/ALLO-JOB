<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Missions du client connecté
        $myMissions = Mission::where('client_id', $userId)
            ->latest()
            ->paginate(10);

        return view('client.dashboard', compact('myMissions'));
    }
}
