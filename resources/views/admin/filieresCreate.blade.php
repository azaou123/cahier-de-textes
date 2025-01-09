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
            <h1>Créer une Filière</h1>
            <form action="{{ route('admin.filieres.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Nom_Filiere" class="form-label">Nom de la Filière</label>
                    <input type="text" class="form-control" id="Nom_Filiere" name="Nom_Filiere" required>
                </div>
                <div class="mb-3">
                    <label for="Description" class="form-label">Description</label>
                    <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="Responsable_Filiere" class="form-label">Responsable de la Filière</label>
                    <select class="form-control" id="Responsable_Filiere" name="Responsable_Filiere" required>
                        <option value="">Sélectionner un responsable</option>
                        @foreach($professeurs as $professeur)
                            <option value="{{ $professeur->ID_Utilisateur }}">
                                {{ $professeur->prenom }} {{ $professeur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
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
