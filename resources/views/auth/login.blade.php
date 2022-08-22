<!DOCTYPE html>
<html>

<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/login.css')}}">
</head>

<body>


    <div class="auth">
        <h1>Authentification</h1>
        <!-- Div pour entrer les info et valider -->
        <form method="POST" action="connect">
            @csrf
            <div class="container-email">
                <input id="email" type="text" style="height: 200%; width: 50%;" placeholder="Votre identifiant" name="email" required="true">
            </div>
            <div class="container-pwd">
                <input id="password" type="password" style="height: 200%; width: 50%;" placeholder="Votre mot de passe" name="pwd" required="true">
            </div>
            <div class="bouton">
                <button id="connect" style="height: 200%; width: 30%;" type="submit">Se connecter</button>
            </div>
        </form>

        <!-- Div pour les href -->
        <div class="pwdforgot">
            <a href=""> mot de passe oublié ?</a>
        </div>
        <div class="register">
            <a href="register"> s'enregistrer</a>
        </div>

    </div>
</body>


</html>