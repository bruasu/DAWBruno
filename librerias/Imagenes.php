<?php
//Ejemplo de uso
//Al instanciar la clase nos pide 4 variables
//1- la variable $_FILES que contienen las imagenes va directamento no necesitamos procesar nada la clase hace todo por nosotros
//2- El nombre que queramos que tenga nuestra imagen o enviamos un string 'default', y la clase pontra un nombre, NOTA: la clase pondra mas nombres concatenado con el que enviamos para que no aigan imagenes repitidas
//3- Pondremos la direcion de la carpeta donde queramos que su guarden las imagenes
//4- la calidad de imagen que va de 0 a 100, NOTA: NO ES OBLIGATORIO PONER ESTE PARAMETRO, si no agregamos nada el tomara como defaut la calidad maxima que es 100

#$conectar=new Imagenes($imagen,$nuevo_nombre_imagen,$carpeta_destino,$calidad);

#$conectar->coordenadasDestino($x,$y); !No es obligatorio
#$conectar->coordenadasOrigen($x,$y); !No es obligatorio

#$conectar->ancho($ancho); !No es obligatorio
#$conectar->alto($alto); !No es obligatorio

#$conectar->error(); !No es obligatorio - nos retorna los posibles error que tengamos
#$conectar->nombres(); !No es obligatorio - nos retorna un array con los nombre que tendran las imagen, usarlo despues de ejecutar para poder traer los nombres con la extencion

//para Almacenar nuestras imagenes llamamos la funcion ejecutar()
#$conectar->ejecutar();

//Funciones Extras por si queremos guardar en mas de una carpeta, o con diferente nombre
//IMPORTANTE:Estas funciones se ultilizan por lo general despues de haber ejecutado y hallan almacenado nuestras imagenes, cambiamos uno de estos parametros y ejecutamos nuevamente

#$conectar->modificarCarpetaDestino($carpeta_destino) !No es obligatorio
#$conectar->modificarNombreImagen($nuevoNombre) !No es obligatorio
#$conectar->modificarCalidadImagen($nuevaCalidad) !No es obligatorio

class Imagenes{
	private $imagen=null;//almaceneremos todas las imagenes
	private $nombreUnicoImagen=null;//nombre que nos envian
	private $nombreImagenes=[];
	private $nombreImagenesExtencion=[];
	private $cantidad=null;//almacenaremos la cantidad de imagenes
	private $carpeta_destino=null;//contendra la carpeta de Destino
	private $time=null; //almacenaremos el Time cuando se instancia la clase

	//parametros para todas imagenes Igual
	private $ancho=null;
	private $alto=null;
	private $x_punto_destino=null;
	private $y_punto_destino=null;
	private $x_punto_origen=null;
	private $y_punto_origen=null;
	//es la calidad que tentra la copia de nuestra imagen
	private $calidadImagen=null;

