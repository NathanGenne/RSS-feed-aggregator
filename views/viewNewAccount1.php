<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de compte - 1</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <form id="msform" action = "./setNewAccount" method = "post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Créez votre compte</h2>
            <input type="text" name="firstname" placeholder="Votre Nom" />
            <input type="text" name="lastname" placeholder="Votre prénom" />
            <input type="text" name="mail" placeholder="Votre Email" />
            <input type="text" name="username" placeholder="Votre Pseudo" />
            <input type="password" name="pwd" placeholder="Votre mot de passe" />
            <input type="password" name="pwd2" placeholder="Confirmer votre mot de passe" />
            <p class = "error"><?php if(isset($_SESSION['newAccountError'])) { echo $_SESSION['newAccountError']; } ?></p>
            
            
            <input type="submit" name="submit" class="submit action-button" value="Submit" />
            <a href="../login">Retour</a>
        </fieldset>
    </form>
</body>

</html>