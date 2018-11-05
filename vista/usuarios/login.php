<?php
session_start();
if(isset($_SESSION['user'])) {
  if ($_SESSION['user']['admin']==true) {
    header('location:../inicio/admin.php');
  }
}

?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  	<link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/stylebruno.css">
  	<link rel="stylesheet" href="../css/adminstyle.css">
  	<link rel="stylesheet" type="text/css" href="../font/styles.css">
  	<script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  </head>
  </head>
  <body>

    <div class="container">
      <div class="row">
          <form action="login_ok.php" method="post" class="card p-2 d-flex">
          <div class="form-group">
           <label for="email">Email:</label>
           <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
           <label for="pwd">Contraseña:</label>
           <input type="password" name="contrasena" class="form-control" id="pwd">
          </div>
          <button type="submit" name="Enviar" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>



    <script type="text/javascript" src="../js/script.js"></script>
  	<script type="text/javascript" src="../js/jquery.modal.min.js"></script>
  	<script type="text/javascript" src="../js/popper.min.js"></script>
  	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
  </body>
</html>