	public function __construct($imagen,$nuevo_nombre_imagen,$carpeta_destino,$calidad=100){
		$this->imagen=$imagen;
		$this->nombreUnicoImagen=$nuevo_nombre_imagen;
		$this->carpeta_destino=$carpeta_destino;
		$this->cantidad=count($imagen['name']);
		$this->calidadImagen=$calidad;
		$this->time=time();
		//producimos un array con los nombres que tendran las imagenes
		$this->ponerNombre();
	}
	//ponemos nombre unicos para cada Imagen
	protected function ponerNombre(){
		$time=$this->time;
			if ($this->nombreUnicoImagen=='default') {
				for ($i=0; $i <$this->cantidad ; $i++) { 
				$this->nombreImagenes[$i]=$time.'-to_'.($i+1).'_and_'.$this->cantidad;
				}
			}else{
				for ($i=0; $i <$this->cantidad ; $i++) { 
					$this->nombreImagenes[$i]=$this->nombreUnicoImagen.'-'.$time.'-to_'.($i+1).'_and_'.$this->cantidad;
				}
			}
	}
	//Esta funcion es para desirle en que pocicion queremos que la imagen se empieze a copiar en nuestro lienzo
	public function coordenadasDestino($x,$y){
		$this->x_punto_destino=$x;
		$this->y_punto_destino=$y;
	}
	//Esta funcion es para decirle desde que pocicion queremos que empezar a copiar de la imagen original
	public function coordenadasOrigen($x,$y){
		$this->x_punto_origen=$x;
		$this->y_punto_origen=$y;
	}
	//Recibimos el ancho que quieramos que tenga nuestra imagen que sera para todo el array de imagen igual
	public function ancho($ancho){
		if ($ancho>0) {
			$this->ancho=$ancho;
		}
	}
	//Recibimos el alto que quieramos que tenga nuestra imagen que sera para todo el array de imagen igual
	public function alto($alto){
		if ($alto>0) {
			$this->alto=$alto;
		}
	}
	public function ejecutar(){
		$ancho_ok=null;
		$alto_ok=null;
		$verificacion=null;//en esta variable sabremos que funcion iremos a ejecutar al final, si es solamente guardar imagen o vamos a redimencionar		
		
		for ($i=0; $i < $this->cantidad ; $i++) { 
			//separamos las imagenes
			$imagenIndividual=[];
			$imagenIndividual['name'][0]=$this->imagen['name'][$i];
			$imagenIndividual['type'][0]=$this->imagen['type'][$i];
			$imagenIndividual['tmp_name'][0]=$this->imagen['tmp_name'][$i];
			$imagenIndividual['error'][0]=$this->imagen['error'][$i];
			$imagenIndividual['size'][0]=$this->imagen['size'][$i];
			
			
			//instanciamos una classe para poder hacer el proceso
			$conectar=new Imagen($imagenIndividual,$this->nombreImagenes[$i],$this->carpeta_destino);

			//ponemos extencion en el nombre de las imagenes para poder usar en la funcion nombre()
			$this->nombreImagenesExtencion[$i]=$conectar->agregarExtencionImagen($this->nombreImagenes[$i],$this->imagen['type'][$i]);

			//comprobamos si tenemos medidas ancho y alto
			if ($this->ancho&&$this->ancho>0) {				
				$ancho_ok=$this->ancho;							
			}
			if ($this->alto&&$this->alto>0) {				
				$alto_ok=$this->alto;								
			}
			if ($ancho_ok&&$alto_ok) {
				$conectar->medidasFijas($alto_ok,$ancho_ok);
				$verificacion=true;
			}else if($ancho_ok){
				$conectar->anchoFijo($ancho_ok);
				$verificacion=true;
			}else if($alto_ok){
				$conectar->altoFijo($alto_ok);
				$verificacion=true;
			}
			//comprobamos si ingresaron coordenadas
			if ($this->x_punto_destino&&$this->y_punto_destino) {
				$conectar->coordenadasDestino($this->x_punto_destino,$this->y_punto_destino);
				$verificacion=true;
			}else if($this->x_punto_origen&&$this->y_punto_origen){
				$conectar->coordenadasOrigen($this->x_punto_origen,$this->y_punto_origen);
				$verificacion=true;
			}
			//comprobamos que los valores de calidad de imagen este en su rango
			if ($this->calidadImagen<100&&$this->calidadImagen>=0) {
				$conectar->calidadImagen($this->calidadImagen);
				$verificacion=true;
			}
			//verificamos cual funcion vamos a iniciar
			if ($verificacion) {
				$conectar->ejecutarRedimension();
			}else{
				$conectar->ejecutar();
			}

		}
		/*
		echo '<pre>';
		var_dump($this->nombreImagenes);
		echo '<pre>';
		*/
	}

	/*************************** FUNCIONES DE AYUDA ********************************/

