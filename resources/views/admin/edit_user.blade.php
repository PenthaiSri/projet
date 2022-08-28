<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;

echo SessionController::checkIfConnected();
echo SessionController::adminOnly();

// Charge les classes nécessaires
$aUserModel = new User();
$aUserList = $aUserModel->getAll();
// Charge les classes nécessaires
$iId = $_GET['id'];
$_SESSION['usr_id'] = $iId;
$oUserModel = new User();
$aUserList = $oUserModel->getById($iId);
$aUser = $aUserList[0];
?>
<html>

<head>
    <title>Création d'un utilisateur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/admin.css')}}" rel="stylesheet" type="text/css">
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
    <div class="admin-panel-edit">
        <h1>Administration</h1>
        <a href="../admin/create"><button type="submit" id="user-cancel" class="cancel-button">Annuler la modification</button></a>
        <hr>
        <div class="user-edit">
            <h3>Modification de <?php echo($aUser->usr_firstname)?> <?php echo($aUser->usr_lastname)?></h3>
            <form method="POST" action="editUser">
                @csrf
                <div class="user-names">
                    <input id="lastname" class="textfield" type="text" placeholder="Nom de l'utilisateur" value="<?php echo($aUser->usr_lastname)?>" name="lastname" required="true">
                    <input id="firstname" class="textfield" type="text" placeholder="Prénom de l'utilisateur" value="<?php echo($aUser->usr_firstname)?>" name="firstname" required="true">
                </div>
                <div class="user-coord">
                    <input id="email" class="textfield" type="text" placeholder="Email de l'utilisateur" value="<?php echo($aUser->usr_email)?>" name="email" required="true">
                    <input id="phone" class="textfield" type="text" placeholder="Numéro de téléphone" value="<?php echo($aUser->usr_phone)?>" name="phone" required="true">
                </div>
                <div class="select-option">
                    <div class="col-1">
                        <p>Fonction</p>
                        <select name="fonction" class="select">
                            <option value="1">Maintenance</option>
                            <option value="2">Technicien</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <p>Rôle</p>
                        <select name="role" class="select">
                            <option value="2">Employé</option>
                            <option value="1">Administrateur</option>
                        </select>
                    </div>
                </div>
                <button id="edit-user" class="register-button" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>

</html>