<?php

	include_once '../../modelo/Productos.class.php';	
	include_once '../../modelo/funciones_ayuda.php';
	//var_dump($_POST);
	$conectar=new Productos();

	if(isset($_POST['Enviar'])){		

		$carpeta_destino="../img/Productos/";

		$nuevoNombreImagen=time();
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
		//Verificamos que la ruta de destino exita, si no exite la creamos
		if(!file_exists($carpeta_destino)){
						mkdir($carpeta_destino, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
						chmod($carpeta_destino,0777);	
		}

		$direccionEliminar=$_SERVER['DOCUMENT_ROOT'].'/DAWBruno/vista/img/Productos/';
		
		//movemos la imagen del directorio temporar al directorio escogido
		move_uploaded_file($_FILES['foto']['tmp_name'],$carpeta_destino.$nuevoNombreImagen);
		chmod($direccionEliminar.$nuevoNombreImagen,0777);
		$conectar->id_producto=$_GET['id']; 
		$conectar->foto=$nuevoNombreImagen; 
		$resultado=$conectar->subirNombrefoto();
		unlink($direccionEliminar.$_GET['foto']);
	}
	header('location:lista_productos.php');