<?php
	include_once '../../modelo/Usuarios.class.php';	
	include_once '../../modelo/funciones_ayuda.php';
	//var_dump($_POST);
	$conectar=new Usuarios();
	$errores=[];


if(isset($_POST['Enviar'])){

	$nombre=filtrarPost('nombre');
	$apellido=filtrarPost('apellido');
	$fecha_nacimiento=filtrarPost('fecha_nacimiento');
	$email=filtrarPost('email');
	$id_usuario=filtrarPost('id_usuario');

	$conectar->id_usuario=$id_usuario;
	$conectar->nombre=$nombre;
	$conectar->apellido=$apellido;
	$conectar->fecha_nacimiento=$fecha_nacimiento;
	$conectar->email=$email;

	$respuesta=$conectar->editar();

	if ($respuesta) {
		header('location:add_usuario.php?ModificadoExito');
	}
}