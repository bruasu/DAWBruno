<?php include_once '../estructura/header.php';
	include_once '../../modelo/Usuarios.class.php';
	if (isset($_GET['id'])) {
			$id_usuario=$_GET['id'];
			$conectar=new Usuarios();
			$conectar->id_usuario=$id_usuario;
			$resultado=$conectar->retornarunico();
		}
?>
<div class="d-flex justify-content-center mt-3 ">
	<form action="editar_usuario_ok.php" class="card col-12 col-md-8 " method="post">
		<h2 class="align-self-center">Modificar Usuario</h2>
		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $resultado->nombre;?>" required>
		    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
	  	</div>
	  	<div class="form-group">
		    <label for="apellido">Apellido:</label>
		    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $resultado->apellido;?>" required>
	  	</div>
	  	<div class="form-group">
		    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
		    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $resultado->fecha_nacimiento;?>" required>
	  	</div>
		<div class="form-group">
		    <label for="email">Email:</label>
		    <input type="email" class="form-control" id="email" name="email" value="<?php echo $resultado->email;?>" required>
	  	</div>
	  	 <a href="cambiar_contrasena.php?id_usuario=<?php echo $id_usuario?>" class="btn btn-primary">Cambiar Contraseña</a>
	 	 <button type="submit" class="btn btn-primary" name="Enviar">Enviar</button>
	</form>
</div>
<div class="col-12">	
	<a href="add_usuario.php" class="btn btn-primary">Volver</a>
</div>

<?php include_once '../estructura/pie_de_pagina.php';?>