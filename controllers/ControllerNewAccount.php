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

            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                /* Sécurité supplémentaire */
                $username = htmlspecialchars($_POST['username']);
                $pwd      = htmlspecialchars($_POST['password']);

                $model = new modelNewAccount();
                $user  = $model->get_user($username, $pwd);

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
}

?>