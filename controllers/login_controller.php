<?php
require './models/login_model.php';
$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) 
   && !empty($_POST['password'])) {
      /* Sécurité supplémentaire */
      $username = htmlspecialchars($_POST['username']);
      $pwd      = htmlspecialchars($_POST['password']);
      $user = get_user($username, $pwd);
   if ( $user ) {
      $_SESSION['valid'] = true;
      $_SESSION['user_email'] = $user;
      $_SESSION['user_pwd'] = $user['user_pwd'];
      header('Location: accueil');
   } else {
      $msg = "Mauvais email ou mot de passe";
   }
}

?>