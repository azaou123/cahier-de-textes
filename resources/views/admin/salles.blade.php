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
            <div class="row">
              <div class="col-9"><h1>Gestion des Salles</h1></div>
              <div class="col-3"><a href="{{ route('admin.salles.create') }}" class="btn btn-success">Créer une Salle</a></div>
            </div>
            
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Capacité</th>
                        <th>Localisation</th>
                        <th>Créé le</th>
                        <th>Mis à jour le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salles as $salle)
                        <tr>
                            <td>{{ $salle->ID_Salle }}</td>
                            <td>{{ $salle->Nom_Salle }}</td>
                            <td>{{ $salle->Capacite }}</td>
                            <td>{{ $salle->Localisation }}</td>
                            <td>{{ $salle->created_at }}</td>
                            <td>{{ $salle->updated_at }}</td>
                            <td>
                              <!-- Edit Button with Icon -->
                              <a href="{{ route('admin.salles.edit', $salle->ID_Salle) }}" class="btn btn-primary btn-sm">
                                  <i class="fas fa-edit"></i> <!-- Font Awesome Edit Icon -->
                              </a>

                              <!-- Delete Button with Icon -->
                              <form action="{{ route('admin.salles.delete', $salle->ID_Salle) }}" method="POST" style="display:inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette salle ?')">
                                      <i class="fas fa-trash"></i> <!-- Font Awesome Trash Icon -->
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
    @include('../includes/scripts')
  </body>
</html>
