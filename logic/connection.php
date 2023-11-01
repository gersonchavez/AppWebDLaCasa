<?php

$host = 'localhost';
$usuario = 'root';
$clave = 'gbmaster';
$bd = 'bdrestaurant';

$conexion = mysqli_connect($host,$usuario,$clave,$bd);

if($conexion){
    //echo 'Conectado correctamente';
}else{
    echo 'No se pudo conectar a la abse de datos';
}
    
    
?>