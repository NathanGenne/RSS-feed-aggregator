<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <form id="msform" action = "./login/verify" method = "post">
         <!-- fieldsets -->
         <fieldset>
            <h3>Connexion</h3>
            <input type = "email" class = "form-control" name = "email" placeholder = "nathan.genne@gmail.com"  required autofocus></br>
            <input type = "password" class = "form-control" name = "password" placeholder = "password" required>
            <p class = "error"><?php if(isset($_SESSION['login_error'])) { echo $_SESSION['login_error']; } ?></p>
            <input class = "submit action-button" type = "submit"  name = "login">
         </fieldset>
         <fieldset>
            <p><a href="./newAccount/phase1">créer un compte</a></p> <br>
            <p><a href="./newAccount/phase1">Mot de passe oublié ?</a></p>
         </fieldset>
    </form>

</body>

</html>