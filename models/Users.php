<?php

require './models/db_connect.php';

    class Users extends db_connect {

        /**
         * Récupértion d'un utilisateur à partir de son email et mot de passe
         *
         * @param string $email
         * @param string $password
         * @return array
         */
        function get_user($email, $password)
        {
            $db = $this->connexion;
        
            $sql = <<<EOD
            SELECT
                *
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

        /**
         * Ajoute un utilisateur à la base de donnée
         *
         * @param string $username
         * @param string $user_mail
         * @param string $user_pwd
         * @param string $firstname
         * @param string $lastname
         * @param string $key
         * @param int $verified
         * @return bool
         */
        function add_user($username, $user_mail, $user_pwd, $firstname, $lastname, $key, $verified)
        {
            $db = $this->connexion;

            $sql = <<<EOD
            INSERT INTO user (username, user_mail, user_pwd, user_firstname, user_lastname, confirmkey, verified, topics)
            VALUES (:input_username, :input_mail, :input_pwd, :input_firstname, :input_lastname, :input_key, :input_verified, '')
            EOD;

            $userStmt = $db->prepare($sql);
            $userStmt->bindValue(':input_username', $username);
            $userStmt->bindValue(':input_mail', $user_mail);
            $userStmt->bindValue(':input_pwd', $user_pwd);
            $userStmt->bindValue(':input_firstname', $firstname);
            $userStmt->bindValue(':input_lastname', $lastname);
            $userStmt->bindValue(':input_key', $key);
            $userStmt->bindValue(':input_verified', $verified);

            $userStmt->execute();
            return true;
        }


        /**
         * Récupère les information d'un utilisateur en fonction de son mail
         *
         * @param string $username
         * @return array
         */
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


        /**
         * Récupère l'index de l'utilisateur en fonction de son pseudo
         *
         * @param string $username
         * @return array
         */
        function get_id_by_username($username): int {

            $db = $this->connexion;

            $sql = <<<EOD
            SELECT `user_id` FROM user WHERE username = :input_name
            EOD;

            $userIdStmt = $db->prepare($sql);
            $userIdStmt->bindValue(':input_name', $username);

            $userIdStmt->execute();
            return $userIdStmt->fetch();
        }


        /**
         * Vérification de la validité du compte de l'utilisateur selon son index
         *
         * @param int $id
         * @return array
         */
        function get_verified($id): int {
            
            $db = $this->connexion;

            $sql = <<<EOD
            SELECT verified FROM user WHERE user_id = :input_id
            EOD;

            $verifiedStmt = $db->prepare($sql);
            $verifiedStmt->bindValue(':input_id', $id);

            $verifiedStmt->execute();
            return $verifiedStmt->fetch();
        }

        /**
         * Récupértion des centres d'intérêts de l'utilisateur selon son index
         *
         * @param int $id
         * @return array
         */
        function get_topics_by_id($id)
        {
            $db = $this->connexion;
        
            $sql = <<<EOD
            SELECT
                topics
            FROM
                user
            WHERE user_id = :input_id
            EOD;
        
            $userTopicsStmt = $db->prepare($sql);
            $userTopicsStmt->bindValue(':input_id', $id);
        
            $userTopicsStmt->execute();
        
            return $userTopicsStmt->fetch();
        }
    }

    

?>