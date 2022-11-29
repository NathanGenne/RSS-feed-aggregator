<link rel="stylesheet" href="assets/css/connexion.css">

<form class="formulaire " method="post" action="">
    <h1>Connexion</h1>

    <label>Login*</label></br>
    <input type="hidden" name="to" value="rodson@gmail.com">
    <div class="form-group">
        <input type="email" class="form-control form-control-sm" placeholder="Votre email" required="required" name="email">
    </div>
    <div class="form-group">
        <label>Pasword*</label></br>
        <input type="password" pattern="^\D[A-z-]*$" class="form-control form-control-sm" id="inlineFormInput" placeholder="Votre mot de passe" required="required" name="name">
    </div>

    <button class="connexion" value="login" name="login" type="submit" class="btn btn-success">Connexion</button> <br>
    <a class="compte" href="./form_creation_vue.php">crée votre compte</a>
</form>