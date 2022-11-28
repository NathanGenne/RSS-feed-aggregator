<?php

    /**
     * Permet la déconnexion de l'utilisateur et son renvoi vers la page de connexion
     *
     * @return void
     */
    function logout() {
        session_destroy();

        header('Location: ../index.php');
    }

?>