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
            <h2>Soumissions pour le Devoir : {{ $devoir->Titre_Devoir }}</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Fichier</th>
                            <th>Date de Soumission</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($submissions as $submission)
                            <tr>
                                <td>{{ $submission->utilisateur->prenom }} {{ $submission->utilisateur->nom }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $submission->Fichier_Rendu) }}" target="_blank">
                                        <i class="fas fa-file-download"></i> Télécharger
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($submission->Date_Rendu)->format('d/m/Y H:i') }}</td>
                                <td>{{ $submission->Note ?? 'Non noté' }}</td>
                                <td>{{ $submission->Commentaire ?? 'Aucun commentaire' }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#gradeModal{{ $submission->ID_Rendu }}">
                                        <i class="fas fa-edit"></i> Noter
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Aucune soumission trouvée.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @foreach($submissions as $submission)
        <div class="modal fade" id="gradeModal{{ $submission->ID_Rendu }}" tabindex="-1" aria-labelledby="gradeModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('professeur.submissions.grade', $submission->ID_Rendu) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="gradeModalLabel">Noter la soumission</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="Note">Note</label>
                                <input type="number" name="Note" id="Note" class="form-control" min="0" max="20" step="0.1" required>
                            </div>
                            <div class="form-group">
                                <label for="Commentaire">Commentaire</label>
                                <textarea name="Commentaire" id="Commentaire" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        @include('../includes/footer')
      </div>

      
    </div>
    <!--   Core JS Files   -->
    @include('../includes/scripts')
  </body>
</html>
