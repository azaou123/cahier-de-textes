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
            <div class="row my-3">
              <div class="col-8"><h3>Ressources pour le cours: {{ $course->Nom_Cours }}</h1></div>
              <div class="col-4"><a href="{{ route('professeur.courseResources.create', $course->ID_Cours) }}" class="btn btn-primary">Ajouter une ressource</a></div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Fichier</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resources as $resource)
                    <tr>
                        <td>{{ $resource->title }}</td>
                        <td>{{ $resource->description }}</td>
                        <td><a href="{{ Storage::url($resource->file_path) }}" target="_blank">Télécharger</a></td>
                        <td>
                          <!-- Bouton Modifier avec une icône -->
                          <a href="{{ route('professeur.courseResources.edit', $resource->id) }}" class="btn btn-warning btn-sm">
                              <i class="fas fa-edit"></i> <!-- Icône de modification -->
                          </a>

                          <!-- Bouton Supprimer avec une icône -->
                          <form action="{{ route('professeur.courseResources.delete', $resource->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette ressource ?')">
                                  <i class="fas fa-trash"></i> <!-- Icône de suppression -->
                              </button>
                          </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
          </div>
        </div>

        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
