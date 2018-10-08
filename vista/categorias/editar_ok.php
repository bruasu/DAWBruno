<?php
include_once '../../modelo/Categorias.class.php';
$conectar=new Categorias();

if (isset($_POST['Enviar-modificar'])) {
	$conectar->id_categoria=filter_input(INPUT_POST,'id_categoria');
	$conectar->nome=filter_input(INPUT_POST,'nome');
	$conectar->editar();
	header('location: addcategorias.php?modificadoExitosamente');
}else{
	header('location: addcategorias.php?errorAlModificar');
}


?>