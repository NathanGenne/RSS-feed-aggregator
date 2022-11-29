<?php

    class ControllerHome {

        public function index() {
            require 'views/viewHome.php';
        }

        public function get_RSS() {

            require 'models/modelHome.php';

            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                /* Sécurité supplémentaire */
                $username = htmlspecialchars($_POST['username']);
                $pwd      = htmlspecialchars($_POST['password']);

                $model = new modelLogin();
                $user = $model->get_user($username, $pwd);

                if ( $user ) {

                    $_SESSION['valid'] = true;
                    $_SESSION['user_email'] = $user;
                    $_SESSION['user_pwd'] = $user['user_pwd'];
                    unset($_SESSION['login_error']);

                    header('Location: ../home');

                } else {
                    $_SESSION['login_error'] = "Mauvais email ou mot de passe";
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