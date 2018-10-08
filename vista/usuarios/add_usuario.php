<?php include_once '../estructura/header.php';
	include_once '../../modelo/Usuarios.class.php';
	$conectar=new Usuarios();
	$resultado=$conectar->listar();
	$listaUsuarios=null;
	foreach ($resultado as $valor) {
				$listaUsuarios.="<tr>
				<td>$valor->id_usuario</td>
				<td>$valor->nombre</td>
				<td>$valor->apellido</td>
				<td>$valor->email</td>
				<td>$valor->fecha_nacimiento</td>
				<td>$valor->telefono</td>
				<td>$valor->celular</td>
				<td>$valor->status</td>
				<td>$valor->tipo</td>
				<td><a href='editar_usuario.php?id=$valor->id_usuario'>Editar</a></td>
				<td><a href='eliminar_usuario.php?id=$valor->id_usuario'>Eliminar</a></td>
				</tr>
				";
			}
?>
<div class="col-12">	
	 <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#formRegistro">Agregar Usuario</button>
</div>
<div class="d-flex justify-content-center mt-3 ">
	<form action="add_usuario_ok.php" class="card col-12 col-md-8 collapse mb-2" method="post" id="formRegistro">
		<div class="form-group">
		    <label for="nombre">Nombre:</label>
		    <input type="text" class="form-control" id="nombre" name="nombre" required>
	  	</div>
	  	<div class="form-group">
		    <label for="apellido">Apellido:</label>
		    <input type="text" class="form-control" id="apellido" name="apellido" required>
	  	</div>
	  	<div class="form-group">
		    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
		    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
	  	</div>
		<div class="form-group">
		    <label for="email">Email:</label>
		    <input type="email" class="form-control" id="email" name="email" required>
	  	</div>
	  	<div class="form-group">
		    <label for="pwd">Contraseña:</label>
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
	<table class="table">
		<thead>
	      <tr>
	        <th>ID</th>
	        <th>Nombre</th>
	        <th>Apellido</th>
	        <th>E-mail</th>
	        <th>Fecha Nacimiento</th>
	        <th>Telefono</th>
	        <th>Celular</th>
	        <th>Status</th>
	        <th>Tipo</th>
	        <th colspan="2">Acciones</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php echo $listaUsuarios;?>
	    </tbody>

	</table>
</div>

<?php include_once '../estructura/pie_de_pagina.php';?>