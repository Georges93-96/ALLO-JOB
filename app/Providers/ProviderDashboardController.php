<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Missions ouvertes (disponibles)
        $openMissions = Mission::where('status', 'open')
            ->latest()
            ->take(10)
            ->get();

        // Mes missions assignées (si tu utilises assigned_provider_id)
        $myAssignedMissions = Mission::where('assigned_provider_id', $userId)
            ->latest()
            ->take(10)
            ->get();

        return view('provider.dashboard', compact('openMissions', 'myAssignedMissions'));
    }
}
