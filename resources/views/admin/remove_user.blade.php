<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;

echo SessionController::checkIfConnected();
SessionController::adminOnly();

// Charge les classes nécessaires
$iId = $_GET['id'];
$_SESSION['usr_id'] = $iId;
$oUserModel = new User();
$aUserList = $oUserModel->getById($iId);
$aUser = $aUserList[0];
?>
<html>

<head>
    <title>Liste des modules</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <form method="POST" action="removeUser">
    @csrf
        <div class="remove-modal">
            <div class="header-modal">
                <h2>Suppression d'un module</h2>
            </div>
            <div class="body-modal">
                <h3>Voulez-vous vraiment supprimer l'utilisateur : "<?php echo ($aUser->usr_firstname) ?> <?php echo($aUser->usr_lastname)?>" ?</h3>
            </div>
            <div class="buttons">
                <a class="button-no" href="../admin/create">Non</a>
                <button id="remove-User" class="button-yes" type="submit">Oui</button>
            </div>
        </div>
    </form>
</body>

</html>