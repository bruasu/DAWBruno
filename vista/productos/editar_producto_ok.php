<?php

	include_once '../../modelo/Productos.class.php';	
	include_once '../../modelo/funciones_ayuda.php';
	//var_dump($_POST);
	$conectar=new Productos();

	if(isset($_POST['Enviar'])){

	$id_producto=filtrarPost('id_producto');
	$nombre=filtrarPost('nombre');
	$descripcion=filtrarPost('descripcion');
	$P_Compra=filtrarPost('P_Compra');
	$P_Venta=filtrarPost('P_Venta');
	$P_promocional=filtrarPost('P_promocional');
	$cantidad=filtrarPost('cantidad');
	$id_categoria=filtrarPost('categoria');

	$conectar->id_producto=$id_producto;
	$conectar->nombre=$nombre;
	$conectar->descripcion=$descripcion;
	$conectar->precio_compra=(float)$P_Compra;
	$conectar->precio_venta=(float)$P_Venta;
	$conectar->precio_promocional=(float)$P_promocional;
	$conectar->cantidad=$cantidad;
	$conectar->id_categoria=$id_categoria;
	$resultado=$conectar->editar();


	if ($resultado) {
		header("location:lista_productos.php?ExitoEditar");
	}else{
		header("location:lista_productos.php?ErrorEditar");
	}

	}
	
?>