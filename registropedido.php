<?php
include ('includes/navbar.php');
?>

<title>Sistema Web-Restaurant -  Registrar Pedidos</title>

<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" href="registropedido.php">Platos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="carro.php">Carrito <span id="cart-item" class="badge badge-danger">2</span></a>
  </li>
</ul>


<div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
        <?php
            $query = $conexion->prepare("SELECT * FROM plato");
            $query->execute();
            $result = $query->get_result();
            while($row = $result->fetch_assoc()):
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
            <div class="card">
                <div class="card p-1 border-secondary">
                    <img src="<?= $row['plato_image'] ?>" class="card-img-top" height="250">
                </div>
                <div class="card-body p-1 mb-3">
                    <h3 class="card-title text-center text-info"><?= $row['nombre_plato'] ?></h3>
                    <h4 class="card-text text-center text-danger">S/.<?= number_format($row['precio_unidad'],2) ?></h4>
                </div>
                <div class="card-footer p-1">
                    <form action="" class="form-submit">
                        <input type="hidden" class="pid" value="<?= $row['id_plato'] ?>">
                        <input type="hidden" class="pname" value="<?= $row['nombre_plato'] ?>">
                        <input type="hidden" class="pprice" value="<?= $row['precio_unidad'] ?>">
                        <input type="hidden" class="pimage" value="<?= $row['plato_image'] ?>">
                        <button class="btn btn-info btn-block addItemBtn">Agregar a la orden</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
       $(".addItemBtn").click(function(e){
           e.preventDefault();
           
           var $form = $(this).closest(".form-submit");
           var pid = $form.find(".pid").val();
           var pname = $form.find(".pname").val();
           var pprice = $form.find(".pprice").val();
           var pimage = $form.find(".pimage").val();
           
           $.ajax({
              url: 'action.php',
               method: 'post',
               data: {pid:pid,pname:pname,pprice:pprice,pimage:pimage},
               success:function(response){
                   $("#message").html(response);
                   window.scrollTo(0,0);
                   load_cart_item_number();
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













