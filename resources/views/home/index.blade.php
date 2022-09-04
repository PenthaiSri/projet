<!DOCTYPE html>
<html>

<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/home.css')}}">
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
    <div class="resume-up">
        <img src="/projet/resources/images/Green-check-mark-on-transparent-background-PNG.png"
        width="120"
        height="120"
        title="L'ensemble du système fonctionne normalement, pensez à vérifier le niveau d'eau !"
        align="left">
        <div class="resume-in" style="text-align:center">
            <h1 style="color:white;">Tous les modules sont au vert</h1>
            <button class="bouton" type="button" style="color:white; font-weight: bold;">Accéder aux modules</button>
        </div>
    </div>
    <div class="resume-down">
        <div class="log-modules">
            <h2 style="color:white;">Messages et activités des modules</h2>
            <div class="txt-log">
                <p style="vertical-align: top;">Début des logs</p>
            </div>
        </div>
        <div class="meteo">
            <div>
                <h2 style="color:white;">Dimanche 24 Juillet</h2>
                <h3 style="color:white;">17h47 à Paris</h3>
                <div>
                    <img src="/projet/resources/images/Sun-And-Cloud-PNG-Transparent.png"
                    width="100"
                    height="100"
                    title="L'ensemble du système fonctionne normalement, pensez à vérifier le niveau d'eau !"
                    align="left">
                    <div class="temperature">
                        <h1 style="color:#ADD8E6;">23°C</h1>
                        <p style="color:white;">Partiellement nuageux</p>
                    </div>
                </div>
            </div>
        </div>     
    </div>
</body>


</html>