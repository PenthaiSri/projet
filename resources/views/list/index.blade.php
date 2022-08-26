<!DOCTYPE html>
<?php
use \App\Http\Controllers\SessionController;
use App\Models\User;

echo SessionController::checkIfConnected();
SessionController::adminOnly();
?>

<html>
<head>
    <title>Liste des modules</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/list.css')}}" rel="stylesheet" type="text/css">
</head>
<header>
<div id="nav" class="navbar">
        <div class="centered-nav">
            <ul>
                <li><a href="home">Acceuil</a></li>
                <li><a href="list">Relevés</a></li>
                <li><a href="#meteo">Météo</a></li>
                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id']== User::ADMIN) {?>
                    <li><a href="list/create">Administration</a></li>
                <?php } ?>
                <li><a href="logout" id="logout-button">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</header>
<body>
    <div class="container">
        <div class="card-header">
            <h2>Tous les modules</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Nom de la plante</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>