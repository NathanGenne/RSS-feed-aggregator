<?php

    class ControllerHome {

        public function index()
        {
            unset($_SESSION['verifConfirmed']);

            if ( isset($_SESSION['verified']) && $_SESSION['verified'] == 1 )
            {
                require 'views/viewHome.php';
            } else
            {
                $_SESSION['login_error'] = "Petit coquinoux ...";
                header('Location: ../login');
            }
        }


        public function phase1()
        {
            unset($_SESSION['verifConfirmed']);

            if ( isset($_SESSION['verified']) && $_SESSION['verified'] == 1 )
            {
                require 'views/viewForgotPassword1.php';
            } else
            {
                $_SESSION['login_error'] = "Petit coquinoux ...";
                header('Location: ../login');
            }
        }

        public function phase2() {
            if ( isset($_SESSION['verified']) && $_SESSION['verified'] == 1 )
            {
                if (isset($_SESSION['verifConfirmed']) && $_SESSION['verifConfirmed'] == 1)
                {
                    require 'views/viewForgotPassword2.php';
                } else
                {
                    require 'views/viewForgotPassword1.php';
                }
                
            } else
            {
                $_SESSION['login_error'] = "Petit coquinoux ...";
                header('Location: ../login');
            }
        }


        public function get_RSS($id)
        {
            $_SESSION['topics'] = '';

            require 'models/Users.php';

            $model = new Users();
            $topics = $model->get_topics_by_id($id);

            if ( !empty($topics) ) {

                $_SESSION['topics'] = $topics;

                header('Location: ../home');

            } else {
                $_SESSION['login_error'] = "Vos préférences sont corrompus";
                header('Location: ../login');
            }

        }

        public function logout() {
            session_destroy();
            header('Location: ../login');
        }

        public function sendNewPasswordMail() {

            if(isset($_POST['mail']) && !empty($_POST['mail']))
            {
                require 'models/Users.php';
                $model = new Users();

                $mail = $_POST['mail'];

                if( $model->get_user_by_mail($mail) ) {
                    
                    $code = uniqid();

                    $header = "MIME-Version: 1.0\r\n";
                    $header .= 'From:"<test.rhode@gmail.com>' . "\n";
                    $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
                    $header .= 'Content-Transfer-Encoding: 8bit';
                    $message = '
                            <html>
                                <body>
                                <div align="center">
                                    <a href="http://127.0.0.1/RSS_inscription/home/verifyMail/' . urlencode($code) . ' ">Confirmez votre modification mot de passe !</a>
                                </div>
                                </body>
                            </html>
                            ';
                    //  envoie du mot de passe sous forme d'un email 
                    mail($mail, "Modification de Mot de passe !", $message, $header);
                }
            }
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
                    $_SESSION['verifConfirmed'] = 1;
                    header('Location: ../phase2');
                }

            } else {
                $_SESSION['newAccountError'] = "Votre lien de vérification ne possède pas de données valides";
                $_SESSION['verified'] = 0;
                header('Location: ../phase1');
            }
        }
    }

?>