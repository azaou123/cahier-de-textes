<!-- Sidebar -->
<aside class="bg-gray-800 text-white w-64 min-h-screen fixed left-0 top-0">
    <div class="p-4">
        <h2 class="text-lg font-semibold">Tableau de Bord</h2>
    </div>

    <nav class="mt-4">
        <!-- Tableau de Bord -->
        <a href="{{ route('professeur.dashboard') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            <i class="fas fa-home mr-2"></i> Tableau de Bord
        </a>

        <!-- Cours -->
        <a href="{{ route('professeur.courses') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            <i class="fas fa-book mr-2"></i> Cours
        </a>

        <!-- Séances -->
        <a href="{{ route('professeur.sessions') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            <i class="fas fa-calendar-alt mr-2"></i> Séances
        </a>

        <!-- Devoirs -->
        <a href="{{ route('professeur.homework') }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            <i class="fas fa-tasks mr-2"></i> Devoirs
        </a>

        <!-- Soumissions -->
        <a href="{{ route('professeur.homework.submissions', 1) }}" class="block px-4 py-2 text-white hover:bg-gray-700">
            <i class="fas fa-file-upload mr-2"></i> Soumissions
        </a>

        <!-- Déconnexion -->
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-white hover:bg-gray-700">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </button>
        </form>
    </nav>
</aside>