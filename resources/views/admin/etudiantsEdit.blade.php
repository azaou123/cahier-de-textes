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

            <form action="{{ route('admin.etudiants.update', $etudiant->ID_Utilisateur) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $etudiant->nom }}" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $etudiant->prenom }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $etudiant->email }}" required>
            </div>
            <div class="form-group">
                <label for="filiere">Filière</label>
                <select class="form-control" id="filiere" name="filiere" required>
                    <option value="">Sélectionnez une filière</option>
                    @foreach($filieres as $filiere)
                        <option value="{{ $filiere->ID_Filiere }}" {{ $etudiant->filiere && $etudiant->filiere->ID_Filiere == $filiere->ID_Filiere ? 'selected' : '' }}>
                            {{ $filiere->Nom_Filiere }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
