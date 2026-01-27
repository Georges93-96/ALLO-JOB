<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl" style="color:#0F6B4A;">Mon Profil</h2>
            <a href="{{ url()->previous() }}" class="btn-secondary">⬅ Retour</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-green-50 border text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border rounded-2xl p-6">
                <div class="flex items-center gap-4">
                    <div class="w-20 h-20 rounded-full overflow-hidden border">
                        @if(optional(auth()->user()->profile)->photo)
                            <img class="w-full h-full object-cover" src="{{ asset('storage/'.auth()->user()->profile->photo) }}" alt="photo">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-500">Photo</div>
                        @endif
                    </div>

                    <div>
                        <div class="text-lg font-bold">{{ auth()->user()->name }}</div>
                        <div class="text-sm text-gray-600">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Photo de profil</label>
                        <input type="file" name="photo" class="mt-1 block w-full">
                        @error('photo') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium">Ville</label>
                            <input name="ville" class="mt-1 w-full rounded-xl border"
                                   value="{{ old('ville', optional(auth()->user()->profile)->ville) }}">
                            @error('ville') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Quartier</label>
                            <input name="quartier" class="mt-1 w-full rounded-xl border"
                                   value="{{ old('quartier', optional(auth()->user()->profile)->quartier) }}">
                            @error('quartier') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Métier / Service</label>
                        <input name="metier" class="mt-1 w-full rounded-xl border"
                               value="{{ old('metier', optional(auth()->user()->profile)->metier) }}">
                        @error('metier') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Tarif (FCFA)</label>
                        <input name="tarif" type="number" class="mt-1 w-full rounded-xl border"
                               value="{{ old('tarif', optional(auth()->user()->profile)->tarif) }}">
                        @error('tarif') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Bio</label>
                        <textarea name="bio" rows="3" class="mt-1 w-full rounded-xl border">{{ old('bio', optional(auth()->user()->profile)->bio) }}</textarea>
                        @error('bio') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <button class="btn-primary w-full" type="submit">
                        Enregistrer mon profil
                    </button>
                </form>
            </div>
        </div>
            <a href="{{ url()->previous() }}" class="btn-secondary mb-4 inline-flex">⬅ Retour</a>
    </div>
</x-app-layout>
