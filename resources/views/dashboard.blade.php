<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Dashboard Prestataire
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto space-y-8">

        <!-- Missions ouvertes -->
        <div>
            <h3 class="text-lg font-bold mb-4">Missions disponibles</h3>

            <div class="grid md:grid-cols-2 gap-4">
                @forelse($openMissions as $mission)
                    <div class="bg-white border rounded-xl p-4">
                        <div class="font-semibold">{{ $mission->title }}</div>
                        <div class="text-sm text-gray-600 mt-1">
                            {{ $mission->ville ?? '—' }} | {{ $mission->type }}
                        </div>
                        <div class="text-sm mt-2">
                            Budget : <b>{{ number_format($mission->budget, 0) }} FCFA</b>
                        </div>

                        <a href="{{ route('missions.show', $mission->id) }}"
                           class="inline-block mt-3 text-brand-green font-semibold">
                            Voir détails →
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">Aucune mission disponible.</p>
                @endforelse
            </div>
        </div>

        <!-- Missions assignées -->
        <div>
            <h3 class="text-lg font-bold mb-4">Mes missions assignées</h3>

            @forelse($assignedMissions as $mission)
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-3">
                    <div class="font-semibold">{{ $mission->title }}</div>
                    <div class="text-sm text-gray-600">
                        Statut : <b>{{ $mission->status }}</b>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Aucune mission assignée.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
