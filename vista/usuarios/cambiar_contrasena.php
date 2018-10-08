<?php include_once '../estructura/header.php';?>


<div class="d-flex justify-content-center mt-3 ">
	<form action="cambiar_contrasena_ok.php?id_usuario=<?php echo $_GET['id_usuario']?>" class="card col-12 col-md-8 " method="post" id="formRegistro">		
	  	<div class="form-group">
		    <label class="mt-2" for="pwd">Nueva Contraseña:</label>
		    <input type="password" class="form-control" id="pwd" name="contrasena" required>
	 	 </div>
	 	   	<div class="form-group">
		    <label for="re-pwd">Repita la contraseña:</label>
		    <input type="password" class="form-control" id="re-pwd" name="re_contrasena" required>
	 	 </div>  	
	 	 <button type="submit" class="btn btn-primary" name="Enviar">Enviar</button>
	</form>
</div>
<div class="col-12">	
	<a href="editar_usuario.php?id=<?php echo $_GET['id_usuario']?>" class="btn btn-primary">Volver</a>
</div>


<?php include_once '../estructura/pie_de_pagina.php';?>