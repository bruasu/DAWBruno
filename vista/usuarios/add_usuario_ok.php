<?php
	include_once '../../modelo/Usuarios.class.php';
	//var_dump($_POST);
	$conectar=new Usuarios();
	$errores=[];


if(isset($_POST['Enviar'])){

	$nombre=filter_input(INPUT_POST,'nombre');
	$apellido=filter_input(INPUT_POST,'apellido');
	$fecha_nacimiento=filter_input(INPUT_POST,'fecha_nacimiento');
	$email=filter_input(INPUT_POST,'email');
	$contrasena=filter_input(INPUT_POST,'contrasena');
	$re_contrasena=filter_input(INPUT_POST,'re_contrasena');

	if (!empty(trim($nombre))){			
		$conectar->nome=$nombre;
	}else{
		$errores[]='Error en el Campo Nombre, No puede estar Vacio';
	}
	if (!empty(trim($apellido))){
		$conectar->apellido=$apellido;
	}else{
		$errores[]='Error en el Campo Apellido, No puede estar Vacio';
	}
	if (!empty(trim($fecha_nacimiento))) {
		$conectar->fecha_nacimiento=$fecha_nacimiento;
	}else{
		$errores[]='Error en el Campo Fecha de Nacimiento, No puede estar vacio';
	}
	if (!empty(trim($email))) {
		$conectar->email=$email;
	}else{
		$errores[]='Error en el Campo Email, No puede estar vacio';
	}

	if (!empty(trim($contrasena))&&!empty(trim($re_contrasena))) {
		if ($contrasena==$re_contrasena) {
			$conectar->contrasena=$contrasena;
		}else{
			$errores[]='Las contraseñas no Coinciden';
		}
	}else{
		$errores[]='El campo Contraseña no puede estar vacio';
	}
	
	//almacenamos los datos del usuario en el banco de datos
	$conectar->adicionar();
	
	header('location:add_usuario.php?exitoAgregar');
}
/*
var_dump($_POST['Enviar']);	
echo "<br>";
var_dump($errores);
*/




?>