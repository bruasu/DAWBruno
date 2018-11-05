<?php include_once '../estructura/header.php';
	include_once '../../modelo/Categorias.class.php';
	$conectar=new Categorias();
	$nombrebusqueda=(int)filter_input(INPUT_GET,'id_categoria');
	$conectar->id_categoria=$nombrebusqueda;
	$listaDeCategoria=$conectar->retornarunico();
?>
<form action="editar_ok.php" method="post">
	<tr>
		<td><span>Modificar Categorias</span></td>
		<input type="text" name="id_categoria" value="<?php echo $listaDeCategoria->id_categoria;?>" style="display:none;">
		<td><input type="text" name="nome" value="<?php echo $listaDeCategoria->nome;?>" >
		<?php
			if (isset($_GET['error'])) {
				echo '<span style="color:red">Error al modificar la Categoria</span>';
			}
			if(isset($_GET['agregado'])){
				echo '<span style="color:green">Modificado con suceso</span>';
			}
		?>
		</td>
			<td><input type="submit" value="Agregar" class="btn" name="Enviar-modificar"></td>
	</tr>	
</form>
<a href="addcategorias.php" class="btn btn-primary">Volver</a>



<?php include_once '../estructura/pie_de_pagina.php';?>