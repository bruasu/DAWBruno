<?php
	include_once '../../modelo/Usuarios.class.php';	
	$conectar=new Usuarios();

	if (isset($_GET['id'])||$_GET['id']=='') {
		$conectar->id_usuario=$_GET['id'];
		$conectar->borrar();
		header("Location: add_usuario.php");
	}else{
		header("Location: add_usuario.php");
	}

?>