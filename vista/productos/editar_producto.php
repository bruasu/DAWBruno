<?php include_once '../estructura/header.php';
	include_once '../../modelo/Productos.class.php';
	include_once 'menu_productos.php';
	$conectar=new Productos();
	$conectar->id_producto=$_GET['id'];
	$productos=$conectar->retornarunico();

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
	<form action="editar_producto_ok.php" class="card col-12 col-md-8" method="post" enctype="multipart/form-data">
		<div class="form-group mt-2">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" value="<?php echo $productos->nombre?>" id="nombre" name="nombre" required>	    
		    <input type="hidden" name="id_producto" value="<?php echo $productos->id_producto?>">
	  	</div>
	  	<div class="form-group">
		    <label for="descripcion">Descripcion:</label>
		    <input value="<?php echo $productos->descripcion ?>" type="text" class="form-control" id="descripcion" name="descripcion" required>
	  	</div>
		<div class="form-group">
		    <label for="P_Compra">Precio de Compra:</label>
		    <input value="<?php echo $productos->precio_compra ?>" type="text" class="form-control" id="P_Compra" name="P_Compra" required>
	  	</div>
	  	<div class="form-group">
		    <label for="P_Venta">Precio de Venta:</label>
		    <input value="<?php echo $productos->precio_venta ?>" type="text" class="form-control" id="P_Venta" name="P_Venta" required>
	 	 </div>
	 	   	<div class="form-group">
		    <label for="P_promocional">Precio Promocional:</label>
		    <input value="<?php echo $productos->precio_promocional ?>" type="text" class="form-control" id="P_promocional" name="P_promocional">
	 	 </div>	 	
	 	 <div class="form-group">
		    <label for="cantidad">Cantidad:</label>
		    <input value="<?php echo $productos->cantidad ?>" type="number" class="form-control" id="cantidad" name="cantidad">
	 	 </div>
	 	 <div class='form-grup'>
			<label for='categorias' >Categoria:</label>                
            <select name="categoria" class='form-control'>
            	<option value="<?php echo $productos->id_categoria ?>"><?php echo $productos->nombre_categoria ?></option>
            	<?php echo $listaCategorias; ?>
            		
            	</select>                  
		</div>	  	
	 	 <button type="submit" class="btn btn-primary" name="Enviar">Enviar</button>
	</form>
</div>



<?php include_once '../estructura/pie_de_pagina.php';?>