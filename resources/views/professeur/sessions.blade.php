<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('includes.sidebar')

        <div class="main-panel">
            <!-- Main Header -->
            @include('includes.mainHeader')

            <div class="container">
                <div class="page-inner">

                    <h2>Gestion des Séances</h2>
                    <a href="{{ route('professeur.sessions.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i> Créer une Séance
                    </a>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Heure Début</th>
                                    <th>Heure Fin</th>
                                    <th>Cours</th>
                                    <th>Salle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($seances as $seance)
                                    <tr>
                                        <td>{{ $seance->Date_Seance }}</td>
                                        <td>{{ $seance->Heure_Debut }}</td>
                                        <td>{{ $seance->Heure_Fin }}</td>
                                        <td>{{ $seance->cours->Nom_Cours }}</td>
                                        <td>{{ $seance->salle->Nom_Salle ?? 'Non spécifiée' }}</td>
                                        <td>
                                            <a href="{{ route('professeur.sessions.edit', $seance->ID_Seance) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Modifier
                                            </a>
                                            <form action="{{ route('professeur.sessions.delete', $seance->ID_Seance) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune séance trouvée.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('includes.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('includes.scripts')
</body>
</html>