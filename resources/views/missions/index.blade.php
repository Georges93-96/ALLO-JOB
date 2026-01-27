<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Missions disponibles ({{ $type }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            {{-- Confirmation --}}
            @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($missions->count() === 0)
            <div class="bg-white p-6 rounded shadow">
                Aucune mission disponible pour le moment.
            </div>
            @else
            <div class="space-y-4">
                @foreach($missions as $m)
                <div class="bg-white p-6 rounded shadow">
                    <h3 class="text-lg font-semibold">{{ $m->title }}</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Service ID: {{ $m->service_id }} — Budget: {{ $m->budget ?? 'N/A' }}
                    </p>

                    @if($m->type === 'physical')
                    <p class="text-sm mt-1">📍 {{ $m->ville }} - {{ $m->quartier }}</p>
                    @endif

                    <p class="mt-3 text-gray-800">{{ \Illuminate\Support\Str::limit($m->description, 180) }}</p>

                    {{-- Vérifier si l'utilisateur a déjà postulé à cette mission --}}
                    @if(in_array($m->id, $appliedMissionIds))
                    <div class="mt-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                         Vous avez déjà postulé à cette mission.
                    </div>
                    @else
                    {{-- Formulaire de postuler --}}
                    <form method="POST" action="{{ route('missions.apply', $m->id) }}" class="mt-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="text-sm">Prix proposé (FCFA) (optionnel)</label>
                                <input name="proposed_price" type="number" class="w-full border p-2 rounded" placeholder="Ex: 5000">
                            </div>
                            <div>
                                <label class="text-sm">Message (optionnel)</label>
                                <input name="message" class="w-full border p-2 rounded" placeholder="Je suis disponible aujourd’hui…">
                            </div>
                        </div>
                        <button type="submit" class="mt-3 bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded">
                            Postuler
                        </button>
                    </form>
                    @endif
                </div>
                @endforeach



                {{-- FORMULAIRE POSTULER : bien placé sous la mission --}}
                <form method="POST" action="{{ route('missions.apply', $m->id) }}" class="mt-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm">Prix proposé (FCFA) (optionnel)</label>
                            <input name="proposed_price" type="number" class="w-full border p-2 rounded" placeholder="Ex: 5000">
                        </div>
                        <div>
                            <label class="text-sm">Message (optionnel)</label>
                            <input name="message" class="w-full border p-2 rounded" placeholder="Je suis disponible aujourd’hui…">
                        </div>
                    </div>

                    <button type="submit" class="mt-3 bg-blue-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded">
                        Postuler
                    </button>
                </form>
                

            </div>

        </div>

        <div class="mt-6">
            {{ $missions->links() }}
        </div>
        @endif

    </div>
    <a href="{{ url()->previous() }}" class="btn-secondary mb-4 inline-flex">⬅ Retour</a>
    </div>
</x-app-layout>