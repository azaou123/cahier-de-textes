<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../../../img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="../../../js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../../../css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../css/plugins.min.css" />
    <link rel="stylesheet" href="../../../css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../../css/demo.css" />
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
            <h2>Modifier la Séance</h2>
            <form action="{{ route('professeur.sessions.update', $seance->ID_Seance) }}" method="POST">
                @csrf
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
                @method('PUT')

                <!-- Description de la séance -->
                <div class="form-group">
                    <label for="description">Description de la séance</label>
                    <textarea id="description" name="description" class="form-control rich-textarea">{{ $seance->description }}</textarea>
                </div>

                <!-- Date de la séance -->
                <div class="form-group">
                    <label for="Date_Seance">Date de la Séance</label>
                    <input type="date" name="Date_Seance" id="Date_Seance" class="form-control" 
                        value="{{ \Carbon\Carbon::parse($seance->Date_Seance)->format('Y-m-d') }}" required>
                </div>

                <!-- Heure de début -->
                <div class="form-group">
                    <label for="Heure_Debut">Heure de Début</label>
                    <input type="time" name="Heure_Debut" id="Heure_Debut" class="form-control" value="{{ $seance->Heure_Debut }}" required>
                </div>

                <!-- Heure de fin -->
                <div class="form-group">
                    <label for="Heure_Fin">Heure de Fin</label>
                    <input type="time" name="Heure_Fin" id="Heure_Fin" class="form-control" value="{{ $seance->Heure_Fin }}" required>
                </div>

                <!-- Cours -->
                <div class="form-group">
                    <label for="ID_Cours">Cours</label>
                    <select name="ID_Cours" id="ID_Cours" class="form-control" required>
                        @foreach($cours as $cour)
                            <option value="{{ $cour->ID_Cours }}" {{ $seance->ID_Cours == $cour->ID_Cours ? 'selected' : '' }}>
                                {{ $cour->Nom_Cours }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Salle -->
                <div class="form-group">
                    <label for="ID_Salle">Salle</label>
                    <select name="ID_Salle" id="ID_Salle" class="form-control" required>
                        @foreach($salles as $salle)
                            <option value="{{ $salle->ID_Salle }}" {{ $seance->ID_Salle == $salle->ID_Salle ? 'selected' : '' }}>
                                {{ $salle->Nom_Salle }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Boutons de soumission et d'annulation -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer
                    </button>
                    <a href="{{ route('professeur.sessions') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Annuler
                    </a>
                </div>
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
    <script src="../../../js/core/jquery-3.7.1.min.js"></script>
    <script src="../../../js/core/popper.min.js"></script>
    <script src="../../../js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../../js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="../../../js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../../../js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../../../js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../../../js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../../../js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../../../js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../../../js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../../../js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../../../js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../../../js/setting-demo.js"></script>
    <script src="../../../js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
  </body>
</html>
