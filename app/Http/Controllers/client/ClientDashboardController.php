<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Mission;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // IMPORTANT: paginate() sinon ->links() casse
        $myMissions = Mission::where('client_id', $userId)
            ->latest()
            ->paginate(10);

        // Stats (facultatif)
        $stats = [
            'total' => Mission::where('client_id', $userId)->count(),
            'open' => Mission::where('client_id', $userId)->where('status', 'open')->count(),
            'assigned' => Mission::where('client_id', $userId)->where('status', 'assigned')->count(),
        ];

        return view('client.dashboard', compact('myMissions', 'stats'));
    }
}
