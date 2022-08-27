<!DOCTYPE html>
<html>

<head>
    <title>Register page</title>
    <link rel="stylesheet" type="text/css" href="{{url('css/login.css')}}">
</head>

<body>


    <div class="auth">
        <h1>Création de compte</h1>
        <!-- Div pour entrer les info et valider -->
        <form method="POST" action="signin">
            @csrf
            <div class="container-firstname">
                <input id="firstname" type="text" style="height: 200%; width: 50%;" placeholder="Votre prénom" name="firstname" required="true">
            </div>
            <div class="container-lastname">
                <input id="lastname" type="text" style="height: 200%; width: 50%;" placeholder="Votre nom" name="lastname" required="true">
            </div>
            <div class="container-email">
                <input id="email" type="text" style="height: 200%; width: 50%;" placeholder="Votre identifiant" name="email" required="true">
            </div>
            <div class="container-pwd">
                <input id="password" type="password" style="height: 200%; width: 50%;" placeholder="Votre mot de passe" name="pwd" required="true">
            </div>
            <div class="bouton">
                <button id="register" style="height: 200%; width: 30%;" type="submit">S'enregistrer</button>
            </div>
        </form>
    </div>
</body>


</html>