	//Tenemos la posiblidad de cambiar la direcion de la carpeda de destino despues de haber instanciado la classe
	public function modificarCarpetaDestino($carpeta_destino){
		$this->carpeta_destino=$carpeta_destino;
	}
	//Tenemos la posibilidad de modificar el nombre de la imagen despues de haber instanciado
	//NOTA: la extencion en el Nombre que pone la clase sera la misma desde cuando se hizo la instancia
	public function modificarNombreImagen($nuevoNombre){
		$this->nombreUnicoImagen=$nuevoNombre;	
		$this->ponerNombre();
	}
	//Tenemos la posibilidad de modificar la calidad de la imagen
	public function modificarCalidadImagen($nuevaCalidad){
		if ($nuevaCalidad>=0&&$nuevaCalidad<100) {
			$this->calidadImagen=$nuevaCalidad;
		}
	}
	public function error(){		
		return $this->error;
	}
	public function nombres(){
		return $this->nombreImagenesExtencion;
	}
}

//esta Class es solamente usada por la classe Imagenes que esta arriba, es la que hace el proceso para almacenar las imagenes
class Imagen{	
	private $nuevo_nombre_imagen=null; //nuevo nombre que tentra la imagen ya con su extencion agregada
	private $tipo_imagen_original=null; //tipo de la imagen 
	private $tamano_imagen_original=null;
	private $carpeta_temporal=null; //carpeta temporal donde se encuentra la imagen	
	private $carpeta_donde_esta_imagen=null;//si se ejecuta primero la funcion de mover de la carpeta temporal aqui queda el destino donde fue guarda la imagen
	private $carpeta_destino=null;//Ruta carpeta donde almacenaremos la imagen
	private $error=null; //error que pueda tener la imagen
	private $imagen=null;//alamcenamos la imagen que recibimos en esta variable
	public $erroreEncontrados=[];//errores capturados
	
	//copia de Imagen Original en Memoria y Imagen Redimencionada
	private $imagenParaRedimencion=null;//pondremos la imagen en su formato para poder hacer una Redimencion en el lienzo
	private $lienzoNuevaImagen=null;//tendremos el lienzo para una imagen redimencionada
	
	//medidas Imagen Origen y Destino
	private $ancho_imagen_original=null;//almacenamos el ancho de la imagen original
	private $alto_imagen_original=null;//almacenamos el alto de la imagen original
	private $alto_imagen_copia=null;//sera el alto que tendra la COPIA de la imagen
	private $ancho_imagen_copia=null;//sera el ancho que tentra la COPIA de la imagen

	//cordenadas para Redimension
	private $x_punto_destino=null;
	private $y_punto_destino=null;
	private $x_punto_origen=null;
	private $y_punto_origen=null;
	//es la calidad que tentra la copia de nuestra imagen
	private $calidadImagen=null;	


