<?php

    class ControllerHome {

        public function index() {
            if ( isset($_SESSION['verified']) && $_SESSION['verified'] === 1 ) {
                require 'views/viewHome.php';
            } else {
                require 'views/viewLogin.php';
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
    }

?>