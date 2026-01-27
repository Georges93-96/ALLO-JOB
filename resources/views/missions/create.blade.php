<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer une mission
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('missions.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Type de mission</label>
                        <select name="type" class="w-full border p-2">
                            <option value="virtual">Virtuelle</option>
                            <option value="physical">Physique</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Service</label>
                        <select name="service_id" class="w-full border p-2">
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">
                                    {{ strtoupper($service->type) }} - {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Titre</label>
                        <input name="title" class="w-full border p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Description</label>
                        <textarea name="description" class="w-full border p-2" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label>Budget (FCFA)</label>
                        <input type="number" name="budget" class="w-full border p-2">
                    </div>

                    <div class="mb-4">
                        <label>Ville (si mission physique)</label>
                        <input name="ville" class="w-full border p-2">
                    </div>

                    <div class="mb-4">
                        <label>Quartier (si mission physique)</label>
                        <input name="quartier" class="w-full border p-2">
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Publier la mission
                    </button>
                </form>

            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn-secondary mb-4 inline-flex">⬅ Retour</a>
    </div>
</x-app-layout>