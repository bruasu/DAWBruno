
	<?php include_once '../estructura/header.php';
				include_once '../../modelo/Ventas.class.php';
				$Ventas=new Ventas();
				$ventas=$Ventas->listar('where ventas.status=0');
				$lista='';
				//var_dump($productos);

				foreach ($ventas as $key => $valor) {
						$lista.="<tr><td>$valor->id_ventas</td>
								<td>$valor->usuario</td>
								<td>$valor->valor_total</td>
								<td>".date('d/m/Y',$valor->fecha_compra)."</td>
								<td>$valor->direccion_entrega</td>
								<td><a href='modificar_status.php?status=$valor->status&id=$valor->id_ventas'>Modificar Status</a></td>
								</tr>";
							}
	?>
<h1>Pedidos de Compra Pendiente</h1>
	<table class="table">
	    <thead>
	      <tr>
	        <th>ID</th>
	        <th>Usuario</th>
	        <th>Valor Total</th>
	        <th>Fecha de Compra</th>
	        <th>Domicilio</th>
	        <th >Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	        <?php echo $lista?>
	    </tbody>
	  </table>



	<?php include_once '../estructura/pie_de_pagina.php';?>
