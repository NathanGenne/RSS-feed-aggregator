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
        
                    $_SESSION['tmp_firstName'] = $firstName;
                    $_SESSION['tmp_lastName'] = $lastName;
                    $_SESSION['tmp_email'] = $email;
                    $_SESSION['tmp_pass'] = $pwd;
        
                    header('Location: ../newAccount/phase2');
        
                } else {
                    header('Location: ../newAccount/phase1');
                }
            }
        }

}
