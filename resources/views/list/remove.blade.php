<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\Module;

echo SessionController::checkIfConnected();
SessionController::adminOnly();

// Charge les classes nécessaires
$iId = $_GET['id'];
$_SESSION['mde_id'] = $iId;
$oModuleModel = new Module();
$aModuleList = $oModuleModel->getById($iId);
$aModule = $aModuleList[0];
?>
<html>

<head>
    <title>Suppression du module</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/list.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/remove.css')}}" rel="stylesheet" type="text/css">
    <style>
        body {
            background-image: url('/projet/resources/images/background.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <form method="POST" action="removeModule">
    @csrf
        <div class="remove-modal">
            <div class="header-modal">
                <h2>Suppression d'un module</h2>
            </div>
            <div class="body-modal">
                <h3>Voulez-vous vraiment supprimer le module contenant la plante suivante : "<?php echo ($aModule->plant_name) ?>" ?</h3>
            </div>
            <div class="buttons">
                <a class="button-no" href="../list">Non</a>
                <button id="remove-module" class="button-yes" type="submit">Oui</button>
            </div>
        </div>
    </form>
</body>

</html>