<?php

    class ControllerLogin {

        public function index() {
            require 'views/viewLogin.php';
        }

        public function verify() {

            require 'models/modelLogin.php';

            if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                /* Sécurité supplémentaire */
                $email = htmlspecialchars($_POST['email']);
                $pwd   = htmlspecialchars($_POST['password']);

                $model = new modelLogin();
                $user  = $model->get_user($email, $pwd);

            if ( $user && $pwd == $_POST['password'] ) {

                $_SESSION['valid'] = true;
                $_SESSION['mail'] = $email;
                $_SESSION['pwd'] = $pwd;
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