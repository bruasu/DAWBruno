<?php

class Producto_Venta{
	private $id_productos;
	private $id_ventas;
	private $cantidad;
	private $valor_producto;

  private $conexion; //conexion con el banco de datos
	private $tabela;	//para saber cual son las tabelas de la classe

	public function __construct(){
		$this->conexion= mysqli_connect('localhost','root','','shopfree')or die('NO CONECTO AL BD');
    $this->tabela="productos_ventas";
	}
    public function __destruct(){
    	unset($this->conexion);
    }
    public function __get($key){
    	return $this->$key;
    }
    public function __set($key,$value){
    	$this->$key=$value;
    }
    public function add_Venta(){
      $sql="INSERT INTO $this->tabela(id_productos,id_ventas,cantidad,valor_producto) VALUES
      ('$this->id_productos','$this->id_ventas','$this->cantidad','$this->valor_producto')";
      //echo $sql;
      $resultado= mysqli_query($this->conexion,$sql);
      return $resultado;
    }



}
?>
