<?php

function conectarDB(){
    $db=mysqli_connect('localhost', 'root','root', 'bienesraices');

    if(!$db){
        echo("Error al conectarse");
        exit;
    }

    return $db;
}