<?php

require './models/db_connect.php';

    class modelHome extends db_connect {
        /* Récupértion des centres d'intérêts de l'utilisateur selon son index */
        function get_topics($id)
        {
            $db = $this->connexion;
        
            $sql = <<<EOD
            SELECT
                topics
            FROM
                user
            WHERE user_id = :input_id
            EOD;
        
            $userStmt = $db->prepare($sql);
            $userStmt->bindValue(':input_id', $id);
        
            $userStmt->execute();
        
            $topics = $userStmt->fetch(PDO::FETCH_ASSOC);
            return $topics;
        }
    }



?>