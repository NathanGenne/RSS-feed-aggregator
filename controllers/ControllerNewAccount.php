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
                            // Si les mots de passe sont cohérents :
                            if($pwd == $pwd2) {
                                // On génère une clé unique à chaque utilisateur
                                $key = uniqid();
                                echo $key;
                                
                                // On stock cette clef dans une variable $_SESSION
                                $_SESSION['key'] = $key;
                                $_SESSION['username'] = $username;

                                // On supprime le contenu de la variable contenant le message d'erreur
                                unset($_SESSION['newAccountError']);

                                // On ajoute les données de l'utilisateur dans la base de donnée
                                $model->add_user($username, $user_mail, $pwd, $firstname, $lastname, $key, uniqid());
                                
                                // On génère et envoi le mail à envoyer à l'utilisateur
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

                                // Le message d'erreur deviens un message invitant l'utilisateur à cliquer sur le lien envoyé par mail
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
