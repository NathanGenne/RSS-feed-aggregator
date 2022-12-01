<?php

    class ControllerNewAccount {

        public function phase1() {
            require 'views/viewNewAccount1.php';
        }

        public function phase2() {
            if( isset($_SESSION['verified']) && $_SESSION['verified'] == 1 ) {
                require 'views/viewNewAccount2.php';
            } else {
                $_SESSION['newAccountError'] = "Vous devez valider votre compte avant d'accéder à la suite de l'inscription";
                require 'views/viewNewAccount1.php';
            }
        }

        public function index() {
            require 'views/viewLogin.php';
        }

        /**
         * Vérifie les informations entrées dans le formulaire de création de compte et envoie le mail de vérification à l'utilisateur
         *
         * @return void
         */
        public function setNewAccount(){

            require './models/Users.php';
            $model = new Users();

            // On supprime le contenu de la variable contenant les messages d'erreur
            unset($_SESSION['newAccountError']);

            if(isset($_POST['submit'])) {

                if(!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['pwd']) && !empty($_POST['pwd2']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])) {
                    $username  = htmlspecialchars($_POST['username']);
                    $user_mail = htmlspecialchars($_POST['mail']);
                    $pwd       = sha1($_POST['pwd']);
                    $pwd2      = sha1($_POST['pwd2']);
                    $firstname = htmlspecialchars($_POST['firstname']);
                    $lastname  = htmlspecialchars($_POST['lastname']);

                    if(filter_var($user_mail, FILTER_VALIDATE_EMAIL)) {
                        // Fonction vérifiant l'existance dans la base de donnée de l'adresse mail entré en paramètre
                        $mailexist =  $model->get_user_by_mail($user_mail);
                        // Si l'adresse mail n'existe pas :
                        if(!$mailexist) {
                            // Si les mots de passe sont cohérents :
                            if($pwd == $pwd2) {
                                // On génère une clé unique à chaque utilisateur
                                $key = uniqid();
                                echo $key;
                                
                                // On stock la clef et le pseudo dans une variable $_SESSION
                                $_SESSION['key'] = $key;
                                $_SESSION['username'] = $username;

                                // On ajoute les données de l'utilisateur dans la base de donnée
                                $model->add_user($username, $user_mail, $pwd, $firstname, $lastname, $key, 0);
                                
                                // On stock l'index de l'utilisateur pour chercher ses informations plus tard
                                $_SESSION['id'] = $model->get_id_by_username($username)['user_id'];

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
                                        <a href="http://127.0.0.1//RSS_feed_aggregator/newAccount/verifyMail/'.$key.'">Confirmez votre compte !</a>
                                    </div>
                                </body>
                                </html>
                                ';
                                mail($user_mail, "Confirmation de compte", $message, $header);

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

        /**
         * Vérifie que les données entrées en paramètre du mail de vérification sont valides
         *
         * @return void
         */
        public function verifyMail($key){
            
            if(isset($key)) {
                require './models/Users.php';
                $model = new Users();

                $key = htmlspecialchars($key[0]);
                $user_key = $model->get_user_by_key(htmlspecialchars($key[0]));

                if ($user_key) {
                    $_SESSION['verified'] = 1;
                    header('Location: ../phase2');
                }

            } else {
                $_SESSION['newAccountError'] = "Votre lien de vérification ne possède pas de données valides";
                $_SESSION['verified'] = 0;
                header('Location: ../phase1');
            }
        }
    }

