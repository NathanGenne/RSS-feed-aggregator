<?php

    class ControllerHome {

        public function index() {
            if ( isset($_SESSION['verified']) && $_SESSION['verified'] === 1 ) {
                require 'views/viewHome.php';
            } else {
                $_SESSION['login_error'] = "Petit coquinoux ...";
                header('Location: ../login');
            }
        }


        public function forgotPassword() {
            if ( isset($_SESSION['verified']) && $_SESSION['verified'] === 1 ) {
                require 'views/viewForgotPassword1.php';
            } else {
                $_SESSION['login_error'] = "Petit coquinoux ...";
                header('Location: ../login');
            }
        }


        public function get_RSS($id) {

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
         * @param string $username
         * @return void
         */
        public function verifyMail($key)
        {
            if(isset($key)) {

                $key = htmlspecialchars($key);

                if ($_SESSION['key'] == $key)
                {
                    $_SESSION['verified'] = 1;
                    header('Location: ../phase2');
                }

            } else
            {
                $_SESSION['newAccountError'] = "Votre lien de vérification ne possède pas de données valides";      
                $_SESSION['verified'] = 0;
                $_SESSION['newAccountError'] = $key;
                header('Location: ../phase1');
            }
      
        }

        public function setPassword() {
            require './models/Users.php';
            $model = new Users();

            if(isset($_POST['pwd'], $_POST['cpwd']) && !empty($_POST['pwd']) && !empty($_POST['cpwd']))
            {

                    $pwd = htmlspecialchars($_POST['pwd']);
                    $cpwd = htmlspecialchars($_POST['cpwd']);

                    if ($pwd === $cpwd)
                    {
                        $model->setPassword($_SESSION['id'],sha1($pwd));
                        header('Location: ../index');
                    } else
                    {
                        $_SESSION['newAccountError'] = "Les mots de passe ne sont pas identiques";
                        header('Location: ../phase2');
                    }

            } else
            {
                $_SESSION['newAccountError'] = "Tous les champs ne sont pas remplis";
                header('Location: ../phase2');
            }
        }
    }

?>