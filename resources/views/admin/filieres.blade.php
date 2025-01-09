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
            <h1>Gestion des Filieres</h1>
            <a href="{{ route('admin.filieres.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Créer une Filière
            </a>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom de la Filière</th>
                            <th>Description</th>
                            <th>Responsable</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($filieres as $filiere)
                            <tr>
                                <td>{{ $filiere->ID_Filiere }}</td>
                                <td>{{ $filiere->Nom_Filiere }}</td>
                                <td>{{ $filiere->Description }}</td>
                                <td>{{ $filiere->responsable->prenom  }} {{ $filiere->responsable->nom  }}</td>
                                <td>{{ $filiere->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <!-- Lien pour modifier -->
                                    <a href="{{ route('admin.filieres.edit', $filiere->ID_Filiere) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> 
                                    </a>
                                    <!-- Formulaire pour supprimer -->
                                    <form action="{{ route('admin.filieres.delete', $filiere->ID_Filiere) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette filière ?')">
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

        <footer class="footer">
          <div class="container-fluid d-flex justify-content-between">
            <nav class="pull-left">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="http://www.themekita.com">
                    ThemeKita
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Help </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"> Licenses </a>
                </li>
              </ul>
            </nav>
            <div class="copyright">
              2024, made with <i class="fa fa-heart heart text-danger"></i> by
              <a href="http://www.themekita.com">ThemeKita</a>
            </div>
            <div>
              Distributed by
              <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
            </div>
          </div>
        </footer>
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
