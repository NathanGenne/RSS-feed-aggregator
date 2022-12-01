<?php
    $topics = ["international","europe","bresil","sport","politique","emploi","livres"];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublier</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <form id="msform" action="./home/sendNewPasswordMail" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h3>J'ai oublié mon mot de passe</h3>
            <div class="container">
                <label for="mail"><b>Insérez votre Email pour reçevoir un mail de création de mot de passe</b></label>
                <input type="email" placeholder="Email" name="mail" required placeholder="nathan.genne@gmail.com">
                <button type="submit">Valider</button>
            </div>
        </fieldset>
    </form>

</body>

</html>