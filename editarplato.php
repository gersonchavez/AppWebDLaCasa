<?php
include ('includes/navbar.php');
?>
      
<title>Sistema Web-Restaurant -  Editar Platos</title>



 <div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">ACTUALIZAR DETALLE DE PLATO</h6>
        </div>
        
        <div class="card-body">
            
            <?php
            
            if(isset($_POST['editPlato'])){
                $id_plato = $_POST['edit_id'];
                
                
                $query = "SELECT * FROM plato WHERE id_plato='$id_plato' ";
                $query_run = mysqli_query($conexion, $query);
                
                foreach($query_run as $row){
                ?>
                
                <form action="registrarpedidocode.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id_plato" value="<?php echo $row['id_plato']?>">
                    
                    <div class="form-row">
                    <div class="form-group col-md-9">
                        <label class="text-primary font-weight-bold"> NOMBRE DE PLATO </label>
                        <input required type="text" name="edit_nombreplato" class="form-control text-justify font-weight-bold" value="<?php echo $row['nombre_plato']?>">
                        <small class="form-text text-muted">Digite el nombre del plato sin errores empezando con mayúsculas en cada palabra.</small>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label class="text-primary font-weight-bold">PRECIO UNIDAD</label>
                        <input required type="number" step=any min="1" max="100" name="edit_precioplato" class="form-control text-center font-weight-bold" value="<?php echo $row['precio_unidad']?>">
                        <small class="form-text text-muted text-justify">Digite el precio del plato x unidad o como se venda. Solo se permite números y el tipo de moneda es en soles peruanos.</small>
                    </div>
                        
                </div>
                    
                <div class="form-row">
                    
                    <div class="form-group col-md-8">
                        <label class="text-primary font-weight-bold">DESCRIPCIÓN</label>
                        <textarea required type="text" name="edit_descripcionplato" class="form-control text-justify" rows="4"><?php echo $row['descripcion']?></textarea>
                        <small class="form-text text-muted">Digite de forma detallada la desripción del plato y si es necesario algunos puntos claves que la resalten.</small>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="text-primary font-weight-bold">SUBIR IMÁGEN</label>
                        <input required type="file" name="edit_imagenplato" class="form-control text-justify" value="<?php echo $row['plato_image']?>">
                        <small class="form-text text-muted">La imágen no debe pesar mas de 1MB, por favor sea responsable al elegir la imagen que representará al plato. Además se recomienda colocar un nombre a la imagen del plato antes de subirla para mantener orden en la base de datos. Si quiere editar, tiene que volver a subir la imagen del plato.</small>
                    </div>
                </div>
                    
                
                
                    
                    
                <div class=" form-group custom-control custom-switch">
                    <input required type="checkbox" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label text-danger" for="customSwitch1">Deslize el control si está seguro de editar el plato</label>
                </div>
                    
                <div class="form-group" style="text-align: center;">
                    <a href="gestionarplatos.php" class="btn btn-danger">Cancelar</a>
                    <button type="submit" name="editarPlatobtn" class="btn btn-primary">Editar</button>
                </div>
                
                <?php
                    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                        echo '<h5 class="bg-danger text-white"> '.$_SESSION['status'].'</h5>';
                        unset($_SESSION['status']);
                    }
                ?>
                        
                </form>
                
                <?php
                }
            }
                ?>
            
        </div>
    </div>
</div>






<?php
include ('includes/footer.php');
?>