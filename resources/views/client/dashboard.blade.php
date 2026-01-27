<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('profile.custom') }}" class="btn-secondary">Mon profil</a>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Client
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- STATS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="bg-white border rounded-xl p-4">
                    <div class="text-sm text-gray-500">Total missions</div>
                    <div class="text-2xl font-bold">{{ $stats['total'] ?? 0 }}</div>
                </div>
                <div class="bg-white border rounded-xl p-4">
                    <div class="text-sm text-gray-500">Ouvertes</div>
                    <div class="text-2xl font-bold">{{ $stats['open'] ?? 0 }}</div>
                </div>
                <div class="bg-white border rounded-xl p-4">
                    <div class="text-sm text-gray-500">Assignées</div>
                    <div class="text-2xl font-bold">{{ $stats['assigned'] ?? 0 }}</div>
                </div>
            </div>

            <div class="bg-white rounded-xl border p-6">
                <h3 class="text-lg font-bold mb-4">Mes missions</h3>

                <div class="space-y-3">
                    @forelse($myMissions as $mission)
                    <div class="border rounded-xl p-4 flex items-start justify-between gap-4">
                        <div>
                            <div class="font-semibold">{{ $mission->title }}</div>
                            <div class="text-sm text-gray-600 mt-1">{{ $mission->description }}</div>
                            <div class="text-sm text-gray-500 mt-2">
                                Budget : {{ $mission->budget }} |
                                Type : {{ $mission->type }} |
                                Statut : {{ $mission->status }}
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600">Aucune mission pour le moment.</p>
                    @endforelse
                </div>
    
                <div class="mt-6">
                    {{ $myMissions->links() }}
                </div>
            </div>
            
        </div>
      
    </div>
        <a href="{{ url()->previous() }}" class="btn-secondary mb-4 inline-flex">⬅ Retour</a>
</x-app-layout>