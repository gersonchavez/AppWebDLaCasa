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
include ('includes/navbar.php');
?>

<title>Sistema Web-Restaurant -  Confirmar orden</title>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="registropedido.php">Platos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="carro.php">Carrito <span id="cart-item" class="badge badge-danger">2</span></a>
  </li>
</ul>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
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
                data: $('form').serialize() + "&action=order",
                success: function(response){
                    $("#order").html(response);
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




<?php
include ('includes/footer.php');
?>
