<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        // adapte si tu as plusieurs types prestataires
        if (str_starts_with($role, 'provider')) {
            return redirect()->route('provider.dashboard');
        }

        if ($role === 'client') {
            return redirect()->route('client.dashboard');
        }

        // fallback
        return view('dashboard');
    }
}
