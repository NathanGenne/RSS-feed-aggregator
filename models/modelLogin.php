<?php

require './models/db_connect.php';

    class modelLogin extends db_connect {
        /* Récupértion d'un user à partir de son email et password */
        function get_user($email, $password)
        {
            $db = $this->connexion;
        
            $sql = <<<EOD
            SELECT
                user_mail,
                user_pwd
            FROM
                user
            WHERE user_mail = :input_mail AND user_pwd = :input_pwd
            EOD;
        
            $userStmt = $db->prepare($sql);
            $userStmt->bindValue(':input_mail', $email);
            $userStmt->bindValue(':input_pwd', $password);
        
            $userStmt->execute();
        
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }



?>