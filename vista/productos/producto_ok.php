<?php

	include_once '../../modelo/Productos.class.php';
	include_once '../../modelo/funciones_ayuda.php';
	include_once '../../librerias/Imagenes.php';
	//var_dump($_POST);
	$conectar=new Productos();
	$errores=[];


if(isset($_POST['Enviar'])){

	$nombre=filtrarPost('nombre');
	$descripcion=filtrarPost('descripcion');
	$P_Compra=filtrarPost('P_Compra');
	$P_Venta=filtrarPost('P_Venta');
	$P_promocional=filtrarPost('P_promocional');
	$cantidad=filtrarPost('cantidad');
	$id_categoria=filtrarPost('categoria');
	$imagen=$_FILES['foto'];

	$nuevoNombreImagen=$nombre.time();
	$tipo_imagen=$_FILES['foto']['type'];
	// verificamo que tipo de imagen es y le agregamos la extencion a la imagen
	if ($tipo_imagen=='image/jpeg') {
		$nuevoNombreImagen.='.jpg';
	}else if($tipo_imagen=='image/gif'){
		$nuevoNombreImagen.='.gif';
	}else if($tipo_imagen=='image/png'){
		$nuevoNombreImagen.='.png';
	}else if($tipo_imagen=='image/jpg'){
		$nuevoNombreImagen.='.jpg';
	}else{
		echo "Tipo de imagen Invalido";
	}

	$carpeta_destino=$_SERVER['DOCUMENT_ROOT']."/DAWBruno/vista/img/Productos/"; //Ruta de la carpeta de destino del Servidor

	//Verificamos que la ruta de destino exita, si no exite la creamos
	if(!file_exists($carpeta_destino)){
					mkdir($carpeta_destino, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
					chmod($carpeta_destino,0777);	
	}
	//movemos la imagen del directorio temporar al directorio escogido
	move_uploaded_file($_FILES['foto']['tmp_name'],$carpeta_destino.$nuevoNombreImagen);
	chmod($carpeta_destino.$nuevoNombreImagen,0777);


	$conectar->nombre=$nombre;
	$conectar->descripcion=$descripcion;
	$conectar->precio_compra=(float)$P_Compra;
	$conectar->precio_venta=(float)$P_Venta;
	$conectar->precio_promocional=(float)$P_promocional;
	$conectar->cantidad=$cantidad;
	$conectar->id_categoria=$id_categoria;
	$conectar->foto=$nuevoNombreImagen; 
	$resultado=$conectar->adicionar();
	
	header('location:add_producto.php?exitoAgregar');
}

	


?>