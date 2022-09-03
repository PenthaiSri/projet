<!DOCTYPE html>
<?php
use \App\Http\Controllers\SessionController;
echo SessionController::checkIfConnected();
echo SessionController::adminOnly();
?>

<html>

<head>
    <title>Création d'un module</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/create.css')}}" rel="stylesheet" type="text/css">
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
                <li><a href="../weather">Météo</a></li>
            </ul>
        </div>
    </div>
</header>

<body>
    <div class="admin-panel">
        <h1>Administration</h1>
        <strong>
            <p style="color: white;">Création d'un module</p>
        </strong>
        <a href="../list"><button type="submit" id="module-cancel" class="cancel-button">Annuler la création</button></a>
        <a href="../admin/create"><button id="user-gest" class="user-create-button">Création d'un utilisateur</button></a>
        <hr>
        <div class="module-create">
            <form method="POST" action="createModule">
            @csrf
                <input id="name" class="textfield" type="text" placeholder="Nom de la plante" name="name" required="true">
                <input id="locate" class="textfield" type="text" placeholder="Localisation du module" name="locate">
                <input id="description" class="textfield" type="text" placeholder="Description du module" name="description">
                <hr>
                <div class="set-humidity">
                    <h2>Humidité du sol</h2>
                    <h3>Taux optimal : <input id="ground-humidity" class="percentage" name="gr-humidity" required="true"> % </h3>
                    <h3>Taux tolérés : Entre <input id="min-humidity" class="percentage" name="min-humidity" required="true"> % et <input id="max-humidity" class="percentage" name="max-humidity" required="true"> % </h3>
                    <hr>
                </div>
                <div class="set-air-details">
                    <h2>Air ambiant</h2>
                    <h3>Humidités tolérées : Entre <input id="min-air-water" class="percentage" name="min-air"> % et <input id="max-air-water" class="percentage" name="max-air"> % </h3>
                    <hr>
                </div>
                <button id="create-module" class="register-button" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
<footer>

</footer>

</html>