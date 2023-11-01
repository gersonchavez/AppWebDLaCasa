<?php
include ('includes/navbar.php');
?>

<title>Sistema Web-Restaurant -  Gestionar Platos</title>

<div class="container">
    <h1 class="text-center mb-3 text-primary font-weight-light">LISTA DE PLATOS REGISTRADOS</h1>
    
    <h5 class="text-center mb-5 text-black font-weight-lighter">Los datos que se presentan en la siguiente tabla son el listado de pedidos registrados. Este mismo es filtrado
        según el tipo de usuario que ha ingresado al sistema. Si usted no es de cargo administrativo o mozo del restaurant, porfavor abstenganse de intentar registrar un nuevo
        pedido.</h5>
    
    <div class="table-responsive">
        <?php
            $query = "SELECT * FROM plato ORDER BY id_plato;";
            $query_run = mysqli_query($conexion, $query);
        ?>
        
        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr class="text-center bg-dark text-white">
                    <th>ID</th>
                    <th>NOMBRE DE PLATO</th>
                    <th>PRECIO UNIDAD</th>
                    <th>IMAGEN</th>
                    <th></th>
                </tr>
            </thead>
            
            <tfoot>
                <tr class="text-center bg-dark text-white">
                    <th>ID</th>
                    <th>NOMBRE DE PLATO</th>
                    <th>PRECIO UNIDAD</th>
                    <th>IMAGEN</th>
                    <th></th>
                </tr>
            </tfoot>
            
            <tbody>
                <?php
                
                if(mysqli_num_rows($query_run) > 0){
                    while($row = mysqli_fetch_assoc($query_run)){
                ?>
                
                <tr class="text-center">
                    <td class="font-weight-bold"><?php echo $row['id_plato'] ?></td>
                    <td class=""><?php echo $row['nombre_plato'] ?></td>
                    <td class=""><?php echo $row['precio_unidad'] ?></td>
                    <td><img src="<?= $row['plato_image'] ?>" width="50"></td>

                    <td>
                        <form action="editarplato.php" method="post">
                            <input type="hidden" name="edit_id" value="<?php echo $row['id_plato'] ?>">
                            <button type="submit" name="editPlato" class="btn btn-primary">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pen-fill" fill="black" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                            </button>
                        </form>

                        <form action="registrarpedidocode.php" method="post">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id_plato']; ?>">
                            <button type="submit" name="deletePlato" class="btn btn-warning">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php
                    }
                }
                else{
                    echo "No record Found";
                }
                ?>
            </tbody>
        </table>   
    </div>
    
    <?php
    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
        echo '<h5 class="bg-primary text-white"> '.$_SESSION['status'].'</h5>';
        unset($_SESSION['status']);
    }
    ?>
              
</div>


<?php
include ('includes/footer.php');
?>