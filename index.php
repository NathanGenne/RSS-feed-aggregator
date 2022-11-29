<?php

ob_start();
session_start();

$_SESSION['valide'] = true;

// L'url est vide par défaut
$url = [''];

// Si l'url existe (et n'est pas vide) alors elle est récupérée dans la variable $url
if(isset($_GET['url'])) {
    $url = $_GET['url'];

    // L'url est découpée en éléments distinct pour les étudier indépendement
    $url = explode('/',$url);
}

require_once 'inc/header.php';

// Ce switch explore toutes les possibilités prises en compte quand à la composition du premier élément de l'url
switch ($url[0]) {
    // Si l'url est vide, on redirige le visiteur sur la page de connexion
    case '':
        require 'view/login_view.php';
        break;

    case 'inscription':
        // On vérifie la syntaxe du deuxième composant de l'url pour déterminer l'étape d'inscription
        if ($url[1] == 'etape-1') {
            echo 'etape 1<br>';
            require 'view/create_account_part1_view.php';

        } elseif ($url[1] == 'etape-2') {
            echo 'etape 2<br>';
            require 'view/create_account_part2_view.php';
        }
        break;

    case 'connexion':
        require 'view/login_view.php';
        break;

    case 'accueil':
        // L'accès aux pages nécessitant d'avoir été connecté nécessite un niveau de sécurité supplémentaire
        if (isset($_SESSION['valide'])) {
            require 'view/home_page_view.php';
        }
        break;
            
}
?>