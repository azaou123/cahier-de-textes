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
            <h1>Créer un Cours</h1>
            <form action="{{ route('admin.cours.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Nom_Cours" class="form-label">Nom du Cours</label>
                    <input type="text" class="form-control" id="Nom_Cours" name="Nom_Cours" required>
                </div>
                <div class="mb-3">
                    <label for="Description_Cours" class="form-label">Description</label>
                    <textarea class="form-control" id="Description_Cours" name="Description_Cours" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="ID_Filiere" class="form-label">Filière</label>
                    <select class="form-control" id="ID_Filiere" name="ID_Filiere" required>
                        <option value="">Sélectionner une filière</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->ID_Filiere }}">{{ $filiere->Nom_Filiere }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ID_Professeur" class="form-label">Professeur</label>
                    <select class="form-control" id="ID_Professeur" name="ID_Professeur" required>
                        <option value="">Sélectionner un professeur</option>
                        @foreach($professeurs as $professeur)
                            <option value="{{ $professeur->ID_Utilisateur }}">{{ $professeur->prenom }} {{ $professeur->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Créer</button>
            </form>
          </div>
        </div>

        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
