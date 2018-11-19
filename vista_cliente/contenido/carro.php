<?php
  include_once '../estructura/header_home.php';
  include_once '../estructura/nav_header.php';
  include_once '../../modelo/Productos.class.php';
  $ConexionProductos=new Productos();
  $listar='';
  $Glob_ValorTotal=false;

  if (isset($_POST['Modificar_cantidad'])) {
    $_SESSION['carro_add'][$_POST['pocicion_array']]['cantidad']=$_POST['Modificar_cantidad'];
  }

  if (isset($_GET['eliminar'])) {
    array_splice($_SESSION['carro_add'],$_GET['eliminar']);
  }

  if (isset($_SESSION['carro_add'])) {
    for ($i=0; $i <count($_SESSION['carro_add']) ; $i++) {
      $datos=$_SESSION['carro_add'][$i];
      $ConexionProductos->id_producto=$datos['id'];
      $datosBanco=$ConexionProductos->retornarunico();
      $valorTotal;

      if ($datos['cantidad']>1) {
        $valorTotal=$datosBanco->precio_venta*$datos['cantidad'];
      }else {
        $valorTotal=$datosBanco->precio_venta;
      }

      $Glob_ValorTotal+=$valorTotal;

      $listar.="
        <tr>
          <td>".$datos['id']."</td>
          <td>".$datosBanco->nombre."</td>
          <td>
            <form action='' method='post' >
              <input style='width:80px' type='text' name='Modificar_cantidad' value='".$datos['cantidad']."'>
              <input type='hidden' name='pocicion_array' value='".$i."'>
            </form></td>
          <td>".$datosBanco->precio_venta."</td>
          <td>".$valorTotal."</td>
          <td><a href='carro.php?eliminar=".$i."'>Eliminar</a></td>
        </tr>
      ";
    }
  }
 ?>
 <main>
   <div class="container" style="margin-top:75px">
<table class="table">
  <thead>
    <tr>
      <th>Id Producto</th>
      <th>Nombre</th>
      <th>cantidad</th>
      <th>Precio Unitario</th>
      <th>Precio Total</th>
      <th>Accion</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $listar; ?>
  </tbody>
  <tfoot>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th>Valor Total</th>
      <th><?php echo $Glob_ValorTotal; ?></th>
      <th></th>
    </tr>
  </tfoot>
</table>
<?php if (isset($_SESSION['user'])) {
?>
<form class="d-flex justify-content-center" action="" method="post">
  <a type="submit" href="realizar_compra_ok.php?vt=<?php echo $Glob_ValorTotal; ?>" class="btn btn-primary" name="comprar">Realizar la Compra</a>
</form>
<?php }else {
?>
<div class="d-flex justify-content-center">
  <a href="../../vista/usuarios/login.php" class="btn btn-primary">Iniciar Sesion</a>
  <a href="#" class="btn btn-primary">Registrarse</a>
</div>
<?php } ?>


<?php
include_once '../estructura/footer_home.php';
?>
