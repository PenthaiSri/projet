<!DOCTYPE html>
<html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\Module;
use Carbon\Carbon;
    
echo SessionController::checkIfConnected();

$iId = $_GET['id'];
$_SESSION['mde_id'] = $iId;
$oModuleModel = new Module();
$aModuleList = $oModuleModel->getById($iId);
$aModule = $aModuleList[0];

$aTemperatureList = $oModuleModel->getTemperatureByModId($iId);
if (isset($aTemperatureList[0])) {
    $aTemp = $aTemperatureList[0];
} else { $aTemperatureList[0] = null;}

$aHygroList = $oModuleModel->getHygroByModId($iId);
if (isset($aHygroList[0])) {
   $aHygro = $aHygroList[0]; 
} else { $aHygroList[0] = null;}

$aSolList = $oModuleModel->getSolByModId($iId);
if (isset($aHygroList[0])) {
    $aSol = $aSolList[0];
} else { $aSolList[0] = null;}

?>
<head>
    <title>Détails du module</title>
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
                <li><a href="../weather">Météo</a></li>
                <li><a href="../logout" id="logout-button">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>

<body>
    <div class="panel">
        <div class="title">
            <h1><?php echo($aModule->plant_name)?></h1>
        </div>
        <hr>
        <div class="air-info">
            <h2>Air ambiant</h2>
            <div class="hygrometrie">
                <h3>Hygrométrie</h3>
                <h2><?php if ($aHygroList[0] != null) {echo($aHygro->rdg_value);}?> %</h2>
            </div>
            <div class="temperature">
                <h3>Température</h3>
                <h2><?php if ($aTemperatureList[0] != null) {echo($aTemp->rdg_value);} ?> °C<h2>
            </div>
        </div>
        <div class="ground-info">
            <h2>Humidité du sol</h2>
            <div class="soil-hum">
                <h3>Humidité du sol</h3>
                <h2><?php if ($aSolList[0] != null) {echo($aSol->rdg_value);}?> %</h2>
            </div>
        </div>
        <hr style="clear: both;">
        <div class="settings">
            <div class="logs">
                <h4 style="margin-left: 1%;">Date de mise en service : <?php echo(Carbon::parse($aModule->log_created_at)->format('d/m/Y à H:i'))?></h4>
                <!-- <h4 style="color: aqua; margin-left: 1%;">Voir les dernières activités</h4> -->
            </div>
            <div class="ground-settings">
                <h3>Humidité du sol max : <?php echo($aModule->mde_max_soil)?> %</h3>
                <h3>Humidité du sol min : <?php echo($aModule->mde_min_soil)?> %</h3>
            </div>
        </div>
        <hr style="clear: both;">
        <div class="description">
            <h3>Description : <?php echo($aModule->mde_description)?></h3>
        </div>
    </div>
</body>
</html>