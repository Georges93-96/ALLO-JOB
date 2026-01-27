<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Client</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez vos missions et vos candidatures</p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('missions.create') }}"
                   class="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                    + Publier une mission
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white border rounded-2xl p-5">
                    <div class="text-sm text-gray-500">Total missions</div>
                    <div class="text-2xl font-bold mt-1">{{ $stats['total'] ?? $myMissions->total() }}</div>
                </div>
                <div class="bg-white border rounded-2xl p-5">
                    <div class="text-sm text-gray-500">Ouvertes</div>
                    <div class="text-2xl font-bold mt-1">{{ $stats['open'] ?? 0 }}</div>
                </div>
                <div class="bg-white border rounded-2xl p-5">
                    <div class="text-sm text-gray-500">En cours</div>
                    <div class="text-2xl font-bold mt-1">{{ $stats['assigned'] ?? 0 }}</div>
                </div>
                <div class="bg-white border rounded-2xl p-5">
                    <div class="text-sm text-gray-500">Terminées</div>
                    <div class="text-2xl font-bold mt-1">{{ $stats['done'] ?? 0 }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- SIDEBAR --}}
                <aside class="lg:col-span-3">
                    <div class="bg-white border rounded-2xl p-5">
                        <div class="font-semibold text-gray-800">Navigation</div>

                        <div class="mt-4 space-y-2 text-sm">
                            <a href="{{ route('client.dashboard') }}"
                               class="block rounded-lg px-3 py-2 hover:bg-gray-50 text-gray-700">
                                Mes missions
                            </a>
                            <a href="{{ route('missions.create') }}"
                               class="block rounded-lg px-3 py-2 hover:bg-gray-50 text-gray-700">
                                Publier une mission
                            </a>
                            <a href="{{ route('profile.edit') }}"
                               class="block rounded-lg px-3 py-2 hover:bg-gray-50 text-gray-700">
                                Mon profil
                            </a>
                        </div>

                        <div class="mt-6 pt-4 border-t">
                            <div class="text-xs text-gray-500">Astuce</div>
                            <p class="text-sm text-gray-600 mt-1">
                                Plus ta mission est précise, plus tu reçois de bonnes candidatures.
                            </p>
                        </div>
                    </div>
                </aside>

                {{-- MAIN --}}
                <section class="lg:col-span-9">
                    <div class="bg-white border rounded-2xl p-6">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Mes missions</h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    Retrouvez toutes vos missions et suivez leur statut.
                                </p>
                            </div>

                            {{-- (Optionnel) recherche simple --}}
                            <form method="GET" action="{{ route('client.dashboard') }}" class="w-full md:w-auto">
                                <div class="flex gap-2">
                                    <input type="text" name="q" value="{{ request('q') }}"
                                           placeholder="Rechercher une mission..."
                                           class="w-full md:w-64 rounded-lg border-gray-300 focus:border-green-600 focus:ring-green-600">
                                    <button class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-gray-50">
                                        Rechercher
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- FILTER TABS --}}
                        <div class="mt-6 flex flex-wrap gap-2">
                            @php
                                $active = request('status');
                                $tabClass = fn($isActive) => $isActive
                                    ? 'bg-gray-900 text-white'
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200';
                            @endphp

                            <a href="{{ route('client.dashboard') }}"
                               class="px-3 py-2 rounded-full text-sm font-semibold {{ $tabClass(!$active) }}">
                                Toutes
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'open']) }}"
                               class="px-3 py-2 rounded-full text-sm font-semibold {{ $tabClass($active === 'open') }}">
                                Ouvertes
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'assigned']) }}"
                               class="px-3 py-2 rounded-full text-sm font-semibold {{ $tabClass($active === 'assigned') }}">
                                En cours
                            </a>
                            <a href="{{ route('client.dashboard', ['status' => 'done']) }}"
                               class="px-3 py-2 rounded-full text-sm font-semibold {{ $tabClass($active === 'done') }}">
                                Terminées
                            </a>
                        </div>

                        {{-- LIST --}}
                        <div class="mt-6 space-y-4">
                            @forelse($myMissions as $mission)

                                @php
                                    $status = $mission->status ?? 'open';

                                    $badge = match ($status) {
                                        'open' => 'bg-green-100 text-green-800',
                                        'assigned' => 'bg-blue-100 text-blue-800',
                                        'done' => 'bg-gray-200 text-gray-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                        default => 'bg-gray-100 text-gray-700',
                                    };

                                    $statusLabel = match ($status) {
                                        'open' => 'Ouverte',
                                        'assigned' => 'En cours',
                                        'done' => 'Terminée',
                                        'cancelled' => 'Annulée',
                                        default => ucfirst($status),
                                    };
                                @endphp

                                <div class="border rounded-2xl p-5 hover:bg-gray-50 transition">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-3">
                                                <h4 class="font-bold text-gray-900 truncate">
                                                    {{ $mission->title }}
                                                </h4>
                                                <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $badge }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </div>

                                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                                {{ $mission->description }}
                                            </p>

                                            <div class="mt-3 flex flex-wrap gap-3 text-xs text-gray-500">
                                                <span>Budget : <b class="text-gray-700">{{ $mission->budget }}</b></span>
                                                <span>Type : <b class="text-gray-700">{{ $mission->type }}</b></span>

                                                @if(!empty($mission->ville))
                                                    <span>Ville : <b class="text-gray-700">{{ $mission->ville }}</b></span>
                                                @endif

                                                @if(!empty($mission->quartier))
                                                    <span>Quartier : <b class="text-gray-700">{{ $mission->quartier }}</b></span>
                                                @endif

                                                @if($mission->created_at)
                                                    <span>Créée : <b class="text-gray-700">{{ $mission->created_at->format('d/m/Y') }}</b></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex flex-col sm:flex-row gap-2 shrink-0">
                                            {{-- Mets ici tes routes réelles si tu les as --}}
                                            <a href="{{ route('missions.applications', $mission->id) }}"
                                               class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-white">
                                                Candidatures
                                            </a>

                                            {{-- Exemple: si tu as une page show --}}
                                            {{-- <a href="{{ route('missions.show', $mission->id) }}"
                                               class="rounded-lg border px-3 py-2 text-sm font-semibold hover:bg-white">
                                                Détails
                                            </a> --}}
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="border rounded-2xl p-8 text-center">
                                    <div class="text-lg font-semibold text-gray-800">Aucune mission pour le moment</div>
                                    <p class="text-sm text-gray-500 mt-2">
                                        Publie une mission pour commencer à recevoir des candidatures.
                                    </p>

                                    <div class="mt-4">
                                        <a href="{{ route('missions.create') }}"
                                           class="inline-flex items-center rounded-lg bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                                            + Publier une mission
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-6">
                            {{ $myMissions->withQueryString()->links() }}
                        </div>

                    </div>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>
