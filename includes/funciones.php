<?php

require 'app.php';

function incluirTemplate(string $nombre,bool $inicio=false){
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): bool{
    session_start();
    $aut=$_SESSION['login'];

    if($aut){
        return true;
    }
    return false;
    
}