<?php include_once '../estructura/header.php';
include_once 'menu_productos.php';
include_once '../../modelo/Productos.class.php';
$conectar=new Productos();
$productos=$conectar->listar();
$lista='';
//var_dump($productos);

foreach ($productos as $key => $valor) {		
		$lista.="<tr><td>$valor->id_producto</td>
				<td>$valor->nombre</td>
				<td><img src='../img/Productos/$valor->foto' style='height:50px'></td>
				<td>$valor->precio_compra</td>
				<td>$valor->precio_venta</td>
				<td>$valor->precio_promocional</td>
				<td>$valor->cantidad</td>
				<td>$valor->status</td>
				<td>$valor->nombre_categoria</td>
				<td><a href='editar_producto.php?id=$valor->id_producto'>Editar</a></td>
				<td><a href='editar_foto.php?foto=$valor->foto&id=$valor->id_producto'>Editar Foto</a></td>
				<td><a href='eliminar_producto.php?id=$valor->id_producto'>Eliminar</a></td>
				</tr>";
			}
?>

<table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>nombre</th>
        <th>foto</th>
        <th>precio compra</th>
        <th>precio venta</th>
        <th>precio promocional</th>
        <th>cantidad</th>
        <th>status</th>
        <th>Categoria</th>
        <th colspan='3'>Acciones</th>
      </tr>
    </thead>
    <tbody>      
        <?php echo $lista?>         
    </tbody>
  </table>


<?php include_once '../estructura/pie_de_pagina.php';?>