<!doctype html>
<html lang="es">
  <head>
      <meta charset="utf-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css">
      
      <title>Sistema Web-Restaurant</title>
      <link rel="icon" href="images/logo.png">
      
  </head>
  <body>
      <section class="Form my-4 mx-5">
          <div class="container">
              
              <div class="row no-gutters">
                  <div class="col-lg-5">
                      <img src="images/main.jpg" class="img-fluid" alt="">                  
                  </div>
                  
                  <div class="col-lg-7 px-5 pt-5">
                      <h1 class="font-weight-bold py-3 col-md-6">Bienvenido,</h1>
                      
                      <h4></h4>
                      <form action="logic/login.php" method="POST">
                          <div class="form-row">
                              <div class="col-lg-7">
                                  <input type="email" placeholder="Correo electrónico" name="email" class="form-control my-3 p-4">
                              </div>                          
                          </div>
                          <div class="form-row">
                              <div class="col-lg-7">
                                  <input type="password" placeholder="*******" name="contrasena" class="form-control my-3 p-4">
                              </div>                          
                          </div>
                          <div class="form-row">
                              <div class="col-lg-7">
                                  <button type="submit" class="btn1 mt-3 mb-5">Ingresar</button>
                              </div>
                              <p>¿Deseas realizar algún pedido en línea? <a href="interfacecliente.php">Ingresa aquí</a> </p>
                          </div>
                          
                          <?php
                            session_start();
                            if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
                                    echo '<h5 class="bg-danger text-white"> '.$_SESSION['status'].'</h5>';
                                    unset($_SESSION['status']);
                                }
                            ?>
                              
                      </form>
                      
                      
                      
                  </div>
              
              </div>
          </div>
      
      </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>