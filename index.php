<?php    
$url = '';
if(isset($_GET['url'])) {
    $url = $_GET['url'];

    if($url == '') {
        require 'view/form_connexion_view.php';
    }
    
    elseif(preg_match('#article-([0-9]+)#', $url, $params)) {
        $idArticle = $params[1];
        require 'view/form_creation_view.php';
    }
    
    elseif($url = 'inscription') {
        $idArticle = 12;
        require 'view/form_creation_view.php';
    }
    
    else {
        require 'view/error404.php';
    }
} else {
    require 'view/error500.php';
}

?>