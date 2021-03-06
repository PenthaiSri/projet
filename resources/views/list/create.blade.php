<!DOCTYPE html>
<html>

<head>
    <title>Création d'un module</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/create.css')}}" rel="stylesheet" type="text/css">
</head>
<header>
<div id="nav" class="navbar">
        <div class="centered-nav">
            <ul>
                <li><a href="../home">Acceuil</a></li>
                <li><a href="../list">Relevés</a></li>
                <li><a href="#meteo">Météo</a></li>
                <li><a href="list/create">Administration</a></li>
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
        <button id="user-gest" class="user-create-button">Création d'un utilisateur</button>
        <hr>
        <div class="module-create">
            <input id="name" class="textfield" type="text" placeholder="Nom de la plante">
            <input id="locate" class="textfield" type="text" placeholder="Localisation du module">
            <input id="description" class="textfield" type="text" placeholder="Description du module">
            <hr>
            <div class="set-humidity">
                <h2>Humidité du sol</h2>
                <h3>Taux optimal : <input id="ground-humidity" class="percentage"> % </h3>
                <h3>Taux tolérés : Entre <input id="min-humidity" class="percentage"> % et <input id="max-humidity"
                        class="percentage"> % </h3>
                <hr>
            </div>
            <div class="set-air-details">
                <h2>Air ambiant</h2>
                <h3>Températures tolérées : Entre <input id="min-temp" class="percentage"> % et <input id="max-temp"
                        class="percentage"> % </h3>
                <h3>Humidités tolérées : Entre <input id="min-air-water" class="percentage"> % et <input
                        id="max-air-water" class="percentage"> % </h3>
                <hr>
            </div>
            <button id="create-module" class="register-button" type="submit">Enregistrer</button>
        </div>
    </div>
</body>
<footer>

</footer>

</html>