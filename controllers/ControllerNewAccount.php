<?php

    class ControllerNewAccount {

        public function phase1() {
            require 'views/viewNewAccount1.php';
        }

        public function phase2() {
            require 'views/viewNewAccount2.php';
        }

        public function index() {
            require 'views/viewLogin.php';
        }

        public function verify() {

            require 'models/modelNewAccount.php';

            if (isset($_POST['submit']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['cpass'])) {

                /* Sécurité supplémentaire */
                $firstName = htmlspecialchars($_POST['fname']);
                $lastName  = htmlspecialchars($_POST['lname']);
                $email     = htmlspecialchars($_POST['email']);
                $userName  = htmlspecialchars($_POST['username']);
                $pwd       = htmlspecialchars($_POST['pass']);
                $cpwd      = htmlspecialchars($_POST['cpass']);

                if ($pwd === $cpwd){
        
                    $_SESSION['tmp_firstName'] = $firstName;
                    $_SESSION['tmp_lastName'] = $lastName;
                    $_SESSION['username'] = $userName;
                    $_SESSION['tmp_email'] = $email;
                    $_SESSION['tmp_pass'] = $pwd;

                    unset($_SESSION['new_account_error']);
        
                    header('Location: ./phase2');
        
                } else {
                    $_SESSION['new_account_error'] = "Le mot de passe et sa confirmation ne correspondent pas";
                    header('Location: ./phase1');
                }
            } else {
                $_SESSION['new_account_error'] = "Un des champs n'est pas rempli";
                header('Location: ./phase1');
            }
        }

        public function setNewAccount(){

            require './models/modelNewAccount.php';

            if(isset($_POST['submit'])) {

                if(!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['pwd']) && !empty($_POST['pwd2']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
                    $username  = htmlspecialchars($_POST['username']);
                    $user_mail = htmlspecialchars($_POST['mail']);
                    $pwd       = sha1($_POST['pwd']);
                    $pwd2      = sha1($_POST['pwd2']);
                    $firstname = htmlspecialchars($_POST['firstname']);
                    $lastname  = htmlspecialchars($_POST['lastname']);

                    $model = new modelNewAccount();
                    if(filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
                        // Fonction vérifiant l'existance du mail entré en paramètre
                        $mailexist =  $model->get_user_by_mail($user_mail);
                        // Si le mail n'existe pas :
                        if(!$mailexist) {
                            // Si les mots de passe ne sont pas cohérents :
                            if($pwd == $pwd2) {
                                // On génère une clé unique à chaque utilisateur
                                $key = uniqid();
                                echo $key;
                                
                                $_SESSION['key'] = $key;

                                unset($_SESSION['newAccountError']);

                                $model->add_user($username, $user_mail, $pwd, $firstname, $lastname, $key, uniqid());
        
                                $header="MIME-Version: 1.0\r\n";
                                $header.='From:"<test.rhode@gmail.com>'."\n";
                                $header.='Content-Type:text/html; charset="uft-8"'."\n";
                                $header.='Content-Transfer-Encoding: 8bit';
                                $message='
                                <html>
                                <body>
                                    <div align="center">
                                        <h3>Vous y êtes presque !</h3><br>
                                        <a href="http://127.0.0.1/rss_feed_aggregator.test/newAccount/phase2?username='.urlencode($username).'&key='.$key.'">Confirmez votre compte !</a>
                                    </div>
                                </body>
                                </html>
                                ';
                                mail($mail, "Confirmation de compte", $message, $header);
                                $_SESSION['newAccountError'] = "Un email de confirmation vous a été envoyé à l'adresse <b>".$user_mail."</b>.";
                                header('Location: ./phase1');
                            
                            } else {
                                $_SESSION['newAccountError'] = "Vos mots de passes ne correspondent pas !";
                            }
                        } else {
                            $_SESSION['newAccountError'] = "Adresse mail déjà utilisée !";
                        }
                    } else {
                        $_SESSION['newAccountError'] = "Votre adresse mail n'est pas valide !";
                    }
            } else {
               $_SESSION['newAccountError'] = "Tous les champs doivent être complétés !";
            }
        }
        header('Location: ./phase1');
    }

}
