<!DOCTYPE html>
<?php

use \App\Http\Controllers\SessionController;
use App\Models\User;

echo SessionController::checkIfConnected();
echo SessionController::adminOnly();

// Charge les classes nécessaires
$aUserModel = new User();
$aUserList = $aUserModel->getAll();
?>
<html>

<head>
    <title>Gestion des utilisateurs</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{url('css/admin.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/messages.css')}}" rel="stylesheet" type="text/css">
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
    <div class="admin-panel" style="height: 600px;">
        <h1>Administration</h1>
        <strong>
            <p style="color: white;">Gestion des utilisateurs</p>
        </strong>
        <!-- Gère les messages d'erreurs -->
        @if(session('success-create'))
            <div class="alert-success">{{session('success-create')}}</div>
        @endif
        @if(session('error-create'))
            <div class="alert-error">{{session('error-create')}}</div>
        @endif
        <a href="../list"><button type="submit" id="user-cancel" class="cancel-button">Annuler la création</button></a>
        <a href="../list/create"><button id="user-gest" class="module-create-button">Création d'un module</button></a>
        <hr>
        <div class="user-list">
            <h3>Utilisateurs existants</h3>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Fonction</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($aUserList as $aUser) { ?>
                        <tr>
                            <td><?php echo ($aUser->usr_lastname) ?></td>
                            <td><?php echo ($aUser->usr_firstname) ?></td>
                            <td><?php echo ($aUser->ftn_name) ?></td>
                            <td><?php echo ($aUser->role_name) ?></td>
                            <td>
                                <a class="edit-button" href="editUser?id=<?php echo($aUser->usr_id)?>">Modifier</a>
                                <?php if($_SESSION['user_id'] != $aUser->usr_id) { ?>
                                <a class="delete-button" href="removeUser?id=<?php echo($aUser->usr_id)?>">Supprimer</a>
                                <?php } ?>
                            <td>
                        </tr>
                    <?php } ?>
                </thead>
            </table>
        </div>
        <div class="user-create">
            <h3>Ajout d'un utilisateur</h3>
            <form method="POST" action="create">
                @csrf
                <div class="user-names">
                    <input id="lastname" class="textfield" type="text" placeholder="Nom de l'utilisateur" name="lastname" required="true">
                    <input id="firstname" class="textfield" type="text" placeholder="Prénom de l'utilisateur" name="firstname" required="true">
                </div>
                <div class="user-coord">
                    <input id="email" class="textfield" type="email" placeholder="Email de l'utilisateur" name="email" required="true">
                    <input id="phone" class="textfield" type="tel" placeholder="Numéro de téléphone" name="phone" pattern="[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required="true">
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
                <button id="create-user" class="register-button" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
</body>

</html>