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
        <!-- Man Header -->
        @include('../includes/mainHeader')

        <div class="container">
          <div class="page-inner">
            
            <h2>Gestion des Devoirs</h2>
              <a href="{{ route('professeur.homework.create') }}" class="btn btn-primary mb-3">
                  <i class="fas fa-plus"></i> Créer un Devoir
              </a>

              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>Titre</th>
                              <th>Description</th>
                              <th>Date Limite</th>
                              <th>Cours</th>
                              <th>Fichier</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          @forelse($devoirs as $devoir)
                              <tr>
                                  <td>{{ $devoir->Titre_Devoir }}</td>
                                  <td>{{ $devoir->Description_Devoir }}</td>
                                  <td>{{ \Carbon\Carbon::parse($devoir->Date_Limite)->format('d/m/Y H:i') }}</td>
                                  <td>{{ $devoir->cours->Nom_Cours }}</td>
                                  <td>
                                      @if ($devoir->file_path)
                                          <a href="{{ Storage::url($devoir->file_path) }}" target="_blank">Télécharger</a>
                                      @else
                                          Aucun fichier
                                      @endif
                                  </td>
                                  <td>
                                    <a href="{{ route('professeur.homework.submissions', $devoir->ID_Devoir) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                    <a href="{{ route('professeur.homework.edit', $devoir->ID_Devoir) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('professeur.homework.delete', $devoir->ID_Devoir) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devoir ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                              </tr>
                          @empty
                              <tr>
                                  <td colspan="5" class="text-center">Aucun devoir trouvé.</td>
                              </tr>
                          @endforelse
                      </tbody>
                  </table>
              </div>
          </div>
        </div>

        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
