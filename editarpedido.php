<?php
include ('includes/navbar.php');
?>
      
<title>Sistema Web-Restaurant -  Editar Pedidos</title>



 <div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-center">ACTUALIZAR DETALLE DE PEDIDO</h6>
        </div>
        
        <div class="card-body">
            
            <?php
            
            if(isset($_POST['edit_pedido'])){
                $id_pedido = $_POST['edit_id'];
                
                
                $query = "SELECT p.id_pedido, u.nombres as usuario, p.nombre_cliente, p.dni_cliente,p.celular_cliente, p.direccion, p.platosorden,p.tipo_comprobante, IF(p.tipo_pedido = 1, 'EN LOCAL', 'EN LÍNEA') AS tipo_pedido,p.precio_total,p.estado FROM pedido p INNER JOIN usuario u ON p.id_usuario = u.id_usuario WHERE id_pedido='$id_pedido' ";
                $query_run = mysqli_query($conexion, $query);
                
                foreach($query_run as $row){
                ?>
                
                <form action="registrarpedidocode.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_id_pedido" value="<?php echo $row['id_pedido']?>">
                    
                    <div class="form-group">
                        <label class="text-primary font-weight-bold"> USUARIO QUE REGISTRÓ PEDIDO </label>
                        <label readonly required type="text" name="edit_usuario" rows="3" class="form-control text-justify text-muted"><?php echo $row['usuario'] ?></label>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="text-primary font-weight-bold"> NOMBRES DE CLIENTE </label>
                            <input required type="text" name="edit_nombres" rows="3" class="form-control text-justify font-weight-bold" value="<?php echo $row['nombre_cliente'] ?>">
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label class="text-primary font-weight-bold">DNI</label>
                            <input required type="ema" name="edit_dni" class="form-control text-justify" value="<?php echo $row['dni_cliente'] ?>">
                        </div>
                        
                        <div class="form-group col-md-3">
                            <label class="text-primary font-weight-bold">TELÉFONO</label>
                            <input required type="text" name="edit_celular" class="form-control text-justify" value="<?php echo $row['celular_cliente'] ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                              <label class="text-primary font-weight-bold">DIRECCIÓN</label>
                              <input type="text" name="edit_direccion" class="form-control text-justify" value="<?php echo $row['direccion'] ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-12">
                              <label class="text-primary font-weight-bold">DETALLE DE PEDIDO</label>
                              <label required type="text" name="edit_platos_orden" class="form-control text-center text-muted"><b><?php echo $row['platosorden'] ?></b></label>
                            <small class="form-text text-muted">Aquí se detalla el nombre del plato y la cantidad que pidió el cliente.</small>
                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                          <label class="text-primary font-weight-bold">TIPO DE COMPROBANTE</label>
                          <select required class="custom-select" name="edit_tipo_comprobante">
                            <option value="<?php echo $row['tipo_comprobante'] ?>"><?php echo $row['tipo_comprobante'] ?></option>
                            <option value="boleta">boleta</option>
                            <option value="factura">factura</option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                              <label class="text-primary font-weight-bold">FORMA DE PEDIDO</label>
                              <label required type="text" name="edit_telefono" class="form-control text-justify text-muted"><b><?php echo $row['tipo_pedido'] ?></b></label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                              <label class="text-primary font-weight-bold">PRECIO TOTAL</label>
                              <label required type="text" name="edit_telefono" class="form-control text-justify text-muted font-weight-bold">S/. <?php echo number_format($row['precio_total'],2) ?></label>
                        </div>
                        
                        <?php
                            $query = "SELECT * FROM pedido WHERE id_pedido='$id_pedido'";
                            $consulta = mysqli_query($conexion,$query);
                            $array = mysqli_fetch_array($consulta);


                            $estado_pedido = $array['tipo_pedido'];
                        if($estado_pedido == '1'){
                            
                          ?>
                        
                        <div class="form-group col-md-6">
                              <label class="text-danger font-weight-bold">ESTADO</label>
                            <select required class="custom-select font-weight-bold" name="edit_estado">
                            <option value="<?php echo $row['estado'] ?>"><?php echo $row['estado'] ?></option>
                            <option value="EN PROCESO">EN PROCESO</option>
                            <option value="CULMINADO">CULMINADO</option>
                            <option value="SERVIDO EN MESA">SERVIDO EN MESA</option>
                            <option value="COBRADO">COBRADO</option>
                          </select>
                        </div>
                        <?php
                        }else{
                            
                        ?>
                            <div class="form-group col-md-6">
                              <label class="text-danger font-weight-bold">ESTADO</label>
                            <select required class="custom-select font-weight-bold" name="edit_estado">
                            <option value="<?php echo $row['estado'] ?>"><?php echo $row['estado'] ?></option>
                            <option value="EN PROCESO">EN PROCESO</option>
                            <option value="CULMINADO">CULMINADO</option>
                            <option value="REPARTIDO POR DELIVERY">REPARTIDO POR DELIVERY</option>
                          </select>
                        </div>
                            
                            
                        <?php    
                        }                        
                        ?>
                        
                    </div>
                    
                    
                    <div class=" form-group custom-control custom-switch">
                        <input required type="checkbox" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label text-danger" for="customSwitch1">Deslize el control si está seguro de actualizar el pedido</label>
                    </div>
                    
                    <div class="form-group" style="text-align: center;">
                        <a href="gestionarpedidos.php" class="btn btn-danger">Cancelar</a>
                        <button type="submit" name="updatePedidobtn" class="btn btn-primary">Actualizar</button>
                    </div>
                        
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
