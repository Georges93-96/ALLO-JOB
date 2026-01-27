<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProviderDashboardController extends Controller
{
    public function index()
    {
        $provider = Auth::user();


        // Missions ouvertes (non assignées)
        $openMissions = Mission::where('status', 'open')->latest()->take(10)->get();

        // Missions assignées à ce prestataire
        $assignedMissions = Mission::where('assigned_provider_id', $provider->id)->get();

        return view('provider.dashboard', compact(
            'openMissions',
            'assignedMissions'
        ));
    }
}
