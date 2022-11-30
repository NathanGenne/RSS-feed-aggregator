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
    <form id="msform" action = "./verify" method = "post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Créez votre compte</h2>
            <input type="text" name="fname" placeholder="First Name" />
            <input type="text" name="lname" placeholder="Last Name" />
            <input type="text" name="email" placeholder="Email" />
            <input type="text" name="username" placeholder="Pseudo" />
            <input type="password" name="pass" placeholder="Password" />
            <input type="password" name="cpass" placeholder="Confirm Password" />
            <p class = "error"><?php if(isset($_SESSION['newAccountError'])) { echo $_SESSION['newAccountError']; } ?></p>
            
            <!-- btn  -->
            <!-- <input type="button" name="previous" class="previous action-button" value="Previous" /> -->
            <input type="submit" name="submit" class="submit action-button" value="Submit" />
        </fieldset>
    </form>
</body>

</html>