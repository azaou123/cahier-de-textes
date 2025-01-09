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
            <h1>Modifier le Cours</h1>
            <form action="{{ route('admin.cours.update', $cours->ID_Cours) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="Nom_Cours" class="form-label">Nom du Cours</label>
                    <input type="text" class="form-control" id="Nom_Cours" name="Nom_Cours" value="{{ $cours->Nom_Cours }}" required>
                </div>
                <div class="mb-3">
                    <label for="Description_Cours" class="form-label">Description</label>
                    <textarea class="form-control" id="Description_Cours" name="Description_Cours" rows="3">{{ $cours->Description_Cours }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="ID_Filiere" class="form-label">Filière</label>
                    <select class="form-control" id="ID_Filiere" name="ID_Filiere" required>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->ID_Filiere }}" {{ $cours->ID_Filiere == $filiere->ID_Filiere ? 'selected' : '' }}>
                                {{ $filiere->Nom_Filiere }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="ID_Professeur" class="form-label">Professeur</label>
                    <select class="form-control" id="ID_Professeur" name="ID_Professeur" required>
                        @foreach($professeurs as $professeur)
                            <option value="{{ $professeur->ID_Utilisateur }}" {{ $cours->ID_Professeur == $professeur->ID_Utilisateur ? 'selected' : '' }}>
                                {{ $professeur->prenom }} {{ $professeur->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
