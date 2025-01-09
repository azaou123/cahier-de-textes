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
            <h1>Créer une Salle</h1>
            <form action="{{ route('admin.salles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Nom_Salle">Nom de la Salle</label>
                    <input type="text" name="Nom_Salle" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Capacite">Capacité</label>
                    <input type="number" name="Capacite" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="Localisation">Localisation</label>
                    <input type="text" name="Localisation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Créer</button>
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
