<?php

    class ControllerLogin {

        public function index() {
            // On supprime le contenu de la variable contenant les messages d'erreur
            unset($_SESSION['newAccountError']);
            require 'views/viewLogin.php';
        }

        public function verify() {

            require 'models/Users.php';

            unset($_SESSION['login_error']);

            if (isset($_POST['login']) && !empty($_POST['email']) && !empty($_POST['password'])) {

                /* Sécurité supplémentaire */
                $email = htmlspecialchars($_POST['email']);
                $pwd   = htmlspecialchars($_POST['password']);

                $model = new Users();
                $user  = $model->get_user($email, $pwd);

                if ( $user && $pwd == $_POST['password'] ) {

                    $_SESSION['id'] = $user['user_id'];

                    if( $model->get_verified($_SESSION['id'])['verified'] == 1 ) {
                        $_SESSION['verified'] = 1;
                        $_SESSION['mail'] = $email;
                        $_SESSION['pwd'] = $pwd;

                        header('Location: ../home');

                    } else {
                        $_SESSION['login_error'] = "Votre compte n'est pas vérifié";
                        header('Location: ../login');
                    }

                } else {
                    $_SESSION['login_error'] = "Mauvais email ou mot de passe";
                    header('Location: ../login');
                }

        }

    }
    
}

?>