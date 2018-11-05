<?php include_once '../estructura/header.php';
	include_once '../../modelo/Categorias.class.php';
	$conectar=new Categorias();
?>

<form action="addcategoria_ok.php" method="post">
	<tr>
			<td><span>Agregar Categorias</span></td>
			<td><input type="text" name="nombre" placeholder="Nombre">
		<?php
			if (isset($_GET['error'])) {
				echo '<span style="color:red">Error al agregar una Clase</span>';
			}
			if(isset($_GET['agregado'])){
				echo '<span style="color:green">Agregado con suceso</span>';
			}
			if (isset($_GET['errorAlModificar'])) {
				echo '<span style="color:red">Error al Modificar</span>';
			}
			if(isset($_GET['modificadoExitosamente'])){
				echo '<span style="color:green">Modificado con suceso</span>';
			}
		?>
</td>
			<td><input type="submit" value="Agregar" class="btn" name="Enviar"></td>
	</tr>	
</form>

<form action="addcategorias.php" method="get">
	<label for="buscar">Buscar:</label>
	<input type="text" name="nombrebusqueda" id="buscar" placeholder="Busqueda">
	<button type="submit" name="EnviarBusqueda">Buscar</button>
</form>

<h2>Listado de categorias</h2>

<?php
	if (isset($_GET['EnviarBusqueda'])) {
		$nombrebusqueda=filter_input(INPUT_GET,'nombrebusqueda');
		$rsl = $conectar->listar('where id_categoria="'.$nombrebusqueda.'" or nome like "%'.$nombrebusqueda.'%"');		
	}else{
		$rsl = $conectar->listar();	
	}
	if($rsl==''){
		echo "<tr><td colspan='4'>Su Busqueda no retorno ningun Resultado</td></tr>";
	}else{
		echo "<table border style='margin:10px'><thead>
		<tr><th style='padding:5px'>ID</th>
		<th style='padding:5px'>Nombre</th>
		<th colspan='2' style='padding:5px'>Acciones</th></tr></thead>";
	foreach ($rsl  as $resul) {
		echo "<tr><td style='padding:5px'>".$resul->id_categoria."</td>
			<td style='padding:5px'>".$resul->nome."</td>
			<td><a href='editar.php?id_categoria=$resul->id_categoria' style='padding:5px'>Editar</a></td>
			<td><a href='borrar_categoria.php?id=".$resul->id_categoria."' style='padding:5px'>Eliminar</a></td></tr>";
		}
	}
?>
	
</table>
<?php include_once '../estructura/pie_de_pagina.php';?>