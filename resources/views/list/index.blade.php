<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;
use App\Models\Module;

echo SessionController::checkIfConnected();
SessionController::adminOnly();

// Charge les classes nécessaires
$oModuleModel = new Module();
// Récupère tous les modules enregistrés
$aModuleList = $oModuleModel->getAll();
?>

<html>

<head>
    <title>Liste des modules</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/list.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/table.css')}}" rel="stylesheet" type="text/css">
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
    <div class="container">
        <div class="card-header">
            <h2>Tous les modules</h2>
        </div>
        <div class="card-body">
            <table class="table">
                <tr class="background">
                    <th>ID du module</th>
                    <th>Nom de la plante</th>
                    <th>État</th>
                    <th>Actions</th>
                </tr>
                <?php
                foreach ($aModuleList as $aModule) {
                ?>
                    <tr>
                        <td><?php echo ($aModule->mde_id); ?></td>
                        <td><?php echo ($aModule->plant_name); ?></td>
                        <?php 
                            if ($aModule->ste_id == 3) { ?>
                                <td class="not-configured"><?php echo ($aModule->ste_name); ?></td>
                            <?php } else { ?>
                                <td><?php echo ($aModule->ste_name); ?></td>
                            <?php }
                        ?>
                        <td>
                            <?php if ($aModule->ste_id != 3) {?> 
                            <a class="show-button" href="list/show?id=<?php echo($aModule->mde_id) ?>">Détails</a>
                            <?php  } ?>
                            <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == User::ADMIN) { ?>
                                <a class="edit-button" href="list/edit?id=<?php echo($aModule->mde_id) ?>">Modifier</a>
                                <a class="delete-button" href="list/remove?id=<?php echo($aModule->mde_id) ?>">Supprimer</a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>