<?php

?>

<link rel="stylesheet" href="assets/css/connexion.css">

<main role="main" class="pt-5 container mt-3 site-content" id="home">
    <h1 class="d-flex justify-content-around pt-5 pb-4">Connectez-vous !</h1>
    <div class = "login-form container">

        <form class = "form-signin" role = "form" action = "./login/verify" method = "post">
           <input type = "email" class = "form-control" 
              name = "username" placeholder = "nathan.genne@gmail.com" 
              required autofocus></br>
           <input type = "password" class = "form-control"
              name = "password" placeholder = "password" required>
              <p class = "erreur"><?php if(isset($_SESSION['login_error'])) { echo $_SESSION['login_error']; } ?></p>
           <button class = "btnLogin bg-secondary-color btn btn-lg btn-block" type = "submit" 
              name = "login">Connexion</button>
        </form>

        <a href="./newAccount/phase1">créer un compte</a>

    </div>
</main>