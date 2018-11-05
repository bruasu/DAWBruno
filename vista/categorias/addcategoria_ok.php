<?php
	include_once '../../modelo/Categorias.class.php';
	//var_dump($_POST);
	$conectar=new Categorias();

	$nombre=filter_input(INPUT_POST,'nombre');


	if($nombre){
		if (!empty(trim($nombre))){			
			$conectar->nome=$nombre;
			if ($conectar->adicionar()) {
				header("Location: addcategorias.php?agregado=ok");
			}else{
				echo "Error al Agregar";
			}
		}else{
			header("Location: addcategorias.php?error=nome");
		}

	}else{		
			header("Location: addcategorias.php?error=nome");		
		
	}





?>