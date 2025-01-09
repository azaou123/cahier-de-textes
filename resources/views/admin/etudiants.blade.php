<!DOCTYPE html>
<html lang="en">
  <head>
    @include('../includes/head')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('../includes/sidebar');

      <div class="main-panel">
        <!-- Man Header -->
        @include('../includes/mainHeader');

        <div class="container">
          <div class="page-inner">
            
            <h2>Gestion des Étudiants</h2>

            <!-- Affichage des messages de succès ou d'erreur -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tableau des étudiants -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Filière</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etudiants as $etudiant)
                            <tr>
                                <td>{{ $etudiant->ID_Utilisateur }}</td>
                                <td>{{ $etudiant->nom }}</td>
                                <td>{{ $etudiant->prenom }}</td>
                                <td>{{ $etudiant->email }}</td>
                                <td>
                                    @if($etudiant->filiere)
                                        {{ $etudiant->filiere->Nom_Filiere }}
                                    @else
                                        <span class="text-muted">Non affecté</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Bouton pour modifier un étudiant -->
                                    <a href="{{ route('admin.etudiants.edit', $etudiant->ID_Utilisateur) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> 
                                    </a>

                                    <!-- Bouton pour supprimer un étudiant -->
                                    <form action="{{ route('admin.etudiants.delete', $etudiant->ID_Utilisateur) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                            <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucun étudiant trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
          </div>
        </div>

        @include('../includes/footer')
      </div>

      
    </div>
    @include('../includes/scripts')
  </body>
</html>
