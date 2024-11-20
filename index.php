<?php
    session_start();
    require_once 'connect/function.php';
    require_once 'controllers/homeController.php';
    require_once 'models/homeModel.php';

    $act=$_GET['act']??'/';
    match($act){
        '/'=>(new homeController())->home(),
        'detail' =>(new homeController())->detail($_GET['id']),
        'home' =>(new homeController())->home(),
        'cart' =>(new homeController())->cart(),
        'login' =>(new homeController())->login(),
        'logout' =>(new homeController())->logout(),
        'product' =>(new homeController())->product(),
        'register' =>(new homeController())->register(),
        'dmid'=> (new homeController())->dmshow($_GET['id']),
       
    }
?>
