<?php

function filtrarPost($valor){
	$resultado=filter_input(INPUT_POST,$valor);
	if (!empty(trim($resultado))){			
		return $resultado;
	}else{
		$resultado='Error en el Campo :'.$valor;
		return $resultado;
	}
}

?>