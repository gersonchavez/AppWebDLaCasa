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
          <a class="navbar-brand" href="firstinterface.php">Restaurant</a>
          
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                        
                <li class="nav-item">
                    <a class="nav-link" href="firstinterface.php">Inicio</a>
                </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Administración
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="gestionarpedidos.php">Pedidos</a>
                        
                    <?php
                            $tipo_usuario = $_SESSION['userType'];
                            if($tipo_usuario == 'administracion'){
                        ?>
                      <a class="dropdown-item" href="gestionarplatos.php">Platos</a>
                        <?php
                          }else{
                        ?>
                        <a class="dropdown-item" href="">Platos</a>
                        <?php
                          }
                        ?>
                        
                      
                    </div>
                  </li>
                  
                                  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Registro
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $tipo_usuario = $_SESSION['userType'];
                            if($tipo_usuario == 'mozo' || $tipo_usuario == 'administracion'){
                        ?>
                      <a class="dropdown-item" href="registropedido.php">Pedidos</a>
                        <?php
                          }else{
                        ?>
                        <a class="dropdown-item" href="">Pedidos</a>
                        <?php
                          }
                        ?>
                        
                        <?php
                            $tipo_usuario = $_SESSION['userType'];
                            if($tipo_usuario == 'administracion'){
                        ?>
                      <a class="dropdown-item" href="registroplatos.php">Platos</a>
                        <?php
                          }else{
                        ?>
                        <a class="dropdown-item" href="">Platos</a>
                        <?php
                          }
                        ?>
                        
                    </div>
                  </li>
                  
                  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Acerca de
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Nosotros</a>
                      <a class="dropdown-item" href="#">Misión y Visión</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-muted" href="#">¡Contáctanos aquí!</a>
                    </div>
                  </li>
              </ul>
              
          </div>
          
          <ul class="nav justify-content-end">
              
              <li class="nav-item my-2 my-lg-0">
                    <a class="nav-link disabled text-dark">Bienvenido, <b><?php echo $_SESSION['username']; ?></b> | Su cargo es de: <b><?php echo $_SESSION['userType']; ?></b></a>
                  </li>

              <li class="nav-item">
                  <a class="nav-link text-danger" href="logic/logout.php">Cerrar Sesión</a>
              </li>
          </ul>
          
      </nav>