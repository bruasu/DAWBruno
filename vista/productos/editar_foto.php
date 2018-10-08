<?php include_once '../estructura/header.php';
	include_once 'menu_productos.php';
	$carpeta_destino="../img/Productos/";

?>
<div class="d-flex justify-content-center mt-3">
	<form action="editar_foto_ok.php?id=<?php echo $_GET['id']?>&foto=<?php echo $_GET['foto']?>" class="card col-12 col-md-8" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="mt-2">Foto Actual:</label>
			<img src="<?php echo $carpeta_destino.$_GET['foto']?>" style="height:80px" class="m-2 d-block">
		</div>
		 <div class="form-group">
		    <label for="foto">Adicionar Foto Nueva:</label>
		    <input type="file" class="form-control" id="foto" name="foto" required>
	  	</div>
	 	 <button type="submit" class="btn btn-primary" name="Enviar">Enviar</button>
	</form>
</div>



<?php include_once '../estructura/pie_de_pagina.php';?>