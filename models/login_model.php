<?php
// require_once __DIR__ . './libraries/db.php';
require './libraries/db.php';
/* Récupértion d'un user à partir de son email et password */
 function get_user($email, $password)
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT
        user_email,
        user_pwd
    FROM
        user
    WHERE user_email = :input_email AND user_pwd = :input_pwd
    EOD;

    $userStmt = $db->prepare($sql);
    $userStmt->bindValue(':input_email', $email);
    $userStmt->bindValue(':input_pwd', $password);

    $userStmt->execute();

    $user = $userStmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}


?>