	public function __construct($imagen,$nuevo_nombre_imagen,$carpeta_destino){		
		$this->imagen=$imagen;
		$this->carpeta_temporal=$imagen['tmp_name'][0]; 
		$this->tipo_imagen_original=$imagen['type'][0]; 
		$this->tamano_imagen_original=$imagen['size'][0]; //tamaño de la imagen
		$this->error=$imagen['error'][0]; 
		$this->carpeta_destino=$carpeta_destino; 
		//agregamos la extencion a la imagen
			if ($nuevo_nombre_imagen=='defaut') {
				$nombreTime=time();
				$this->nuevo_nombre_imagen=$this->agregarExtencionImagen($nombreTime,$this->tipo_imagen_original);
			}else{
				$this->nuevo_nombre_imagen=$this->agregarExtencionImagen($nuevo_nombre_imagen,$this->tipo_imagen_original);
			}
		//si no existe la carpeta de Destino la Creamos
		$this->verificarCarpetaDestino($this->carpeta_destino);
		//iniciamos el tamaño de la imagen copia con los mismos valores que el original
		//abrimos la imagen desde la carpeta temporal hacia la memoria
		$this->abrimosImagenParaRedimensionar();
		$this->medidasDefaut();
		//inicializamos las coordenadas por Defaut que es 0 en todas las pociciones
		$this->coordenadasDefaut();
		//inicializamos la calidad por Defecto
		$this->calidadImagenDefaut();
	}
	//funcion para agregar la extencion al nombre que tentra la imagen
	public function agregarExtencionImagen($nombreImagen,$tipo_imagen){
		$nuevoNombreImagen=$nombreImagen;
		if ($tipo_imagen=='image/jpeg') {
			$nuevoNombreImagen.='.jpg';
		}else if($tipo_imagen=='image/gif'){
			$nuevoNombreImagen.='.gif';
		}else if($tipo_imagen=='image/png'){
			$nuevoNombreImagen.='.png';
		}else if($tipo_imagen=='image/jpg'){
			$nuevoNombreImagen.='.jpg';
		}else if($tipo_imagen=='image/wbmp'){
			$nuevoNombreImagen.='.bmp';
		}else{
			$this->erroreEncontrados[]= "Tipo de imagen Invalido";
		}
		return $nuevoNombreImagen;
	}
	//funcion para crear la carpeta de destino si no existe
	protected function verificarCarpetaDestino($carpeta_destino){
		if(!file_exists($carpeta_destino)){
			mkdir($carpeta_destino, 0777) or die($this->erroreEncontrados[]="No se puede crear el directorio de destino");
			chmod($carpeta_destino, 0777);	//habilita todos los permisos de la carpeta
		}
	}
	//funcion final para almacenar la imagen en la carpecta de Destino
	//Esta funcion es solamente si no se va Redimencionar
	public function ejecutar(){
		move_uploaded_file($this->carpeta_temporal,$this->carpeta_destino.$this->nuevo_nombre_imagen);
		chmod($this->carpeta_destino.$this->nuevo_nombre_imagen, 0777);
		echo $this->carpeta_temporal;
		echo "<br>";
		$this->carpeta_donde_esta_imagen=$this->carpeta_destino.$this->nuevo_nombre_imagen;
		echo $this->carpeta_donde_esta_imagen;
	}	

	/**************************** REDIMENSIONAR ************************************/

	protected function Redimensionar(){
		//creamos el lienzo de de nuestra imagen copia con sus correspondientes medidas
		$this->creamosLienzo($this->ancho_imagen_copia,$this->alto_imagen_copia);
		//pasamos la Imagen Original a la Copia que aremos con sus medidas
		imagecopyresampled($this->lienzoNuevaImagen, $this->imagenParaRedimencion, $this->x_punto_destino, $this->y_punto_destino, $this->x_punto_origen, $this->y_punto_origen, $this->ancho_imagen_copia, $this->alto_imagen_copia, $this->ancho_imagen_original, $this->alto_imagen_original);

	}
	public function ejecutarRedimension(){
		//ejecutamos la funcion Redimencionar para hacer nuestra copia
		$this->Redimensionar();

		if ($this->tipo_imagen_original=='image/jpeg') {
			imagejpeg($this->lienzoNuevaImagen,$this->carpeta_destino.$this->nuevo_nombre_imagen,$this->calidadImagen);
		}else if($this->tipo_imagen_original=='image/gif'){
			imagegif($this->lienzoNuevaImagen,$this->carpeta_destino.$this->nuevo_nombre_imagen,$this->calidadImagen);
		}else if($this->tipo_imagen_original=='image/png'){
			imagepng($this->lienzoNuevaImagen,$this->carpeta_destino.$this->nuevo_nombre_imagen,$this->calidadImagen);
		}else if($this->tipo_imagen_original=='image/wbmp'){
			imagewbmp($this->lienzoNuevaImagen,$this->carpeta_destino.$this->nuevo_nombre_imagen,$this->calidadImagen);
		}else{
			$this->erroreEncontrados[]= "Problemas para Ejecutar la Redimension";
		}
	}		

	/****************************************************************************/

	//Estas 4 funciones son para eligir como seran las medidas que nuestra Imagen
	//IMPORTANTE: solo devemos usar 1 de ellas para nuestra Renderizacion, si el objetivo es Desminuir el tamaño de la imagen, sino se inicia la funcion por Defaut tomando en cuenta el tamaño Original de la imagen

