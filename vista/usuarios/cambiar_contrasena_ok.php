<?php
	include_once '../../modelo/Usuarios.class.php';	
	include_once '../../modelo/funciones_ayuda.php';
	//var_dump($_POST);
	$conectar=new Usuarios();
	$errores=[];


if(isset($_POST['Enviar'])){

	$contrasena=filtrarPost('contrasena');
	$re_contrasena=filtrarPost('re_contrasena');
	$id_usuario=$_GET['id_usuario'];

	if ($contrasena==$re_contrasena) {
		$conectar->id_usuario=$id_usuario;
		$conectar->contrasena=$contrasena;
		$respuesta=$conectar->cambiar_contrasena();
	}

	if ($respuesta) {
		header('location:editar_usuario.php?id='.$id_usuario.'&contrasena=CambiadoExito');
	}
}