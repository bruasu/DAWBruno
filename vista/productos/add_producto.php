<?php include_once '../estructura/header.php';
	include_once 'menu_productos.php';
	//include_once '../../modelo/Productos.class.php';
	include_once '../../modelo/Categorias.class.php';
	//$conectar=new Productos();
	$categoria=new Categorias();

	$categorias=$categoria->listar();
	$listaCategorias=null;
	foreach ($categorias as $valor) {
				$listaCategorias.="<option value='$valor->id_categoria'>$valor->nome</option>";
			}
?>
<div class="d-flex justify-content-center mt-3">
	<form action="producto_ok.php" class="card col-12 col-md-8" method="post" enctype="multipart/form-data">
		<div class="form-group mt-2">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" required>
	  	</div>
	  	<div class="form-group">
		    <label for="descripcion">Descripcion</label>
		    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
	  	</div>
	  	<div class="form-group">
		    <label for="foto">Foto:</label>
		    <input type="file" class="form-control" id="foto" name="foto" required>
	  	</div>
		<div class="form-group">
		    <label for="P_Compra">Precio de Compra:</label>
		    <input type="text" class="form-control" id="P_Compra" name="P_Compra" required>
	  	</div>
	  	<div class="form-group">
		    <label for="P_Venta">Precio de Venta:</label>
		    <input type="text" class="form-control" id="P_Venta" name="P_Venta" required>
	 	 </div>
	 	   	<div class="form-group">
		    <label for="P_promocional">Precio Promocional:</label>
		    <input type="text" class="form-control" id="P_promocional" name="P_promocional">
	 	 </div>
	 	 <div class="form-group">
		    <label for="cantidad">Cantidad:</label>
		    <input type="number" class="form-control" id="cantidad" name="cantidad">
	 	 </div>
	 	 <div class='form-grup'>
			<label for='categorias' >Categoria:</label>
            <select name="categoria" class='form-control'><?php echo $listaCategorias; ?></select>
		</div>
	 	 <button type="submit" class="btn btn-primary" name="Enviar">Enviar</button>
	</form>
</div>

<?php include_once '../estructura/pie_de_pagina.php';?>
