<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestion des Professeurs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../css/kaiadmin.min.css">
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
                    <h1>Gestion des Professeurs</h1>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Nombre de Cours</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($professeurs as $professeur)
                                    <tr>
                                        <td>{{ $professeur->ID_Utilisateur }}</td>
                                        <td>{{ $professeur->nom }}</td>
                                        <td>{{ $professeur->prenom }}</td>
                                        <td>{{ $professeur->email }}</td>
                                        <td>
                                            <a href="#" class="course-count" data-bs-toggle="modal" data-bs-target="#coursesModal" data-courses="{{ json_encode($professeur->courses ?? []) }}">
                                                {{ $professeur->courses ? $professeur->courses->count() : 0 }}
                                            </a>
                                        </td>
                                        <td>{{ $professeur->Date_inscription->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <!-- Formulaire pour supprimer -->
                                            <form action="{{ route('admin.professeurs.delete', $professeur->ID_Utilisateur) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce professeur ?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal for Course Details -->
            <div class="modal fade" id="coursesModal" tabindex="-1" aria-labelledby="coursesModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="coursesModalLabel">Cours du Professeur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="courseList">
                                <!-- Course names will be populated here -->
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Include Footer -->
            @include('../includes/footer')
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            $('.course-count').on('click', function() {
                var courses = $(this).data('courses');
                console.log(courses); // Debug the data being passed

                var courseList = $('#courseList');
                courseList.empty(); // Clear previous list

                if (courses && courses.length > 0) {
                    courses.forEach(function(course) {
                        courseList.append('<li>' + course.Nom_Cours + '</li>');
                    });
                } else {
                    courseList.append('<li>Aucun cours trouvé.</li>');
                }
            });
        });
    </script>
</body>
</html>