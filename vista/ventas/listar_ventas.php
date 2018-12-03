<?php include_once '../estructura/header.php';

include_once '../../modelo/Ventas.class.php';
$conectar=new Ventas();

if (isset($_POST['Enviar'])) {
	$nombrebusqueda=filter_input(INPUT_POST,'Buscar');
	$ventas=$conectar->listar('where id_ventas="'.$nombrebusqueda.'" or usuarios.nombre like "%'.$nombrebusqueda.'%" or direccion_entrega like "%'.$nombrebusqueda.'%"');
}else {
	$ventas=$conectar->listar();
}
$lista='';
//var_dump($productos);

function status($status){
	if ($status) {
		return "Concluida";
	}else {
		return "<strong>Pendiente</strong>";
	}
}

foreach ($ventas as $key => $valor) {
		$lista.="<tr><td>$valor->id_ventas</td>
				<td>$valor->usuario</td>
				<td>$valor->valor_total</td>
				<td>$valor->fecha_compra</td>
				<td>$valor->direccion_entrega</td>
				<td>".status($valor->status)."</td>
				<td><a href='editar_venta.php?id=$valor->id_ventas'>Editar</a></td>
				<td><a href='eliminar_venta.php?id=$valor->id_ventas'>Eliminar</a></td>
				<td><a href='modificar_status.php?status=$valor->status&id=$valor->id_ventas'>Modificar Status</a></td>
				</tr>";
			}
?>
<form class="m-2" action="" method="post">
 <input type="search" placeholder="Buscar Producto" name="Buscar">
 <input type="submit" name="Enviar" value="Buscar">
</form>
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
