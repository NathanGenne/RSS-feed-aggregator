<?php

require './models/db_connect.php';

    class modelNewAccount extends db_connect {
        /* Ajout d'un utilisateur */
        function add_user($username, $user_mail, $user_pwd, $firstname, $lastname, $key, $uniqid)
        {
            $db = $this->connexion;

            $sql = <<<EOD
            INSERT INTO user (username, user_mail, user_pwd, user_firstname, user_lastname, confirmkey, uniqid, topics)
            VALUES (:input_username, :input_mail, :input_pwd, :input_firstname, :input_lastname, :input_key, :input_uniqid, 'non')
            EOD;

            $userStmt = $db->prepare($sql);
            $userStmt->bindValue(':input_username', $username);
            $userStmt->bindValue(':input_mail', $user_mail);
            $userStmt->bindValue(':input_pwd', $user_pwd);
            $userStmt->bindValue(':input_firstname', $firstname);
            $userStmt->bindValue(':input_lastname', $lastname);
            $userStmt->bindValue(':input_key', $key);
            $userStmt->bindValue(':input_uniqid', $uniqid);

            $userStmt->execute();
            return true;
        }

        function get_user_by_mail($user_mail)
        {
            $db = $this->connexion;

            $sql = <<<EOD
            SELECT * FROM user WHERE user_mail = :input_mail
            EOD;

            $userStmt = $db->prepare($sql);
            $userStmt->bindValue(':input_mail', $user_mail);

            $userStmt->execute();
            $user = $userStmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        }
    }



?>