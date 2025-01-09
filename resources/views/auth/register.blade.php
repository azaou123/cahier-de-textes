<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .auth-container {
            max-width: 800px; /* Augmenté pour accommoder deux champs par ligne */
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .auth-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .auth-container .form-group {
            margin-bottom: 15px;
        }
        .auth-container label {
            font-weight: bold;
            color: #333;
        }
        .auth-container .text-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 100%;
        }
        .auth-container .text-input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        .auth-container .primary-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .auth-container .primary-btn:hover {
            background-color: #45a049;
        }
        .auth-container .link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }
        .auth-container .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-container mt-5">
        <h2>Register</h2>
        <form method="POST" action="/register">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row">
                <!-- Nom et Prénom sur la même ligne -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nom" class="form-label">Nom</label>
                        <input id="nom" class="form-control text-input" type="text" name="nom" required value="{{ old('nom') }}">
                        <div class="text-danger" id="nom-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prenom" class="form-label">Prenom</label>
                        <input id="prenom" class="form-control text-input" type="text" name="prenom" required value="{{ old('prenom') }}">
                        <div class="text-danger" id="prenom-error"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Email et Role sur la même ligne -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control text-input" type="email" name="email" required value="{{ old('email') }}">
                        <div class="text-danger" id="email-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" class="form-control text-input" name="role" required>
                            <option value="professeur">Professeur</option>
                            <option value="etudiant">Étudiant</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="text-danger" id="role-error"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Password et Confirm Password sur la même ligne -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control text-input" type="password" name="password" required>
                        <div class="text-danger" id="password-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" class="form-control text-input" type="password" name="password_confirmation" required>
                        <div class="text-danger" id="password_confirmation-error"></div>
                    </div>
                </div>
            </div>
            <!-- Bouton et lien alignés avec flex -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="/login" class="link">Already registered?</a>
                <button type="submit" class="btn primary-btn">Register</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>