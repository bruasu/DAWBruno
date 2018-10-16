<?php
	include_once '../../modelo/Categorias.class.php';	
	$conectar=new Categorias();

	if (isset($_GET['id'])||$_GET['id']=='') {
		$conectar->id_categoria=$_GET['id'];
		$conectar->borrar();
		header("Location: addcategorias.php");
	}else{
		header("Location: addcategorias.php");
	}

?>