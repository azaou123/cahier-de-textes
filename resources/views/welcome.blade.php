<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Cahier de Texte</title>
    <style>
        /* Global styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f4f6;
            color: #1f2937;
        }
        .container {
            text-align: center;
        }
        .logo {
            width: 150px;
            height: 150px;
            background-color: #2563eb;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #4b5563;
        }
        .subtitle {
            font-size: 1.25rem;
            color: #6b7280;
            margin-bottom: 2rem;
        }
        .button-container {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }
        .button {
            background-color: #2563eb;
            color: white;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            CDT
        </div>

        <!-- Titre du projet -->
        <h1>Gestion du Cahier de Texte</h1>

        <!-- Sous-titres -->
        <div class="subtitle">
            <p>Réalisé par <i>Badr AZAOU</i></p>
            <p>Encadré par <b>Flan EL Flani</b></p>
        </div>

        <!-- Boutons -->
        <div class="button-container">
            <a href="/login" class="button">Se Connecter</a>
            <a href="/register" class="button">S'inscrire</a>
        </div>
    </div>
</body>
</html>