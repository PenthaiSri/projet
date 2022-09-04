<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;
use Carbon\Carbon;

echo SessionController::checkIfConnected();
$aDate = Carbon::now()->locale('fr');

$apiKey = "f71a2033eff94c3babdf1ed06ad8324d";
$cityId = "3020247";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=fr&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
?>
<html>

<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/home.css')}}">
    <link href="{{url('css/list.css')}}" rel="stylesheet" type="text/css">
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
                <li><a href="home">Accueil</a></li>
                <li><a href="list">Relevés</a></li>
                <li><a href="weather">Météo</a></li>
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == User::ADMIN) { ?>
                    <li><a href="admin/create">Administration</a></li>
                <?php } ?>
                <li><a href="logout" id="logout-button">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>

<body>
    <div class="resume-up">
        <img src="/projet/resources/images/Green-check-mark-on-transparent-background-PNG.png" width="120" height="120" title="L'ensemble du système fonctionne normalement, pensez à vérifier le niveau d'eau !" align="left">
        <div class="resume-in" style="text-align:center">
            <h1 style="color:white;">Tous les modules sont au vert</h1>
            <a href="list"><button class="bouton" type="button" style="color:white; font-weight: bold;">Accéder aux modules</button></a>
        </div>
    </div>
    <div class="resume-down">
        <div class="log-modules">
            <h2 style="color:white;">Messages et activités des modules</h2>
            <div class="txt-log">
                <p style="vertical-align: top;"></p>
            </div>
        </div>
        <div class="meteo">
            <div>
                <h2 style="color:white;"><?php echo $aDate->isoFormat('LL') ?></h2>
                <h3 style="color:white;"><?php echo Carbon::now()->timezone('Europe/Paris')->format('H:i'); ?> à Émerainville</h3>
                <div>
                    <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" width="100" height="100" title="L'ensemble du système fonctionne normalement, pensez à vérifier le niveau d'eau !" align="left">
                    <div class="temperature">
                        <h1 style="color:#ADD8E6;"><?php echo $data->main->temp; ?> °C</h1>
                        <p style="color:white;"><?php echo $data->weather[0]->description?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>