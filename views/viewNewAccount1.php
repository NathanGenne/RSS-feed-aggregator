<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/viewNewAccount1.css">
</head>

<body>
    <form id="msform" action = "" method = "post">
        <!-- fieldsets -->
        <fieldset>
            <h2 class="fs-title">Crée votre compte</h2>
            <input type="text" name="fname" placeholder="First Name" />
            <input type="text" name="lname" placeholder="Last Name" />
            <input type="text" name="email" placeholder="Email" />
            <input type="password" name="pass" placeholder="Password" />
            <input type="password" name="cpass" placeholder="Confirm Password" />
            
            <!-- btn  -->
            <!-- <input type="button" name="previous" class="previous action-button" value="Previous" /> -->
            <input type="submit" name="submit" class="submit action-button" value="Submit" />
        </fieldset>
        <fieldset>
            <h2 class="fs-title"> Crée votre compte </h2>
        </fieldset>
    </form>
    
    <script async src="script.js"></script>
</body>

</html>