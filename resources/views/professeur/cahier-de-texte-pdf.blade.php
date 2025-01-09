<!DOCTYPE html>
<html>
<head>
    <title>Cahier de Texte ({{ $startDate }} - {{ $endDate }})</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }
        h2 {
            font-size: 18px;
            margin-top: 30px;
            margin-bottom: 10px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <h1>Cahier de Texte ({{ $startDate }} - {{ $endDate }})</h1>
    </div>

    <!-- Séances -->
    <h2>Séances</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>Cours</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seances as $seance)
                <tr>
                    <td>{{ $seance->Date_Seance }}</td>
                    <td>{{ $seance->Heure_Debut }} - {{ $seance->Heure_Fin }}</td>
                    <td>{{ $seance->cours->Nom_Cours }}</td>
                    <td>{{ $seance->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Devoirs -->
    <h2>Devoirs</h2>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Date Limite</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devoirs as $devoir)
                <tr>
                    <td>{{ $devoir->Titre_Devoir }}</td>
                    <td>{{ $devoir->Description_Devoir }}</td>
                    <td>{{ $devoir->Date_Limite }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Cours -->
    <h2>Cours</h2>
    <table>
        <thead>
            <tr>
                <th>Nom du Cours</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cours as $cour)
                <tr>
                    <td>{{ $cour->Nom_Cours }}</td>
                    <td>{{ $cour->Description_Cours }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Généré le {{ now()->format('d/m/Y H:i') }} par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
    </div>
</body>
</html>