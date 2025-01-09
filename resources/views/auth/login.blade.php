<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .auth-container {
            width: 100%;
            max-width: 400px;
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
        <h2>Login</h2>
        
        <form method="POST" action="/login">
            <!-- CSRF Token -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control text-input" type="email" name="email" required autofocus autocomplete="username">
                <!-- Display error message for email if any -->
                <div class="text-danger" id="email-error"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control text-input" type="password" name="password" required autocomplete="current-password">
                <!-- Display error message for password if any -->
                <div class="text-danger" id="password-error"></div>
            </div>

            <!-- Remember Me -->
            <!-- <div class="form-group form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">Remember me</label>
            </div> -->

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn primary-btn">Log in</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
