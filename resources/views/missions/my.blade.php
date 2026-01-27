<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes missions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if($missions->count() === 0)
                <div class="bg-white p-6 rounded shadow">
                    Tu n’as pas encore créé de mission.
                    <div class="mt-3">
                        <a class="text-blue-600 underline" href="{{ route('missions.create') }}">Créer une mission</a>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($missions as $m)
                        <div class="bg-white p-6 rounded shadow">
                            <h3 class="text-lg font-semibold">{{ $m->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Type: {{ $m->type }} — Budget: {{ $m->budget ?? 'N/A' }} — Status: {{ $m->status }}
                            </p>
                            @if($m->type === 'physical')
                                <p class="text-sm mt-1">📍 {{ $m->ville }} - {{ $m->quartier }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $missions->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>