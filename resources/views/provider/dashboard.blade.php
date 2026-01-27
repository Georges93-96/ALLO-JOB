<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('profile.custom') }}" class="btn-secondary">Mon profil</a>

        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Prestataire
            </h2>
            <a href="{{ url('/missions') }}" class="text-sm text-gray-600 hover:text-gray-900">Voir toutes les missions</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white border rounded-xl p-6">
                <h3 class="text-lg font-bold mb-4">Missions disponibles</h3>

                <div class="grid md:grid-cols-2 gap-4">
                    @forelse($openMissions as $mission)
                        <div class="border rounded-xl p-4">
                            <div class="font-semibold">{{ $mission->title }}</div>
                            <div class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $mission->description }}</div>
                            <div class="text-sm text-gray-500 mt-2">
                                Budget: {{ $mission->budget }} | Type: {{ $mission->type }}
                            </div>
                            <div class="mt-3 flex gap-2">
                                <a class="bg-brand-green text-white hover:opacity-90 rounded-xl px-4 py-2 font-semibold text-sm"
                                   href="{{ url('/missions/'.$mission->id) }}">Détails</a>
                                <button class="border bg-white hover:bg-gray-50 rounded-xl px-4 py-2 font-semibold text-sm">
                                    Postuler
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">Aucune mission ouverte pour le moment.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white border rounded-xl p-6">
                <h3 class="text-lg font-bold mb-4">Mes missions assignées</h3>

                <div class="space-y-3">
                    @forelse($assignedMissions as $mission)
                        <div class="border rounded-xl p-4">
                            <div class="font-semibold">{{ $mission->title }}</div>
                            <div class="text-sm text-gray-500 mt-2">Statut: {{ $mission->status }}</div>
                        </div>
                    @empty
                        <p class="text-gray-600">Aucune mission assignée.</p>
                    @endforelse
                </div>
            </div>

        </div>
        <a href="{{ url()->previous() }}" class="btn-secondary mb-4 inline-flex">⬅ Retour</a>

    </div>
</x-app-layout>
