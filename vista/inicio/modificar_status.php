<?php include_once '../estructura/header.php';

  include_once '../../modelo/Ventas.class.php';
  $conectar=new Ventas();

  $status=$_GET['status'];
  $id_ventas=$_GET['id'];
?>
<div class="d-flex justify-content-center col-12 col-md-6 mt-3">
  <form class="card p-3" action="" method="post">
    <div class="form-group">
      <h3>Modificar Status</h3>
    </div>
    <div class="form-group">
      <h4>Status Actual: <?php
      if ($status==1) {
        echo '<strong>ACTIVO</strong>';
      }else {
        echo '<strong>DESACTIVADO</strong>';
      }
    ?></h4>
  </div>
  <div class="form-group d-flex justify-content-center">
    <button class="btn btn-primary" type="submit" name="Enviar">SI</button>
    <a class="btn btn-primary" href="listar_ventas.php">NO</a>
  </div>
  </form>
</div>

<?php

if (isset($_POST['Enviar'])) {
  $conectar->id_ventas=$id_ventas;
  if ($status==1) {
    $conectar->status=0;
  }else {
    $conectar->status=1;
  }
  $resultado=$conectar->modificar_status();
  if ($resultado) {
    header ('location:admin.php');
  }
}


include_once '../estructura/pie_de_pagina.php';?>