	//si queremos que nuestra Imagen tenga un alto fijo usamos esta funcion, ella automaticamente calcula el Ancho para que no pierda las proporciones
	public function altoFijo($alto_Imagen){
		$this->alto_imagen_copia=$alto_Imagen;
		$this->ancho_imagen_copia=(int)round($alto_Imagen*$this->ancho_imagen_original/$this->alto_imagen_original);
	}
	//funcion para poder tener un ancho fijo y el alto no pierda las proporciones
	public function anchoFijo($ancho_Imagen){		
		$this->ancho_imagen_copia=$ancho_Imagen;		
		$this->alto_imagen_copia=(int)round($ancho_Imagen*$this->alto_imagen_original/$this->ancho_imagen_original);
	}
	//funcion para dejar unas medidas fijas, IMPORTANTE: puede perder proporcion la imagen
	public function medidasFijas($alto,$ancho){
		$this->ancho_imagen_copia=$ancho;
		$this->alto_imagen_copia=$alto;
	}
	//ponemos por Defaut a la imagen copia el tamaño Original
	public function medidasDefaut(){
		$this->ancho_imagen_copia=$this->ancho_imagen_original;
		$this->alto_imagen_copia=$this->alto_imagen_original;
	}

	/****************************** COORDENADAS *********************************/
	//Estas 3 funciones son para definer las coordenadas que tentra la copia de nuestra imagen, tambien para saber de que parte de la imagen original queremos copiar
	//IMPORTANTE: Si no inicializamos una de las funciones se inicializa la que esta por Defaut

	public function coordenadasDefaut(){
		$this->x_punto_destino=0;
		$this->y_punto_destino=0;
		$this->x_punto_origen=0;
		$this->y_punto_origen=0;
	}
	//Esta funcion es para desirle en que pocicion queremos que la imagen se empieze a copiar en nuestro lienzo
	public function coordenadasDestino($x,$y){
		$this->x_punto_destino=$x;
		$this->y_punto_destino=$y;
	}
	//Esta funcion es para decirle desde que pocicion queremos que empezar a copiar de la imagen original
	public function coordenadasOrigen($x,$y){
		$this->x_punto_origen=$x;
		$this->y_punto_origen=$y;
	}

	/************************** CALIDAD IMAGEN COPIA ****************************/
	// si no definimos una calidad que quieramos se inicia por Defaut en calidad maxima
	protected function calidadImagenDefaut(){
		$this->calidadImagen=100;
	}
	//podremos eligir una valor de calidad que van de 0 a 100, si ponemos un numero en otro rango por defecto quedara con el maximo 100
	public function calidadImagen($valor){
		if ($valor>=0&&$valor<=100) {
			$this->calidadImagen=$valor;
		}else{
			$this->calidadImagen=100;
		}
	}

	/****************************************************************************/

	protected function abrimosImagenParaRedimensionar(){
		
		if ($this->tipo_imagen_original=='image/jpeg') {
			$this->imagenParaRedimencion=imagecreatefromjpeg($this->carpeta_temporal);
		}else if($this->tipo_imagen_original=='image/gif'){
			$this->imagenParaRedimencion=imagecreatefromgif($this->carpeta_temporal);
		}else if($this->tipo_imagen_original=='image/png'){
			$this->imagenParaRedimencion=imagecreatefrompng($this->carpeta_temporal);
		}else if($this->tipo_imagen_original=='image/wbmp'){
			$this->imagenParaRedimencion=imagecreatefromwbmp($this->carpeta_temporal);
		}else{
			$this->erroreEncontrados[]="Imagen para ser Redimensionada con Extencion no Aceptada";
		}

		$this->ancho_imagen_original= imagesx($this->imagenParaRedimencion);
		$this->alto_imagen_original= imagesy($this->imagenParaRedimencion);
	}
	//creamos el lienzo de la imagen que vamos a Redimencionar con sus correspondientes medidas
	protected function creamosLienzo($ancho,$alto){
		$this->lienzoNuevaImagen=imagecreatetruecolor($ancho,$alto);
	}
}

