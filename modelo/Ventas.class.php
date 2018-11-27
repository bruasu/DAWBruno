<?php

class Ventas{
	private $id_ventas;
	private $id_usuario;
	private $valor_total;
	private $fecha_compra;
	private $direccion_entrega;
	private $status;

	private $usuario;

	public function __construct(){
		$this->conexion= mysqli_connect('localhost','root','','shopfree')or die('NO CONECTO AL BD');
        $this->tabela="ventas";
		$this->status=0;
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

    public function listar($complemento=""){
            $sql="SELECT ventas.*, usuarios.nombre as usuario FROM $this->tabela INNER JOIN usuarios ON $this->tabela.id_usuario=usuarios.id_usuario ".$complemento;
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            while($res = mysqli_fetch_assoc($resultado)){
                $obj=new Ventas();
                $obj->id_usuario=$res['id_usuario'];
                $obj->id_ventas=$res['id_ventas'];
                $obj->valor_total=$res['valor_total'];
                $obj->fecha_compra=$res['fecha_compra'];
                $obj->direccion_entrega=$res['direccion_entrega'];
                $obj->status=$res['status'];
                $obj->usuario=$res['usuario'];

                $retorno[]=$obj;
            }
            return $retorno;
    }
		public function modificar_status(){
			$sql="UPDATE $this->tabela SET status='$this->status' WHERE id_ventas=$this->id_ventas";
			//var_dump($sql);
			$resultado=mysqli_query($this->conexion, $sql);
			return $resultado;
		}
		public function add_venta(){
				$sql="INSERT INTO $this->tabela(id_ventas,id_usuario,valor_total,fecha_compra,direccion_entrega,status) VALUES
				('$this->id_ventas','$this->id_usuario','$this->valor_total','$this->fecha_compra','$this->direccion_entrega','$this->status')";
				$resultado= mysqli_query($this->conexion,$sql);
				return $resultado;
		}
		public function get_ventas_user(){
			$sql="SELECT * FROM $this->tabela where id_usuario=$this->id_usuario";
			$resultado= mysqli_query($this->conexion,$sql);
			$retorno=null;
			while($res = mysqli_fetch_assoc($resultado)){
					$obj=new Ventas();
					$obj->id_usuario=$res['id_usuario'];
					$obj->id_ventas=$res['id_ventas'];
					$obj->valor_total=$res['valor_total'];
					$obj->fecha_compra=$res['fecha_compra'];
					$obj->direccion_entrega=$res['direccion_entrega'];
					$obj->status=$res['status'];

					$retorno[]=$obj;
			}
			return $retorno;
		}


}
?>
