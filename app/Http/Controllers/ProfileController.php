<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ville' => 'required|string|max:100',
            'quartier' => 'required|string|max:150',
            'metier' => 'required|string|max:150',
            'tarif' => 'nullable|numeric',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profiles', 'public');
        }

        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'ville' => $request->ville,
                'quartier' => $request->quartier,
                'metier' => $request->metier,
                'tarif' => $request->tarif,
                'bio' => $request->bio,
                'photo' => $photoPath ?? optional(Profile::where('user_id', Auth::id())->first())->photo,
            ]
        );


        return redirect()->route('dashboard')
            ->with('success', 'Profil enregistré avec succès');
    }





    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ajoute ici phone, etc si besoin
        ]);

        $user->update($data);

        return back()->with('status', 'Profil mis à jour avec succès.');
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('status', 'Compte supprimé.');
    }

    // si tu utilises Route::post('/profile/store', ...) garde ceci

}