//CLASS Imagen
//INSTRUCIONES PARA EL PROGRAMADOR DE COMO FUNCIONA LA CLASSE
//Primero Debemos Instanciar la Classe Imagenes
//$conectar=new Imagenes($imagen,$nuevo_nombre_imagen,$carpeta_destino)
# la instancia recibe 3 parametros
# 1- Enviamos la imagen que recibimos por $_FILES
# 2- Enviamos el nombre que quieramos que tenga la imagen o podemos enviar un string que diga 'defaut' y pondra por defecto un numero que es el Time()
# 3- Enviamos la carpeta donde queremos que se almacene nuestra imagen en el Servidor

//Si solamente queremos almacenar la imagen
//$conectar->ejecutar();

//si queremos Redimensionar la Imagen

//La calidad de Imagen recibe valor de 0 a 100
//si no la inicializamos pondra por defecto calidad maxima que es 100
//$conectar->calidadImagen($valor); !No es obligatorio

//las cordenadas tenemos 2 funciones Origen y Destino
//si no las inicializamos pondra por defecto valor 0
//Origen - es la pocicion de donde queremos que inicie la copia de la imagen
//Destino - es la pocicion de donde queresmo que comienze a gravar la imagen que esta siendo copiada, ej: si ponemos una pocicion $x=10,$y=10, la copia dejara un padding de 10 pixeles en cada una de sus pociciones iniciales

//$conectar->coordenadasDefaut(); !No es obligatorio - se inicia al instanciar pero se puede usar mas veces
//$conectar->coordenadasDestino($x,$y); !No es obligatorio
//$conectar->coordenadasOrigen($x,$y); !No es obligatorio

//Tamaño que quieramos que tenga nuestra imagen de Destino o la copia
//IMPORTANTE: los valores son Pixeles pero solo ponemos el numero sin la extencion px
//IMPORTANTE: si no inicializamos ninguna de estas funciones el tamaño que tomara por referencia sera del Original
//altoFijo - es cuando queremos que nuestra imagen tenga un alto que nosotros lo difinamos, y la funcion automaticamente calcula el ancho para que sea proporcional a la imagen y no se desforme
//anchoFijo - similar al alto fijo solo que ahora es el ancho
//medidasFijas - con esta funcion difinimos el alto y el ancho que quieramos que tenga nuestra imagen, IMPORTANTE: con esta funcion si la medida no son proporcional las que le damos se desformara la imagen.

//$conectar->altoFijo($alto_Imagen); !No es obligatorio
//$conectar->anchoFijo($ancho_Imagen); !No es obligatorio
//$conectar->medidasFijas($alto,$ancho); !No es obligatorio
//$conectar->medidasDefaut(); !No es obligatorio - se inicia automaticamente al intanciar, pero se puede utilizar nuevamente para poner los tamanos por Defaut

//ejecutamos la redimension
//$conectar->ejecutarRedimension();

/**************************************************************/
//Solamente subir la imagen
//$conectar=new Imagenes($imagen,$nuevo_nombre_imagen,$carpeta_destino);
//$conectar->ejecutar();

//Redimensionar la Imagen

//$conectar=new Imagenes($imagen,$nuevo_nombre_imagen,$carpeta_destino);

//$conectar->calidadImagen($valor); !No es obligatorio
//$conectar->coordenadasDefaut(); !No es obligatorio - se inicia al instanciar pero se puede usar mas veces
//$conectar->coordenadasDestino($x,$y); !No es obligatorio
//$conectar->coordenadasOrigen($x,$y); !No es obligatorio

//Solamente podemos eligir una de estas 4 funciones abajo
//$conectar->altoFijo($alto_Imagen); !No es obligatorio
//$conectar->anchoFijo($ancho_Imagen); !No es obligatorio
//$conectar->medidasFijas($alto,$ancho); !No es obligatorio
//$conectar->medidasDefaut(); !No es obligatorio - se inicia al instanciar pero se puede usar mas veces

//$conectar->ejecutarRedimension();

?>