<?php
  include_once '../estructura/header_home.php';
  include_once '../estructura/nav_header.php';
  include_once '../../modelo/Ventas.class.php';
  $ventas=new Ventas();
  $ventas->id_usuario=$_SESSION['user']['id_usuario'];
  $result=$ventas->get_ventas_user();

  if ($result>0) {
  $listar='';

    function estado($valor){
      if ($valor==0) {
        return '<strong>Pendiente</strong>';
      }else {
        return 'Realizada';
      }
    }

    for ($i=0; $i <count($result) ; $i++) {
      $listar.="
        <tr>
          <td>".$result[$i]->id_ventas."</td>
          <td>".date('d/m/Y',$result[$i]->fecha_compra)."</td>
          <td>".$result[$i]->valor_total."</td>
          <td>".estado($result[$i]->status)."</td>
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
      <th>ID Venta</th>
      <th>Fecha</th>
      <th>Valor Total</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $listar; ?>
  </tbody>
</table>


<?php
include_once '../estructura/footer_home.php';
?>
