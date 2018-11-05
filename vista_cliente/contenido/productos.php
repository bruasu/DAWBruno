<?php
include_once '../../modelo/Productos.class.php';
$conectar=new Productos();

if (isset($_GET['categoria'])) {
	$nombrebusqueda=filter_input(INPUT_GET,'categoria');
	$productos=$conectar->listar('where categorias.nome like "%'.$nombrebusqueda.'%"');
}elseif(isset($_GET['Home'])) {
	$productos=$conectar->listar(' limit 8');
}
elseif (isset($_GET['buscar'])) {
	$nombrebusqueda=$_GET['buscar'];
	$productos=$conectar->listar('where productos.nombre like "%'.$nombrebusqueda.'%"');
}
else {
	$productos=$conectar->listar();
}
$lista='';
if (count($productos)>0) {
	foreach ($productos as $key => $valor) {
		$lista.="<div class='col-lg-3 col-md-6 mb-4'>
		<div class='card'>
		<div class='view overlay'>
		<img src='../../vista/img/Productos/$valor->foto' class='card-img-top'>
		<a>
		<div class='mask rgba-white-slight'></div>
		</a>
		</div>
		<div class='card-body text-center'>
		<h5>
		<strong>
		<a href='' class='dark-grey-text'>$valor->nombre</a>
		</strong>
		</h5>
		<h4 class='font-weight-bold blue-text'>
		<strong>$valor->precio_venta $</strong>
		</h4>
		</div>
		</div>
		</div>";
	}
	}else{
		$lista ="<h5 class='ml-3'>No ahi productos Disponibles en esta Categoria</h5>";
	}

			echo $lista;
?>
