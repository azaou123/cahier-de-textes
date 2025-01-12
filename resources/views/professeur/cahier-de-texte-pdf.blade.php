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
            line-height: 1.6;
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
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .section {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        .section-content {
            margin-left: 20px;
        }
        .item {
            margin-bottom: 15px;
            padding: 10px;
            border-left: 4px solid #2c3e50;
            background-color: #fff;
            border-radius: 4px;
        }
        .item-title {
            font-weight: bold;
            color: #2c3e50;
        }
        .item-details {
            margin-top: 5px;
            font-size: 14px;
            color: #555;
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
    <div class="section">
        <div class="section-title">Séances</div>
        <div class="section-content">
            @foreach($seances as $seance)
                <div class="item">
                    <div class="item-title">{{ $seance->cours->Nom_Cours }}</div>
                    <div class="item-details">
                        <strong>Date :</strong> {{ $seance->Date_Seance }}<br>
                        <strong>Heure :</strong> {{ $seance->Heure_Debut }} - {{ $seance->Heure_Fin }}<br>
                        <strong>Description :</strong> {{ $seance->description }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Devoirs -->
    <div class="section">
        <div class="section-title">Devoirs</div>
        <div class="section-content">
            @foreach($devoirs as $devoir)
                <div class="item">
                    <div class="item-title">{{ $devoir->Titre_Devoir }}</div>
                    <div class="item-details">
                        <strong>Description :</strong> {{ $devoir->Description_Devoir }}<br>
                        <strong>Date Limite :</strong> {{ $devoir->Date_Limite }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Cours -->
    <div class="section">
        <div class="section-title">Cours</div>
        <div class="section-content">
            @foreach($cours as $cour)
                <div class="item">
                    <div class="item-title">{{ $cour->Nom_Cours }}</div>
                    <div class="item-details">
                        <strong>Description :</strong> {{ $cour->Description_Cours }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        Généré le {{ now()->format('d/m/Y H:i') }} par {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
    </div>
</body>
</html>