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
          <h1>Générer le Cahier de Texte</h1>
            <form action="{{ route('professeur.cahier-de-texte.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="start_date">Date de début :</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Date de fin :</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-download"></i> Générer le PDF
                </button>
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
