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

            if (isset($_POST['submit']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['cpass'])) {

                /* Sécurité supplémentaire */
                $firstName = htmlspecialchars($_POST['fname']);
                $lastName = htmlspecialchars($_POST['lname']);
                $email = htmlspecialchars($_POST['email']);
                $pwd = htmlspecialchars($_POST['pass']);
                $cpwd = htmlspecialchars($_POST['cpass']);

                if ($pwd === $cpwd){
                    $model = new modelNewAccount();
                    $user  = $model->get_user($firstName, $lastName, $email, $pwd);
    
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

}
