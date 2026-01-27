<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    // Prestataire postule
    public function store(Request $request, Mission $mission  )
    {
        $user = Auth::user();

        // Vérifs rôle
        if (!in_array($user->role, ['provider_virtual', 'provider_physical'])) {
            abort(403);
        }

        // Vérif compatibilité type mission
        $allowedType = $user->role === 'provider_virtual' ? 'virtual' : 'physical';
        if ($mission->type !== $allowedType) {
            abort(403);
        }

        // Mission doit être ouverte
        if ($mission->status !== 'open') {
            return back()->withErrors(['mission' => 'Cette mission n’est plus ouverte.']);
        }

        $request->validate([
            'proposed_price' => 'nullable|numeric',
            'message' => 'nullable|string|max:1000',
        ]);

        Application::updateOrCreate(
            ['mission_id' => $mission->id, 'provider_id' => $user->id],
            [
                'proposed_price' => $request->proposed_price,
                'message' => $request->message,
                'status' => 'pending',
            ]
        );

        return back()->with('success', 'Candidature envoyée.');
    }

    // Client voit les candidatures d’une mission
    public function index(Mission $mission)
    {
        $user = Auth::user();
        if ($mission->client_id !== $user->id) {
            abort(403);
        }

        $applications = $mission->applications()->with('provider')->latest()->get();

        return view('applications.index', compact('mission', 'applications'));
    }

    // Client accepte une candidature => mission assigned
    public function accept(Mission $mission, Application $application)
    {
        $user = Auth::user();
        if ($mission->client_id !== $user->id) abort(403);

        // sécurité: candidature doit appartenir à la mission
        if ($application->mission_id !== $mission->id) abort(404);

        if ($mission->status !== 'open') {
            return back()->withErrors(['mission' => 'Mission déjà assignée ou fermée.']);
        }

        // Accepter celle-ci
        $application->update(['status' => 'accepted']);

        // Rejeter les autres
        Application::where('mission_id', $mission->id)
            ->where('id', '!=', $application->id)
            ->update(['status' => 'rejected']);

        // Assigner mission
        $mission->update([
            'status' => 'assigned',
            'assigned_provider_id' => $application->provider_id,
        ]);

        return back()->with('success', 'Prestataire assigné à la mission.');
    }
}