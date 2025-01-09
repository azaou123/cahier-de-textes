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
            <h1>Liste des Cours</h1>
            <a href="{{ route('admin.cours.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Créer un Cours
            </a>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom du Cours</th>
                            <th>Description</th>
                            <th>Filière</th>
                            <th>Professeur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cours as $cour)
                            <tr>
                                <td>{{ $cour->ID_Cours }}</td>
                                <td>{{ $cour->Nom_Cours }}</td>
                                <td>{{ $cour->Description_Cours }}</td>
                                <td>{{ $cour->filiere->Nom_Filiere }}</td>
                                <td>{{ $cour->professeur->prenom }} {{ $cour->professeur->nom }}</td>
                                <td>
                                    <a href="{{ route('admin.cours.edit', $cour->ID_Cours) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> 
                                    </a>
                                    <form action="{{ route('admin.cours.delete', $cour->ID_Cours) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                            <i class="fas fa-trash"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>
        </div>

        <!-- Include Footer  -->
        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
