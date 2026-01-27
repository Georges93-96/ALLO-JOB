<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function create()
    {
        $services = Service::orderBy('type')->orderBy('name')->get();
        return view('missions.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:virtual,physical',
            'service_id' => 'required|exists:services,id',
            'title' => 'required|string|max:160',
            'description' => 'required|string',
            'budget' => 'nullable|numeric',
            'ville' => 'nullable|string|max:100',
            'quartier' => 'nullable|string|max:150',
        ]);

        if ($request->type === 'physical') {
            $request->validate([
                'ville' => 'required|string|max:100',
                'quartier' => 'required|string|max:150',
            ]);
        }

        Mission::create([
            'client_id' => Auth::id(),
            'type' => $request->type,
            'service_id' => $request->service_id,
            'title' => $request->title,
            'description' => $request->description,
            'budget' => $request->budget,
            'ville' => $request->ville,
            'quartier' => $request->quartier,
            'status' => 'open',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Mission créée avec succès');
    }

    public function index()
{
    $user = Auth::user();  // Récupérer l'utilisateur authentifié

    // Vérifier si l'utilisateur est bien un prestataire
    if (!in_array($user->role, ['provider_virtual', 'provider_physical'])) {
        return redirect()->route('dashboard');
    }

    // Déterminer le type de mission que le prestataire peut voir
    $type = null;
    if ($user->role === 'provider_virtual') {
        $type = 'virtual';
    }
    if ($user->role === 'provider_physical') {
        $type = 'physical';
    }

    // Récupérer les missions ouvertes
    $missions = Mission::where('type', $type)
        ->where('status', 'open')
        ->latest()
        ->paginate(10);

    // Récupérer les ID des missions auxquelles le prestataire a déjà postulé
    $appliedMissionIds = \App\Models\Application::where('provider_id', $user->id)
        ->pluck('mission_id') // Récupérer uniquement les mission_id
        ->toArray(); // Convertir en tableau

    // Passer la variable $type, $appliedMissionIds et $user à la vue
    return view('missions.index', compact('missions', 'type', 'appliedMissionIds', 'user'));
}



    public function my()
    {
        $missions = Mission::where('client_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('missions.my', compact('missions'));
    }
    //focntion d'assignation de traveaux

    public function assign(Request $request, Mission $mission)
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est bien un client
        if ($user->role !== 'client') {
            return redirect()->route('dashboard')->withErrors('Seul un client peut attribuer une mission.');
        }

        // Vérifier que la mission est bien ouverte
        if ($mission->status !== 'open') {
            return back()->withErrors('Cette mission n\'est plus disponible.');
        }

        // Vérifier que la mission n'a pas déjà été assignée
        if ($mission->assigned_provider_id) {
            return back()->withErrors('Cette mission a déjà été assignée.');
        }

        // Valider et assigner le prestataire sélectionné
        $validated = $request->validate([
            'provider_id' => 'required|exists:users,id',
        ]);

        // Assigner le prestataire et changer le statut de la mission
        $mission->assigned_provider_id = $validated['provider_id'];
        $mission->status = 'assigned';  // Changer le statut
        $mission->save();

        return redirect()->route('missions.index')->with('success', 'Mission attribuée avec succès !');
    }
}
