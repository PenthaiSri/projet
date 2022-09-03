<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\Module;

echo SessionController::checkIfConnected();
SessionController::adminOnly();

$iId = $_GET['id'];
$_SESSION['mde_id'] = $iId;
$oModuleModel = new Module();
$aModuleList = $oModuleModel->getById($iId);
$aModule = $aModuleList[0];
?>
<html>

<head>
    <title>Modification du module</title>
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
                <li><a href="../admin/create">Administration</a></li>
                <li><a href="../logout" id="logout-button">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>
<body>
    <div class="admin-panel">
        <h1>Administration</h1>
        <strong>
            <p style="color: white;">Modification du module</p>
        </strong>
        <a href="../list"><button type="submit" id="module-cancel" class="cancel-button">Annuler la modification</button></a>
        <hr>
        <div class="module-create">
            <form method="POST" action="editModule">
                @csrf
                <input id="name" class="textfield" type="text" placeholder="Nom de la plante" value="<?php echo($aModule->plant_name)?>" name="name" required="true">
                <input id="locate" class="textfield" type="text" placeholder="Localisation du module" value="<?php echo($aModule->mde_locate)?>" name="locate">
                <input id="description" class="textfield" type="text" placeholder="Description du module" value="<?php echo($aModule->mde_description)?>" name="description">
                <hr>
                <div class="set-humidity">
                    <h2>Humidité du sol</h2>
                    <h3>Taux tolérés : Entre <input id="min-humidity" class="percentage" value="<?php echo($aModule->mde_min_soil)?>" name="min-humidity" required="true"> % et <input id="max-humidity" class="percentage" value="<?php echo($aModule->mde_max_soil)?>"name="max-humidity" required="true"> % </h3>
                    <hr>
                </div>
                <button id="edit-module" class="register-button" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>
<footer>

</footer>

</html>