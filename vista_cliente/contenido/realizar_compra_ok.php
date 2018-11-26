<?php
include_once '../estructura/header_home.php';
include_once '../estructura/nav_header.php';
include_once '../../modelo/Ventas.class.php';
include_once '../../modelo/Producto_Venta.class.php';
include_once '../../modelo/Productos.class.php';


if (isset($_POST['Confirmara'])) {
  $venta= new Ventas();
  $venta->id_usuario=$_SESSION['user']['id_usuario'];
  $venta->valor_total=$_POST['valor_total'];
  $venta->fecha_compra=time();
  $venta->direccion_entrega=$_POST['direccion'];
  $venta->status=0;
  $add_venta=$venta->add_venta();
  $id_venta=$venta->conexion->insert_id;

  for ($i=0; $i <count($_SESSION['carro_add']) ; $i++) {
    $Producto=new Productos();
    $Producto->id_producto=$_SESSION['carro_add'][$i]['id'];
    $Producto_unico=$Producto->retornarunicoID();

    $Producto_Venta=new Producto_Venta();
    $Producto_Venta->id_productos=$_SESSION['carro_add'][$i]['id'];
    $Producto_Venta->id_ventas=$id_venta;
    $Producto_Venta->cantidad=$_SESSION['carro_add'][$i]['cantidad'];
    $Producto_Venta->valor_producto=$Producto_unico->precio_venta;
    $resultado_Producto=$Producto_Venta->add_Venta();
  }

  unset($_SESSION['carro_add']);
  header('location:home-page.php?exito_compra');

}
?>

 <div class="container" style="margin-top:85px">
  <form class="col-md-6" action="" method="post" style="margin-top:75px">
    <div class="form-group">
      <div class="d-flex justify-content-center">
        <label for="dir">Direccion de la entrega:</label>
      </div>
      <input type="text" class="form-control" id="dir" placeholder="Digite la Direccion " name="direccion">
    </div>
    <div class="form-group">
      <div class="d-flex justify-content-center">
        <label for="dir">Valor Total a Pagar:</label>
      </div>
      <input type="hidden" name="valor_total" value="<?php echo $_GET['vt']; ?>">
      <span class='btn-outline-info btn-sm nav-link mr-2' ><div class="text-danger" style="text-align:center" ><?php echo $_GET['vt']; ?></div></span>
    </div>
    <div class="form-group d-flex justify-content-center">
      <button class="btn btn-primary" type="submit" name="Confirmara">Confirmar la Compra</button>
    </div>
  </form>
</div>


<?php
include_once '../estructura/footer_home.php';
?>
