<?php
session_start();
require 'logic/connection.php';

if(isset($_POST['pid'])){
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcantidad = 1;
    
    $query = $conexion->prepare("SELECT id_plato FROM detalle_pedido WHERE id_plato=?");
    $query->bind_param("i",$pid);
    $query->execute();
    $res = $query->get_result();
    $r = $res->fetch_assoc();
    $id = $r['id_plato'];
    
    if(!$id){
        $queryinsert = $conexion->prepare("INSERT INTO detalle_pedido(id_plato,nombre_plato,precio_plato,imagen_plato,cantidad,precio_total) VALUES (?,?,?,?,?,?)");
        $queryinsert->bind_param("isssss",$pid,$pname,$pprice,$pimage,$pcantidad,$pprice);
        $queryinsert->execute();
        
        echo '<div class="alert alert-success alert-dismissible mt-2">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>¡Plato agregado a la orden!</strong>
                </div>';
    }else{
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  <strong>¡El plato ya ha sido agregado a la orden!</strong>
                </div>';
    }
}

if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item'){
    $query = $conexion->prepare("SELECT * FROM detalle_pedido");
    $query->execute();
    $query->store_result();
    $rows = $query->num_rows;
    
    echo $rows;
}

if(isset($_GET['remove2'])){
    $id = $_GET['remove2'];
    
    $query = $conexion->prepare("DELETE FROM detalle_pedido WHERE id_detalle_pedido = ?");
    $query->bind_param("i",$id);
    $query->execute();
    
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = '¡Plato removido de la orden!';
    header('location:carro.php');
}
     
if(isset($_GET['clear2'])){
    $query = $conexion->prepare("DELETE FROM detalle_pedido");
    $query->execute();
    
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = '¡Su orden ha sido limpiada!';
    header('location:carro.php');
}


if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    
    $query = $conexion->prepare("DELETE FROM detalle_pedido WHERE id_detalle_pedido = ?");
    $query->bind_param("i",$id);
    $query->execute();
    
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = '¡Plato removido de la orden!';
    header('location:carrocliente.php');
}
     
if(isset($_GET['clear'])){
    $query = $conexion->prepare("DELETE FROM detalle_pedido");
    $query->execute();
    
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = '¡Su orden ha sido limpiada!';
    header('location:carrocliente.php');
}

if(isset($_POST['cantidad'])){
    $cantidad = $_POST['cantidad'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];
    
    $totalprice = $cantidad*$pprice;
    
    $query = $conexion->prepare("UPDATE detalle_pedido SET cantidad=?, precio_total=? WHERE id_detalle_pedido=?");
    $query->bind_param("ssi",$cantidad,$totalprice,$pid);
    $query->execute();
    
}

if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
    $usuario = $_SESSION['userID'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipocomprobante = $_POST['tipocomprobante'];
    $platos = $_POST['platos'];
    $precio_final = $_POST['precio_final'];
    $estado = 'NUEVO';
    $tipo_pedido = 1;
    
    $data = '';
    
    $query = $conexion->prepare("INSERT INTO pedido (id_usuario,nombre_cliente,dni_cliente,celular_cliente,direccion,platosorden,tipo_comprobante,tipo_pedido,precio_total,estado)
                                VALUES(?,?,?,?,?,?,?,?,?,?)");
    $query->bind_param("issssssiss",$usuario,$nombre,$dni,$telefono,$direccion,$platos,$tipocomprobante,$tipo_pedido,$precio_final,$estado);
    $query->execute();
    
    $query2 = $conexion->prepare('DELETE FROM detalle_pedido');
    $query2->execute();
    
    
    $data .= '<div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">¡Muchas gracias!</h1>
                    <h2 class="text-success">¡Tu orden ha sido procesada!</h2>
                    <h4 class="bg-danger text-light rounded p-2">Platos ordenados: ' . $platos . '</h4>
                    <h4>Nombre: ' . $nombre . '</h4>
                    <h4>DNI: ' . $dni . '</h4>
                    <h4>Teléfono: ' . $telefono . '</h4>
                    <h4>Dirección: ' . $direccion . '</h4>
                    <h4>Monto a pagar: S/.' . number_format($precio_final,2) . '</h4>
                    <h4>Tipo de comporbanter: ' . $tipocomprobante . '</h4>
                    <a href="gestionarpedidos.php" class="btn btn-success">Gestión de pedidos</a>
                </div>';
    echo $data;
    
    
}

if (isset($_POST['action2']) && isset($_POST['action2']) == 'ordercliente') {
    $usuario = 1;
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $tipocomprobante = $_POST['tipocomprobante'];
    $platos = $_POST['platos'];
    $precio_final = $_POST['precio_final'];
    $estado = 'NUEVO';
    $tipo_pedido = 2;
    
    $data = '';
    
    $query = $conexion->prepare("INSERT INTO pedido (id_usuario,nombre_cliente,dni_cliente,celular_cliente,direccion,platosorden,tipo_comprobante,tipo_pedido,precio_total,estado)
                                VALUES(?,?,?,?,?,?,?,?,?,?)");
    $query->bind_param("issssssiss",$usuario,$nombre,$dni,$telefono,$direccion,$platos,$tipocomprobante,$tipo_pedido,$precio_final,$estado);
    $query->execute();
    
    $query2 = $conexion->prepare('DELETE FROM detalle_pedido');
    $query2->execute();
    
    
    $data .= '<div class="text-center">
                    <h1 class="display-4 mt-2 text-danger">¡Muchas gracias!</h1>
                    <h2 class="text-success">¡Tu orden ha sido procesada!</h2>
                    <h4 class="bg-danger text-light rounded p-2">Platos ordenados: ' . $platos . '</h4>
                    <h4>Nombre: ' . $nombre . '</h4>
                    <h4>DNI: ' . $dni . '</h4>
                    <h4>Teléfono: ' . $telefono . '</h4>
                    <h4>Dirección: ' . $direccion . '</h4>
                    <h4>Monto a pagar: S/.' . number_format($precio_final,2) . '</h4>
                    <h4>Tipo de comporbanter: ' . $tipocomprobante . '</h4>
                    <a href="registropedidocliente.php" class="btn btn-success">Regresar a la carta</a>
                </div>';
    echo $data;
    
    
}

?>