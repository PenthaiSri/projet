<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;
use \Carbon\Carbon;

echo SessionController::checkIfConnected();
SessionController::adminOnly();

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

<!doctype html>
<html>

<head>
    <title>Page météo</title>
    <link href="{{url('css/weather.css')}}" rel="stylesheet" type="text/css">
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
                    <li><a href="list/create">Administration</a></li>
                <?php } ?>
                <li><a href="logout" id="logout-button">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>
<body>
    <div class="report-container">
        <h2>Ville : <?php echo $data->name; ?></h2>
        <div class="time"><h3>Le <?php echo (Carbon::now()->timezone('Europe/Paris')->format('d/m/Y à H:i')); ?></h3>
        </div>
        <div class="temperature">
            <h3>Temp max: <?php echo $data->main->temp_max; ?>°C / Temp min: <?php echo $data->main->temp_min; ?>°C</h3>
        </div>
        <div class="weather-forecast">
            <h3><?php echo ucwords($data->weather[0]->description); ?></h3>
            <img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" />
        </div>
        <div class="outside">
            <div>Humidité extérieure: <?php echo $data->main->humidity; ?> %</div>
            <div>Vent: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
</body>

</html>