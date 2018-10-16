<?php
	include_once '../../modelo/Productos.class.php';	
	$conectar=new Productos();

	if (isset($_GET['id'])||$_GET['id']=='') {
		$conectar->id_producto=$_GET['id'];
		$conectar->borrar();
		header("Location: lista_productos.php?exito");
	}else{
		header("Location: lista_productos.php");
	}



?>