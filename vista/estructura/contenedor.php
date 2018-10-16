
	<div class="nav-contenedor">
		<div class="btn"><p><a href="#addcategorias" rel="modal:open">Agregar</a></p></div>
		<div class="btn"><p><a href="">Editar</a></p></div>
	</div>

	<?php	
	if(isset($_GET['id'])){
		if ($_GET['id']=='categorias') {
			include_once 'categorias/addcategorias.php';
		}
	}
	?>
		
