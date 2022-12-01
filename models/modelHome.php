<?php

require './models/db_connect.php';

    class modelHome extends db_connect {

        /**
         * Récupertion des centres d'intérêts de l'utilisateur selon son index
         *
         * @param int $id
         * @return void
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