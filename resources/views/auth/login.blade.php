<!DOCTYPE html>
<html>

<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/login.css')}}">
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
    <div class="auth">
        <h1>Authentification</h1>
        <!-- Div pour entrer les info et valider -->
        <form method="POST" action="login">
            @csrf
            <div class="container-email">
                <input id="name" type="text" style="text-align: center;" placeholder="Identifiant" name="name" required>
            </div>
            <div class="container-pwd">
                <input id="password" type="password" style="text-align: center;" placeholder="Mot de passe" name="pwd" required>
            </div>
            <div class="bouton">
                <button id="connect" style="height: 200%; width: 30%;" type="submit">Se connecter</button>
            </div>
        </form>

        <!-- Div pour les href -->
        <div class="links">
            <div class="pwdforgot">
                <a href="" style="text-decoration:none;color:white;"> Mot de passe oublié ?</a>
            </div>
            <div class="register">
                <a href="" style="text-decoration:none;color:white;"> S'enregistrer</a>
            </div>
        </div>

    </div>
</body>


</html>