<?php    
// $url = '';
// if(isset($_GET['url'])) 
//     $url = $_GET['url'];

//         require 'view/form_connexion_view.php';
    
    
//     if(preg_match('#article-([0-9]+)#', $url, $params)) {
//         $idArticle = $params[1];
//         require 'view/form_creation_view.php';
//     }
    
//     elseif($url = 'inscription') {
//         $idArticle = 12;
//         // require 'view/form_creation_view.php';
//     }
    
//     else {
//         require 'view/error404.php';
//     }
// // else {
// //     require 'view/error500.php';
// // }


$url = '';
if (isset ($_GET['url'])){
    $url = explode('/', $_GET['url']);
}
// var_dump($url);

if($url == ''){
#revenir a la page d'acceuil 
    // echo"page d'acceuil";
    require './view/form_connexion_vue.php';
#Ne pas avoir un url vide
}elseif($url[0] == 'article' AND !empty($url[1])){
    $idArticle = $url[1];
    // echo "Article numéro ".$url[1];
    require './view/form_connexion_vue.php';
}else{
    // echo "Erreur404";
    require './view/error404.php';
}

?>