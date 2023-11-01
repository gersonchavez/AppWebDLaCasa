<?php
require 'logic/connection.php';
session_start();
?>

<!doctype html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        
      
      
      
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="interfacecliente.php">Restaurant</a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="interfacecliente.php">Inicio</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="registropedidocliente.php">Registrar Pedido</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="">Nosotros</a>
                    </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" href="">Misión y Visión</a>
                    </li>
                  
              </ul>
              
          </div>
          
      </nav>



<title>Sistema Web-Restaurant -  Registrar Pedidos</title>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="registropedidocliente.php">Platos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="carrocliente.php">Carrito <span id="cart-item" class="badge badge-danger">2</span></a>
  </li>
</ul>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div style="display:<?php if(isset($_SESSION['showAlert'])){
                                        echo $_SESSION['showAlert'];
                                        }else{
                                            echo 'none';
                                        } 
                                        unset($_SESSION['showAlert']);
                                    ?>" class="alert alert-success alert-dismissible mt-3">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong><?php if(isset($_SESSION['message'])){echo $_SESSION['message'];} unset($_SESSION['showAlert']); ?></strong>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <td colspan="7">
                                <h4 class="text-center text-info m-0">Platos en tu orden</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Precio Total</th>
                            <th>
                                <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('¿Estas seguro de limpiar tu orden?');">Limpiar orden</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = $conexion->prepare("SELECT * FROM detalle_pedido");
                            $query->execute();
                            $result = $query->get_result();
                            $grand_total = 0;
                            while($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= $row['id_detalle_pedido'] ?></td>
                            <input type="hidden" class="pid" value="<?= $row['id_detalle_pedido'] ?>">
                            <td><img src="<?= $row['imagen_plato'] ?>" width="50"></td>
                            <td><?= $row['nombre_plato'] ?></td>
                            <td>S/.<?= number_format($row['precio_plato'],2) ?></td>
                            <input type="hidden" class="pprice" value="<?= $row['precio_plato'] ?>">
                            <td><input type="number" class="form-control itemCantidad" value="<?= $row['cantidad'] ?>" style="width:75px;"></td>
                            <td>S/.<?= number_format($row['precio_total'],2) ?></td>
                            <td><a href="action.php?remove=<?= $row['id_detalle_pedido'] ?>" class="text-danger lead" onclick="return confirm('¿Estas seguro de quitar este plato?');">Eliminar</a> </td>
                        </tr>
                        <?php $grand_total +=$row['precio_total'] ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">
                                <a href="registropedidocliente.php" class="btn btn-success">Agregar más platos</a>
                            </td>
                            <td colspan="2">
                                <b>Precio Final</b>
                            </td>
                            <td>
                                <b>S/.<?= number_format($grand_total,2) ?></b>
                            </td>
                            <td>
                                <a href="verificarcliente.php" class="btn btn-info <?= ($grand_total>1)?"":"disabled"; ?>">Confirmar orden</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>



<script type="text/javascript">
    $(document).ready(function(){
        
        $(".itemCantidad").on('change',function(){
           var $el = $(this).closest('tr');
            
            var pid = $el.find(".pid").val();
            var pprice = $el.find(".pprice").val();
            var cantidad = $el.find(".itemCantidad").val();
            location.reload(true);
            $.ajax({
               url: 'action.php',
                method: 'post',
                cache: false,
                data: {cantidad:cantidad,pid:pid,pprice:pprice},
                success: function(response){
                    console.log(response);
                }
            });
        });
        
        load_cart_item_number();
        
        function load_cart_item_number(){
            $.ajax({
               url: 'action.php',
                method: 'get',
                data: {cartItem:"cart_item"},
                success:function(response){
                    $("#cart-item").html(response);
                }
            });
        }
    });
</script>
      
      
       
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
  </body>
</html>