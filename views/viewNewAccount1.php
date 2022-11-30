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
    <h2 class="">Inscription</h2>
         <br /><br />
         <!-- formualaire de connexion  -->
         <form id="msform" method="POST" action = "./verify">
         <fieldset>
                     <label for="pseudo">Nom :</label>
                     <input type="text" placeholder="Votre Nom" id="pseudo" name="pseudo" value="<?php if(isset($user_nom)) { echo $user_nom; } ?>" />
                     <label for="mail">Email :</label>
                     <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                     <label for="mdp">Mot de passe :</label>
                     <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp" />
                     <label for="mdp2">Confirmation du mot de passe :</label>
                     <input type="password" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                     <p class = "error"><?php if(isset($_SESSION['new_account_error'])) { echo $_SESSION['new_account_error']; } ?></p>

                     <br />
                     <input type="submit" name="forminscription" value="VALIDER" />
                     </fieldset>
         </form>
         <?php
         if(isset($erreur))
         {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
    
<script async src="script.js"></script>



</body>

</html>