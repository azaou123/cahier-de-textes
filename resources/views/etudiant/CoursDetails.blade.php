<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../../img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../../js/plugin/webfont/webfont.min.js"></script>
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
                urls: ["../../css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/plugins.min.css" />
    <link rel="stylesheet" href="../../css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../css/demo.css" />
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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                            <a href="#" class="btn btn-primary btn-round">Add Customer</a>
                        </div>
                    </div>
                    <h2>Tableau de Bord</h2>
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                            <div>
                                <h3 class="fw-bold mb-3">{{ $cours->Nom_Cours }}</h3>
                                <h6 class="op-7 mb-2">{{ $cours->Description }}</h6>
                            </div>
                        </div>

                        <!-- Tableau des Ressources -->
                        <h2>Ressources du Cours</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Date de Création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ressources as $ressource)
                                    <tr>
                                        <td>{{ $ressource->title }}</td>
                                        <td>{{ $ressource->description }}</td>
                                        <td>{{ $ressource->created_at }}</td>
                                        <td>
                                            <a href="{{ Storage::url($ressource->file_path) }}" target="_blank" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> Consulter
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Tableau des Devoirs -->
                        <h2>Devoirs du Cours</h2>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Date Limite</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($devoirs as $devoir)
                                    <tr>
                                        <td>{{ $devoir->Titre_Devoir }}</td>
                                        <td>{{ $devoir->Description_Devoir }}</td>
                                        <td>{{ $devoir->Date_Limite }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#submitDevoirModal" data-devoir-id="{{ $devoir->ID_Devoir }}">
                                                <i class="fas fa-upload"></i> Soumettre
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal pour soumettre un devoir -->
            <div class="modal fade" id="submitDevoirModal" tabindex="-1" aria-labelledby="submitDevoirModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="submitDevoirModalLabel">Soumettre un Devoir</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if($existingSubmission)
                                <!-- If a submission exists, show the "View" and "Delete" buttons -->
                                <a href="{{ asset('storage/' . $existingSubmission->Fichier_Rendu) }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View Submission
                                </a>
                                <form id="deleteSubmissionForm" action="{{ route('etudiant.devoirs.delete', $existingSubmission->ID_Rendu) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this submission?')">
                                      <i class="fas fa-trash"></i> Delete Submission
                                  </button>
                                </form>
                            @else
                                <!-- If no submission exists, show the form -->
                                <form id="submitDevoirForm" action="" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="fichier">Fichier (PDF, DOC, DOCX, ZIP)</label>
                                        <input type="file" name="fichier" id="fichier" class="form-control" required>
                                        <small class="text-muted">Taille maximale : 2MB</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="commentaire">Commentaire (optionnel)</label>
                                        <textarea name="commentaire" id="commentaire" class="form-control" rows="3" maxlength="500"></textarea>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            @if(!$existingSubmission)
                                <!-- Only show the submit button if no submission exists -->
                                <button type="submit" form="submitDevoirForm" class="btn btn-primary">Soumettre</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">ThemeKita</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Licenses</a>
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

    <!-- Scripts -->
    <script src="../../js/core/jquery-3.7.1.min.js"></script>
    <script src="../../js/core/popper.min.js"></script>
    <script src="../../js/core/bootstrap.min.js"></script>

    <!-- Script pour mettre à jour l'action du formulaire -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const submitDevoirModal = document.getElementById('submitDevoirModal');
            submitDevoirModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const devoirId = button.getAttribute('data-devoir-id'); // Get the devoir ID

                // Update the action of the form with the full route
                const form = submitDevoirModal.querySelector('#submitDevoirForm');
                form.action = `/etudiant/devoirs/${devoirId}/rendre`; // Dynamically set the URL
            });
        });
    </script>
</body>
</html>
