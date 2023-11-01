<?php
include ('includes/navbar.php');
?>

<title>Sistema Web-Restaurant -  Registrar Pedidos</title>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="registropedido.php">Platos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="carro.php">Carrito <span id="cart-item" class="badge badge-danger">2</span></a>
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
                                <a href="action.php?clear2=all" class="badge-danger badge p-1" onclick="return confirm('¿Estas seguro de limpiar tu orden?');">Limpiar orden</a>
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
                            <td><a href="action.php?remove2=<?= $row['id_detalle_pedido'] ?>" class="text-danger lead" onclick="return confirm('¿Estas seguro de quitar este plato?');">Eliminar</a> </td>
                        </tr>
                        <?php $grand_total +=$row['precio_total'] ?>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="3">
                                <a href="registropedido.php" class="btn btn-success">Agregar más platos</a>
                            </td>
                            <td colspan="2">
                                <b>Precio Final</b>
                            </td>
                            <td>
                                <b>S/.<?= number_format($grand_total,2) ?></b>
                            </td>
                            <td>
                                <a href="verificar.php" class="btn btn-info <?= ($grand_total>1)?"":"disabled"; ?>">Confirmar orden</a>
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




<?php
include ('includes/footer.php');
?>

