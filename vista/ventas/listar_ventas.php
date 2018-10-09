<?php include_once '../estructura/header.php';

include_once '../../modelo/Ventas.class.php';
$conectar=new Ventas();
$ventas=$conectar->listar();
$lista='';
//var_dump($productos);

foreach ($ventas as $key => $valor) {		
		$lista.="<tr><td>$valor->id_ventas</td>
				<td>$valor->usuario</td>
				<td>$valor->valor_total</td>
				<td>$valor->fecha_compra</td>
				<td>$valor->direccion_entrega</td>
				<td>$valor->status</td>
				<td><a href='editar_venta.php?id=$valor->id_ventas'>Editar</a></td>
				<td><a href='eliminar_venta.php?id=$valor->id_ventas'>Eliminar</a></td>
				<td><a href='modificar_status.php?id=$valor->status'>Modificar Status</a></td>
				</tr>";
			}
?>
<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Valor Total</th>
        <th>Fecha de Compra</th>
        <th>Domicilio</th>
        <th>status</th>
        <th colspan='2'>Acciones</th>
      </tr>
    </thead>
    <tbody>      
        <?php echo $lista?>         
    </tbody>
  </table>

<?php include_once '../estructura/pie_de_pagina.php';?>