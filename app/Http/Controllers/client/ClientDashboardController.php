<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mission;

class ClientDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // 🔎 Base query: missions du client connecté
        $query = Mission::where('client_id', $user->id)->latest();

        // (Optionnel) filtre status via ?status=open/assigned/done
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // (Optionnel) recherche via ?q=...
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // ✅ IMPORTANT: paginate() pour que ->links() marche
        $myMissions = $query->paginate(10);

        // ✅ STATS
        $stats = [
            'total' => Mission::where('client_id', $user->id)->count(),
            'open' => Mission::where('client_id', $user->id)->where('status', 'open')->count(),
            'assigned' => Mission::where('client_id', $user->id)->where('status', 'assigned')->count(),
            'done' => Mission::where('client_id', $user->id)->where('status', 'done')->count(),
        ];

        return view('client.dashboard', compact('myMissions', 'stats'));
    }
}
