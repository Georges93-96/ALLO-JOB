<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Support\Facades\Auth;

class ProviderDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Missions ouvertes (open) - à afficher au prestataire
        $openMissions = Mission::where('status', 'open')
            ->latest()
            ->take(10)
            ->get();

        // Missions assignées à ce prestataire (si tu utilises assigned_provider_id)
        $assignedMissions = Mission::where('assigned_provider_id', $user->id)
            ->latest()
            ->take(10)
            ->get();

        return view('provider.dashboard', compact('openMissions', 'assignedMissions'));
    }
}
