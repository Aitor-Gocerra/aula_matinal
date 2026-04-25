<?php
    // Validar acceso mediante token
    $token = $_GET['token'] ?? null;
    $cookieToken = $_COOKIE['auth_token'] ?? null;

    if ($token) {
        setcookie("auth_token", $token, time() + (86400 * 30), "/");
        $cookieToken = $token;
    }

    if (!$cookieToken && !$token) {
        header("Location: https://07.proyectos.esvirgua.com/");
        exit();
    }

    require_once __DIR__ . "/app/config/config.php";

    if(!isset($_GET['c'])){
        $_GET['c'] = CONTR_DEF;
    }

    if(!isset($_GET['m'])){
        $_GET['m'] = METODO_DEF;
    }

    $rutaControlador = RUTA_CONTROLADOR.$_GET['c'].'.php';
    require_once($rutaControlador);
    $controlador='C'.$_GET['c'];
    $objControlador = new $controlador();
    $datos=[];

    if(method_exists($objControlador, $_GET['m'])){
        $datos = $objControlador -> {$_GET['m']}();
    }
    
    require_once(RUTA_VISTAS.$objControlador->vista.'.php');
?>