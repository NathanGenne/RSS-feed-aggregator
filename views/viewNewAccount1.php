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
            <input type="text" name="firstname" placeholder="Prénom" autofocus/>
            <input type="text" name="lastname" placeholder="Nom" />
            <input type="text" name="mail" placeholder="Email" />
            <input type="text" name="username" placeholder="Pseudo" />
            <input type="password" name="pwd" placeholder="Mot de passe" />
            <input type="password" name="pwd2" placeholder="Confirmation du mot de passe" />
            <p class = "error"><?php if(isset($_SESSION['newAccountError'])) { echo $_SESSION['newAccountError']; } ?></p>
            
            
            <button type="submit" name="submit" class="submit action-button">Confirmer</button>
            <a href="../login">Retour</a>
        </fieldset>
    </form>
</body>

</html>