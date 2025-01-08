<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .auth-container {
            width: 100%;
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .auth-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .auth-container form {
            display: flex;
            flex-direction: column;
        }

        .auth-container .form-group {
            margin-bottom: 15px;
        }

        .auth-container label {
            font-weight: bold;
            color: #333;
        }

        .auth-container .text-input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .auth-container .text-input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .auth-container .primary-btn {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
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
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .auth-container .link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <h2>Register</h2>

        <form method="POST" action="/register">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Name -->
            <div class="form-group">
                <label for="nom" class="form-label">Nom</label>
                <input id="nom" class="form-control text-input" type="text" name="nom" required value="{{ old('nom') }}">
                <!-- Display error message for name if any -->
                <div class="text-danger" id="nom-error"></div>
            </div>

            <!-- Prenom -->
            <div class="form-group">
                <label for="prenom" class="form-label">Prenom</label>
                <input id="prenom" class="form-control text-input" type="text" name="prenom" required value="{{ old('prenom') }}">
                <!-- Display error message for prenom if any -->
                <div class="text-danger" id="prenom-error"></div>
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control text-input" type="email" name="email" required value="{{ old('email') }}">
                <!-- Display error message for email if any -->
                <div class="text-danger" id="email-error"></div>
            </div>

            <!-- Role -->
            <div class="form-group">
                <label for="role" class="form-label">Role</label>
                <select id="role" class="form-control" name="role" required>
                    <option value="professeur">Professeur</option>
                    <option value="etudiant">Étudiant</option>
                    <option value="admin">Admin</option>
                </select>
                <!-- Display error message for role if any -->
                <div class="text-danger" id="role-error"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control text-input" type="password" name="password" required>
                <!-- Display error message for password if any -->
                <div class="text-danger" id="password-error"></div>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control text-input" type="password" name="password_confirmation" required>
                <!-- Display error message for password confirmation if any -->
                <div class="text-danger" id="password_confirmation-error"></div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="/login" class="link">Already registered?</a>
                <button type="submit" class="btn primary-btn">Register</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
