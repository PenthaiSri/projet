<!DOCTYPE html>
<html>
<?php
    use \App\Http\Controllers\SessionController;
    use App\Models\Module;
    
    echo SessionController::checkIfConnected();
    
    // Charge les classes nécessaires
    // Récupère tous les modules enregistrés
?>
<head>
    <title>Détail du module</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/show.css')}}" rel="stylesheet" type="text/css">
    <style>
        body {
            background-image: url('/projet/resources/images/background.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>
<header>
    <div id="nav" class="navbar">
        <div class="centered-nav">
            <ul>
                <li><a href="../home">Accueil</a></li>
                <li><a href="../list">Relevés</a></li>
                <li><a href="#meteo">Météo</a></li>
                <li><a href="list/create">Administration</a></li>
            </ul>
        </div>
    </div>
</header>

<body>
    <div class="panel">
        <div class="title">
            <h1>Nom de la plante</h1>
        </div>
        <hr>
        <div class="air-info">
            <h2>Air ambiant</h2>
            <div class="hygrometrie">
                <h3>Hygrométrie</h3>
            </div>
            <div class="temperature">
                <h3>Température</h3>
            </div>
        </div>
        <div class="ground-info">
            <h2>Humidité du sol</h2>
            <div class="soil-hum">
                <h3>Humidité du sol</h3>
            </div>
        </div>
        <hr style="clear: both;">
        <div class="settings">
            <div class="logs">
                <h4 style="margin-left: 1%;">Date de mise en service : </h4>
                <h4 style="color: aqua; margin-left: 1%;">Voir les dernières activités</h4>
            </div>
            <div class="ground-settings">
                <h3>Humidité du sol max : </h3>
                <h3>Humidité du sol min : </h3>
            </div>
        </div>
        <hr style="clear: both;">
        <div class="description">
            <h3>Description : </h3>
        </div>
    </div>
</body>

</html>