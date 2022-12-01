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
    <form id="msform" action="" method="post">
        <!-- fieldsets -->
        <fieldset>
            <h3>Créez votre nouveau mot de passe</h3>
            <div class="container">
                <label for="pwd"><b>Nouveau mot de passe</b></label>
                <input type="text" name="pwd" required placeholder="1234">
                <label for="cpwd"><b>Confirmer le mot de passe</b></label>
                <input type="text" name="cpwd" required placeholder="1234">
                <button type="submit">Valider</button>
            </div>
        </fieldset>
    </form>

</body>

</html>