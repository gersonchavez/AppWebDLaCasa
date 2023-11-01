<?php
require 'logic/connection.php';

$precio_final = 0;
$platoscadena= '';
$items = array();

$sql = "SELECT CONCAT(nombre_plato, '(',cantidad,')') AS ItemCantidad, precio_total FROM detalle_pedido";
$query = $conexion->prepare($sql);
$query->execute();
$result = $query->get_result();
while($row = $result->fetch_assoc()){
    $precio_final += $row['precio_total'];
    $items[] = $row['ItemCantidad'];
}
$platoscadena = implode(", ", $items);

?>

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
      
      
      
      <title>Sistema Web-Restaurant -  Confirmar orden</title>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="registropedidocliente.php">Platos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="carrocliente.php">Carrito <span id="cart-item" class="badge badge-danger">2</span></a>
  </li>
</ul>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="ordercliente">
            <h4 class="text-center text-info p-2">¡Completa tu orden!</h4>
            <div class="jumbotron p-3 mb-2 text-center">
                <h6 class="lead"><b>Plato(s): </b><?= $platoscadena; ?></h6>
                <h5><b>Importe total: </b>S/.<?= number_format($precio_final,2) ?></h5>
            </div>
            <form action="" method="post" id="placeOrder">
                <input type="hidden" name="platos" value="<?= $platoscadena; ?>">
                <input type="hidden" name="precio_final" value="<?= $precio_final; ?>">
                <div class="form-group">
                    <input type="text" name="nombre" class="form-control" placeholder="Ingresar Nombre" required>
                </div>
                <div class="form-group">
                    <input type="text" name="dni" class="form-control" placeholder="Ingresar DNI" required>
                </div>
                <div class="form-group">
                    <input type="text" name="telefono" class="form-control" placeholder="Ingresar Teléfono" required>
                </div>
                <div class="form-group">
                    <textarea name="direccion" class="form-control" rows="3" cols="10" placeholder="Ingresar Dirección de Envío..." ></textarea>
                </div>
                <h6 class="text-center">Seleccionar tipo de comprobante</h6>
                <div class="form-group">
                    <select required name="tipocomprobante" class="form-control">
                        <option value="" selected disabled>-Seleccionar tipo de comprobante</option>
                        <option value="boleta">Boleta</option>
                        <option value="factura">Factura</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Confirmar orden" class="btn btn-danger btn-block">
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
        
        $("#placeOrder").submit(function(e){
           e.preventDefault();
            $.ajax({
               url: 'action.php',
                method: 'post',
                data: $('form').serialize() + "&action2=ordercliente",
                success: function(response){
                    $("#ordercliente").html(response);
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