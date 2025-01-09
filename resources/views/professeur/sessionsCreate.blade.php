<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('includes.sidebar')

        <div class="main-panel">
            <!-- Main Header -->
            @include('includes.mainHeader')

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

                    <h2>Créer une Nouvelle Séance</h2>

                    <!-- Formulaire de création de séance -->
                    <form action="{{ route('professeur.sessions.store') }}" method="POST">
                        @csrf
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach

                        <!-- Description de la séance -->
                        <div class="form-group">
                            <label for="description">Description de la séance</label>
                            <textarea id="description" name="description" class="form-control rich-textarea"></textarea>
                        </div>

                        <!-- Date de la séance -->
                        <div class="form-group">
                            <label for="Date_Seance">Date de la Séance</label>
                            <input type="date" name="Date_Seance" id="Date_Seance" class="form-control" required>
                        </div>

                        <!-- Heure de début -->
                        <div class="form-group">
                            <label for="Heure_Debut">Heure de Début</label>
                            <input type="time" name="Heure_Debut" id="Heure_Debut" class="form-control" required>
                        </div>

                        <!-- Heure de fin -->
                        <div class="form-group">
                            <label for="Heure_Fin">Heure de Fin</label>
                            <input type="time" name="Heure_Fin" id="Heure_Fin" class="form-control" required>
                        </div>

                        <!-- Cours -->
                        <div class="form-group">
                            <label for="ID_Cours">Cours</label>
                            <select name="ID_Cours" id="ID_Cours" class="form-control" required>
                                @foreach($cours as $cour)
                                    <option value="{{ $cour->ID_Cours }}">{{ $cour->Nom_Cours }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Salle -->
                        <div class="form-group">
                            <label for="ID_Salle">Salle</label>
                            <select name="ID_Salle" id="ID_Salle" class="form-control" required>
                                @foreach($salles as $salle)
                                    <option value="{{ $salle->ID_Salle }}">{{ $salle->Nom_Salle }}</option>
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

            <!-- Footer -->
            @include('includes.footer')
        </div>
    </div>

    <!-- Scripts -->
    @include('includes.scripts')
</body>
</html>