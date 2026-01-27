<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ALLO JOB</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-900 font-sans">

<!-- NAVBAR -->
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/Allojob.png') }}" alt="ALLO JOB" class="h-10 w-auto">
            <div class="leading-tight hidden sm:block">
                <div class="text-xs text-gray-500">Jobs physiques & virtuels — inclusif</div>
            </div>
        </a>

        <!-- Desktop menu -->
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="#how" class="text-gray-600 hover:text-gray-900">Comment ça marche</a>
            <a href="#jobs" class="text-gray-600 hover:text-gray-900">Missions</a>
            <a href="#ai" class="text-gray-600 hover:text-gray-900">AI</a>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-gray-300 text-gray-800 hover:bg-gray-50 transition">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-gray-300 text-gray-800 hover:bg-gray-50 transition">
                    Connexion
                </a>

                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">
                    Inscription
                </a>
            @endauth
        </nav>

        <!-- Mobile menu -->
        <div class="md:hidden flex items-center gap-2">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="px-3 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold">
                    Dashboard
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="px-3 py-2 rounded-xl border border-gray-300 text-sm">
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="px-3 py-2 rounded-xl border border-gray-300 text-sm">
                    Connexion
                </a>

                <a href="{{ route('register') }}"
                   class="px-3 py-2 rounded-xl bg-green-600 text-white text-sm font-semibold">
                    Inscription
                </a>
            @endauth
        </div>

    </div>
</header>

<main>

    <!-- HERO -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
        <div class="grid lg:grid-cols-2 gap-10 items-center">

            <div>
                <div class="inline-flex items-center gap-2 text-sm font-medium bg-white border rounded-full px-3 py-1">
                    <span class="h-2 w-2 rounded-full bg-orange-500"></span>
                    Plateforme d’accès au travail — pour tous
                </div>

                <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight text-gray-900">
                    Trouver un job à faire aujourd’hui, <br class="hidden sm:block">
                    physique ou virtuel.
                </h1>

                <p class="mt-4 text-gray-600 text-base sm:text-lg">
                    ALLO JOB connecte clients et prestataires (y compris personnes vulnérables) à des missions locales
                    et des services en ligne : réparation, ménage, livraison, graphisme, développement, rédaction…
                </p>

                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                    @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">
                            Créer un compte
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-green-600 text-white font-semibold hover:bg-green-700 transition">
                            Aller au dashboard
                        </a>
                    @endguest

                    <a href="{{ route('missions.index') }}"
                       class="inline-flex items-center justify-center px-5 py-3 rounded-2xl border border-gray-300 font-semibold hover:bg-gray-50 transition">
                        Voir les missions
                    </a>

                    <a href="#ai"
                       class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
                        Bouton AI
                    </a>
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

            <!-- Example card -->
            <div class="bg-white border rounded-2xl shadow-sm p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Portail mission</div>
                        <div class="text-xl font-bold mt-1">Réparation rapide</div>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800 font-semibold">
                        OPEN
                    </span>
                </div>

                <div class="mt-4 text-sm text-gray-600">
                    Lomé — Adidogomé <br>
                    Budget : 3 500 FCFA <br>
                    Type : Physique
                </div>

                <div class="mt-4 p-4 rounded-xl bg-gray-50 text-gray-700 text-sm">
                    “Je cherche quelqu’un disponible aujourd’hui pour une réparation.”
                </div>

                <div class="mt-5 flex gap-2">
                    <a href="{{ route('missions.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2 rounded-xl bg-green-600 text-white font-semibold hover:bg-green-700 transition flex-1">
                        Postuler
                    </a>
                    <a href="{{ route('missions.index') }}"
                       class="inline-flex items-center justify-center px-4 py-2 rounded-xl border border-gray-300 font-semibold hover:bg-gray-50 transition">
                        Détails
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- HOW -->
    <section id="how" class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h2 class="text-2xl font-bold text-gray-900">Comment ça marche</h2>

            <div class="mt-6 grid md:grid-cols-3 gap-6">
                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold text-orange-500">1</div>
                    <div class="mt-2 font-semibold">Publier / choisir</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Le client décrit le besoin : service, type (physique/virtuel), budget, ville/quartier.
                    </p>
                </div>

                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold text-orange-500">2</div>
                    <div class="mt-2 font-semibold">Postuler</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Les prestataires disponibles postulent avec un message et un prix proposé.
                    </p>
                </div>

                <div class="border rounded-2xl p-6 bg-white">
                    <div class="text-sm font-semibold text-orange-500">3</div>
                    <div class="mt-2 font-semibold">Assigner</div>
                    <p class="mt-2 text-gray-600 text-sm">
                        Le client choisit un prestataire : la mission devient <b>assigned</b>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- AI -->
    <section id="ai" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="rounded-2xl p-8 bg-gray-900 text-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-bold">AI Assistant</h2>
                    <p class="text-white/80 mt-2">
                        L’IA aidera à rédiger une mission, recommander des prestataires et orienter vers des jobs accessibles.
                    </p>
                </div>
                <a href="#ai"
                   class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-orange-500 text-white font-semibold hover:bg-orange-600 transition">
                    Tester l’AI (bêta)
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
