<?php

    class ControllerHome {

        public function index() {
            require 'views/viewHome.php';
        }

        public function get_RSS() {

            require 'models/modelHome.php';

            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                /* Sécurité supplémentaire */
                $mail = htmlspecialchars($_SESSION['mail']);

                $model = new modelHome();
                $topics = $model->get_topics($mail);

                if ( !empty($topics) ) {

                    $_SESSION['topics'] = $topics;

                    header('Location: ../home');

                } else {
                    $_SESSION['login_error'] = "Vos préférences sont corrompus";
                    header('Location: ../login');
                }

            }

        }

        public function logout() {
            session_destroy();
            header('Location: ../login');
        }
    }

?>