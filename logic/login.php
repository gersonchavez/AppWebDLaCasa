<?php
require 'connection.php';
session_start();

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];

$q = "SELECT COUNT(*) AS contar,id_usuario,nombres,tipo_usuario FROM usuario WHERE email = '$email' and contrasena = '$contrasena'";
$consulta = mysqli_query($conexion,$q);
$array = mysqli_fetch_array($consulta);

    
$nombre_usuario = $array['nombres'];
$tipo_usuario = $array['tipo_usuario'];
$id_usuario = $array['id_usuario'];

if($array['contar'] > 0){
    $_SESSION['username'] = $nombre_usuario;
    $_SESSION['userType'] = $tipo_usuario;
    $_SESSION['userID'] = $id_usuario;
    header("location: ../firstinterface.php");
}else{
    header("location: ../main.php");
    $_SESSION['status'] = 'Los datos ingresados son incorrectos, por favor verifique.';
}


?>