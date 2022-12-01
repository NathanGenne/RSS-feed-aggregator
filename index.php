<?php
session_start();

$params = explode('/', $_GET['url']);

// Si le paramètre n'est pas vide
if($params[0] != ""){
    $controller = 'Controller'.ucfirst($params[0]);
    
    $action = isset($params[1]) ? $params[1] : 'index';

    if(file_exists('controllers/'.$controller.'.php')) {

        require_once('controllers/'.$controller.'.php');

        $controller = new $controller();

        if(method_exists($controller, $action)){

            $data = isset($params[2]) ? $params[2] : null;
            $data = explode('&', $data);

            $controller->$action($data);
            
        }
        else {
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    } else {
        http_response_code(404);
        echo "La page recherchée n'existe pas";
    }

} else {
    require_once('controllers/ControllerLogin.php');
    $controller = new ControllerLogin();
    $controller->index();
}

?>