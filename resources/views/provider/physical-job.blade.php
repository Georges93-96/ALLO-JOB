<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profil prestataire physique
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('profile.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Ville</label>
                        <input name="ville" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Quartier</label>
                        <input name="quartier" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Métier</label>
                        <input name="metier" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Tarif (FCFA)</label>
                        <input name="tarif" type="number" class="w-full border p-2">
                    </div>

                    <div class="mb-4">
                        <label>Bio</label>
                        <textarea name="bio" class="w-full border p-2"></textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>