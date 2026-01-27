<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ALLO JOB</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/Allojob.png') }}" alt="ALLO JOB" class="h-10 w-auto">
            <div class="leading-tight hidden sm:block">
                <div class="text-xs text-gray-500">Jobs physiques & virtuels — inclusif</div>
            </div>
        </a>

        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="#how" class="text-gray-600 hover:text-gray-900">Comment ça marche</a>
            <a href="#jobs" class="text-gray-600 hover:text-gray-900">Missions</a>
            <a href="#ai" class="text-gray-600 hover:text-gray-900">IA</a>

            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-secondary">Déconnexion</button>
                </form>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Connexion</a>
                <a href="{{ route('register') }}" class="btn-primary">Inscription</a>
            @endguest
        </nav>

        <div class="md:hidden flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-primary px-4 py-2">Dashboard</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn-secondary px-4 py-2">Connexion</a>
                <a href="{{ route('register') }}" class="btn-primary px-4 py-2">Inscription</a>
            @endguest
        </div>

    </div>
</header>

<main>

    <!-- HERO + SLIDER -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <div>
                <div class="badge-yellow">
                    Plateforme d’accès au travail — pour tous
                </div>

                <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight">
                    Trouver un job à faire aujourd’hui, <br class="hidden sm:block">
                    physique ou virtuel.
                </h1>

                <p class="mt-4 text-gray-600 text-base sm:text-lg">
                    ALLO JOB connecte clients et prestataires à des missions locales et des services en ligne :
                    réparation, ménage, livraison, graphisme, développement, rédaction…
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    @guest
                        <a href="{{ route('register') }}" class="btn-primary">Créer un compte</a>
                        <a href="{{ route('login') }}" class="btn-secondary">Connexion</a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary">Aller au Dashboard</a>
                    @endauth

                    <a href="{{ url('/missions') }}" class="btn-secondary">Voir les missions</a>
                </div>

                <div class="mt-6 grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm">
                    <div class="bg-white border rounded-xl p-4">
                        <div class="font-semibold">Physique</div>
                        <div class="text-gray-600 mt-1">Plombier, mécano, ménage…</div>
                    </div>
                    <div class="bg-white border rounded-xl p-4">
                        <div class="font-semibold">Virtuel</div>
                        <div class="text-gray-600 mt-1">Graphiste, dev, saisie…</div>
                    </div>
                    <div class="bg-white border rounded-xl p-4 hidden sm:block">
                        <div class="font-semibold">Inclusif</div>
                        <div class="text-gray-600 mt-1">Accessible, simple</div>
                    </div>
                </div>
            </div>

            <!-- SLIDER -->
            <div
                x-data="{
                    i: 0,
                    imgs: [
                        '{{ asset('images/hero/01.jpg') }}',
                        '{{ asset('images/hero/02.jpg') }}',
                        '{{ asset('images/hero/03.jpg') }}',
                        '{{ asset('images/hero/04.jpg') }}',
                        '{{ asset('images/hero/05.jpg') }}'
                    ],
                    next(){ this.i = (this.i + 1) % this.imgs.length; },
                    prev(){ this.i = (this.i - 1 + this.imgs.length) % this.imgs.length; },
                    start(){ setInterval(() => this.next(), 3500); }
                }"
                x-init="start()"
                class="bg-white border rounded-2xl shadow-sm overflow-hidden"
            >
                <div class="relative h-72 sm:h-80 lg:h-[420px]">
                    <template x-for="(img, idx) in imgs" :key="idx">
                        <img
                            :src="img"
                            class="absolute inset-0 w-full h-full object-cover transition-opacity duration-700"
                            :class="i === idx ? 'opacity-100' : 'opacity-0'"
                            alt="ALLO JOB"
                        >
                    </template>

                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>

                    <button @click="prev()" class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center">
                        ‹
                    </button>
                    <button @click="next()" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white rounded-full w-10 h-10 flex items-center justify-center">
                        ›
                    </button>

                    <div class="absolute bottom-3 left-0 right-0 flex justify-center gap-2">
                        <template x-for="(img, idx) in imgs" :key="'dot'+idx">
                            <button @click="i = idx" class="w-2.5 h-2.5 rounded-full"
                                :style="i===idx ? 'background:#FFC24A' : 'background:rgba(255,255,255,0.7)'">
                            </button>
                        </template>
                    </div>
                </div>

                <div class="p-5">
                    <div class="text-sm text-gray-500">Exemple mission</div>
                    <div class="text-xl font-bold mt-1">Réparation rapide</div>
                    <div class="mt-3 text-sm text-gray-600">
                        Lomé — Adidogomé <br>
                        Budget : 3 500 FCFA <br>
                        Type : Physique
                    </div>

                    <div class="mt-4 p-4 rounded-xl bg-gray-50 text-gray-700 text-sm">
                        “Je cherche quelqu’un disponible aujourd’hui pour une réparation.”
                    </div>

                    <div class="mt-5 flex gap-2">
                        <button class="flex-1 btn-primary">Postuler</button>
                        <button class="btn-secondary">Détails</button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- HOW -->
    <section id="how" class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold" style="color:#0F6B4A;">Comment ça marche</h2>

            <div class="mt-6 grid md:grid-cols-3 gap-6">
                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold" style="color:#FFC24A;">1</div>
                    <div class="mt-2 font-semibold">Publier / choisir</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Le client décrit le besoin : type (physique/virtuel), budget, ville/quartier.
                    </p>
                </div>

                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold" style="color:#FFC24A;">2</div>
                    <div class="mt-2 font-semibold">Postuler</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Les prestataires postulent avec un message + un prix.
                    </p>
                </div>

                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold" style="color:#FFC24A;">3</div>
                    <div class="mt-2 font-semibold">Assigner</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Le client choisit un prestataire : mission assignée.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- AI -->
    <section id="ai" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="rounded-2xl p-8 text-white" style="background:#0F6B4A;">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold">IA Assistant</h2>
                    <p class="text-white/90 mt-2">
                        L’IA aide à rédiger une mission, recommander des prestataires et proposer des jobs adaptés.
                    </p>
                </div>

                <a href="#ai" class="inline-flex items-center justify-center rounded-xl px-5 py-3 font-semibold"
                   style="background:#FFC24A; color:#1f2937;">
                    Tester l’IA (bêta)
                </a>
            </div>
        </div>
    </section>

</main>

<footer class="border-t bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-sm text-gray-600">
        © {{ date('Y') }} ALLO JOB — Connecter. Travailler. Gagner.
    </div>
</footer>

</body>
</html>
