<!DOCTYPE html>
<html lang="en">
  <head>
    @include('../includes/head')
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      @include('../includes/sidebar')

      <div class="main-panel">
        <!-- Main Header -->
        @include('../includes/mainHeader')

        <div class="container">
          <div class="page-inner">

            <!-- Check if the student is registered in a filiere -->
            @php
              $filiere = Auth::user()->filiere;
            @endphp

            @if ($filiere)
              <!-- If the student is registered in a filiere, show the dashboard content -->
              <h2>Tableau de Bord</h2>

              <!-- Informations sur la filière -->
              <div class="card mb-4">
                  <div class="card-header">
                      <h4>Ma Filière : {{ $filiere->Nom_Filiere }}</h4>
                  </div>
                  <div class="card-body">
                      <p>{{ $filiere->Description }}</p>
                  </div>
              </div>

              <div class="row">
                @foreach ($filiere->cours as $coursItem)
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <div class="card-header text-center">
                        <h5 class="card-title">{{ $coursItem->Nom_Cours }}</h5>
                      </div>
                      <div class="card-body text-center">
                        @if ($coursItem->professeur)
                          <p class="text-muted">
                            <strong>Professeur :</strong> {{ $coursItem->professeur['nom'] }} {{ $coursItem->professeur['prenom'] }}
                          </p>
                        @else
                          <p class="text-muted">Professeur : Non spécifié</p>
                        @endif
                      </div>
                      <div class="card-footer text-center">
                        <a href="{{ route('etudiant.CoursDetails', ['id' => $coursItem->ID_Cours]) }}" class="btn btn-primary">
                          Accéder au cours
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <!-- If the student is not registered in any filiere, show a message -->
              <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Aucune Filière Assignée</h4>
                <p>Vous n'êtes actuellement inscrit dans aucune filière. Veuillez contacter l'administration pour plus d'informations.</p>
              </div>
            @endif
          </div>
        </div>

        @include('../includes/sidebar')
      </div>
    </div>

    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>