<?php
include("logic/connection.php");
session_start();
 
//Pedido Code
if(isset($_POST['updatePedidobtn'])){
    $id_pedido = $_POST['edit_id_pedido'];
    $nombrescliente = $_POST['edit_nombres'];
    $dnicliente = $_POST['edit_dni'];
    $telefonocliente = $_POST['edit_celular'];
    $direccion = $_POST['edit_direccion'];
    
    $tipocomprobante = $_POST['edit_tipo_comprobante'];
    $estado = $_POST['edit_estado'];
    
    $query = "UPDATE pedido SET nombre_cliente='$nombrescliente', dni_cliente= '$dnicliente', celular_cliente = '$telefonocliente', direccion = '$direccion', tipo_comprobante = '$tipocomprobante',
    estado = '$estado'  WHERE id_pedido ='$id_pedido'";
    
    $query_run = mysqli_query($conexion, $query);

    if($query_run){
        $_SESSION['status'] = "El pedido ha sido actualizado.";
        header('Location: gestionarpedidos.php');
    }else{
        $_SESSION['status'] = "El pedido no pudo ser actualizado.";
        header('Location: gestionarpedidos.php');
    } 
}



if(isset($_POST['deletePedido'])){
    $id_pedido = $_POST['delete_id'];
    
    $query = "DELETE FROM pedido WHERE id_pedido='$id_pedido' ";
    $query_run = mysqli_query($conexion, $query);
    
    if($query_run){
        $_SESSION['status'] = "El pedido ha sido eliminado.";
        header('Location: gestionarpedidos.php');
    }else{
        $_SESSION['status'] = "El pedido no pudo ser eliminado.";
        header('Location: gestionarpedidos.php');
    }
}

//Plato Code
if(isset($_POST['registrarPlatobtn'])){
    $nombreplato = $_POST['nombreplato'];
    $descripcionplato = $_POST['descripcionplato'];
    $precioplato = $_POST['precioplato'];
    $imagenplato = $_FILES['imagenplato'];
    
    $imagennombre = $_FILES['imagenplato']['name'];
    $imagenTmpName = $_FILES['imagenplato']['tmp_name'];
    $imagenSize = $_FILES['imagenplato']['size'];
    $imagenError = $_FILES['imagenplato']['error'];
    $imagenType = $_FILES['imagenplato']['type'];
    
    $imagenExt = explode('.', $imagennombre);
    $imagenActualExt = strtolower(end($imagenExt));
    
    $allowed = array('jpg', 'jpeg', 'png');
    
    if(in_array($imagenActualExt, $allowed)){
        if($imagenError === 0){
            if($imagenSize < 1100000){
                $imagenDestino = 'images/'.$imagennombre;
                
                
                $query = "INSERT INTO plato(nombre_plato,descripcion,precio_unidad,plato_image) VALUES('$nombreplato','$descripcionplato','$precioplato','$imagenDestino') ";
                $query_run = mysqli_query($conexion, $query);
                
                if($query_run){
                    move_uploaded_file($imagenTmpName,$imagenDestino);
                    $_SESSION['status'] = "El plato ha sido registrado con éxito";
                    header('Location: gestionarplatos.php');
                }else{
                    $_SESSION['status'] = "No se pudo registrar el plato, intente de nuevo.".$imagenDestino;
                    header('Location: registroplatos.php');
                }
                                
            } else{
                $_SESSION['status'] = "Archivo muy pesado, intente de nuevo.";
                header('Location: registroplatos.php');
            }
            
        }else{
            $_SESSION['status'] = "¡Existe un error al subir el archivo!. Intenta de nuevo.";
            header('Location: registroplatos.php');
        }
    }else{
        $_SESSION['status'] = "No puedes subir archivos con este tipo de extensión. Intenta de nuevo";
        header('Location: registroplatos.php');
    }
}



if(isset($_POST['editarPlatobtn'])){
    $id_plato = $_POST['edit_id_plato'];
    $nombreplato = $_POST['edit_nombreplato'];
    $descripcionplato = $_POST['edit_descripcionplato'];
    $precioplato = $_POST['edit_precioplato'];
    $imagenplato = $_FILES['edit_imagenplato'];
    
    $imagennombre = $_FILES['edit_imagenplato']['name'];
    $imagenTmpName = $_FILES['edit_imagenplato']['tmp_name'];
    $imagenSize = $_FILES['edit_imagenplato']['size'];
    $imagenError = $_FILES['edit_imagenplato']['error'];
    $imagenType = $_FILES['edit_imagenplato']['type'];
    
    
    $imagenExt = explode('.', $imagennombre);
    $imagenActualExt = strtolower(end($imagenExt));
    
    $allowed = array('jpg', 'jpeg', 'png');
    
    if(in_array($imagenActualExt, $allowed)){
        if($imagenError === 0){
            if($imagenSize < 1100000){
                $imagenDestino = 'images/'.$imagennombre;
                
                
                $query = "UPDATE plato SET nombre_plato='$nombreplato', descripcion= '$descripcionplato', precio_unidad = '$precioplato', plato_image = '$imagenDestino' WHERE id_plato ='$id_plato'";
                $query_run = mysqli_query($conexion, $query);
                
                if($query_run){
                    move_uploaded_file($imagenTmpName,$imagenDestino);
                    $_SESSION['status'] = "El plato ha sido actualizado con éxito";
                    header('Location: gestionarplatos.php');
                }else{
                    $_SESSION['status'] = "No se pudo actualizar el plato, intente de nuevo.".$imagenDestino;
                    header('Location: gestionarplatos.php');
                }
                                
            } else{
                $_SESSION['status'] = "Archivo muy pesado, intenet de nuevo.";
                header('Location: gestionarplatos.php');
            }
            
        }else{
            $_SESSION['status'] = "¡Existe un error al subir el archivo!. Intenta de nuevo.";
            header('Location: gestionarplatos.php');
        }
    }else{
        $_SESSION['status'] = "No puedes subir archivos con este tipo de extensión. Intenta de nuevo";
        header('Location: gestionarplatos.php');
    }
    
    
    
    
    
    

    
}



if(isset($_POST['deletePlato'])){
    $id_plato = $_POST['delete_id'];
    
    $query = "DELETE FROM plato WHERE id_plato='$id_plato' ";
    $query_run = mysqli_query($conexion, $query);
    
    if($query_run){
        $_SESSION['status'] = "El plato ha sido eliminado.";
        header('Location: gestionarplatos.php');
    }else{
        $_SESSION['status'] = "El plato no pudo ser eliminado.";
        header('Location: gestionarplatos.php');
    }
}






?>