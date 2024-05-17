<?php

session_start();

// get url and trim url
$url = trim( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/' );

// set all routes
$routes = [
    'deshbord' => './deshbord.php',
    'login' => './login.php',
    'user' => './user.php',
    'delete' => './database/delete.php',
    'update' => './database/update.php',
    'logout' =>  './logout.php'
];

 
$basedPage='login';

 //echo $url;

if($url == null){
    header("Location: $basedPage");
}else{
   
    if(array_key_exists($url, $routes)){
        require $routes[$url];
    }else{
        require '404error.html'; // otherwise call 404 page
    }
    
}

if(!empty($_GET['url'])){
    $requestURL=$_GET['url'];
}
?>