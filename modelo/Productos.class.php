<?php
class Productos{
	private $id_producto;
    private $nombre;
	private $descripcion;
	private $foto;
	private $precio_compra;
	private $precio_venta;
	private $precio_promocional;
	private $cantidad=0;
	private $status=true;
	private $id_categoria;
    private $nombre_categoria;

	private $conexion;
	private $tabela;

        public function __construct() {            
            $this->conexion= mysqli_connect('localhost','root','','shopfree')or die('NO CONECTO AL BD');
            $this->tabela="productos";            
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
        public function adicionar(){
        	$sql="INSERT INTO $this->tabela(nombre,descripcion,foto,precio_compra,precio_venta,precio_promocional,cantidad,status,id_categoria) VALUES ('$this->nombre','$this->descripcion','$this->foto','$this->precio_compra','$this->precio_venta','$this->precio_promocional','$this->cantidad','$this->status','$this->id_categoria')";  
            $resultado= mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function editar(){
            $sql="UPDATE $this->tabela SET nombre='$this->nombre', descripcion='$this->descripcion', precio_compra='$this->precio_compra', precio_venta='$this->precio_venta', precio_promocional='$this->precio_promocional', cantidad='$this->cantidad', id_categoria='$this->id_categoria' WHERE id_producto=$this->id_producto";  
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function subirNombrefoto(){
            $sql="UPDATE $this->tabela SET foto='$this->foto' WHERE id_producto=$this->id_producto";
            $resultado= mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function listar($complemento=""){
            $sql="SELECT $this->tabela.*,categorias.nome as nombre_categoria FROM $this->tabela inner join categorias on $this->tabela.id_categoria=categorias.id_categoria".$complemento;
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            while($res = mysqli_fetch_assoc($resultado)){
                $obj=new Productos();
                $obj->id_producto=$res['id_producto'];
                $obj->nombre=$res['nombre'];
                $obj->descripcion=$res['descripcion'];
                $obj->foto=$res['foto'];
                $obj->precio_compra=$res['precio_compra'];
                $obj->precio_venta=$res['precio_venta'];
                $obj->precio_promocional=$res['precio_promocional'];
                $obj->cantidad=$res['cantidad'];
                $obj->status=$res['status'];
                $obj->id_categoria=$res['id_categoria'];
                $obj->nombre_categoria=$res['nombre_categoria'];

                $retorno[]=$obj;
            }
            return $retorno;            
        }
        public function borrar(){
            $sql="DELETE FROM $this->tabela WHERE id_producto = $this->id_producto";
            $resultado=mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function retornarunico(){
            $sql="SELECT $this->tabela.*,categorias.nome as nombre_categoria FROM $this->tabela inner join categorias on $this->tabela.id_categoria=categorias.id_categoria WHERE id_producto = $this->id_producto";
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            if ($res=mysqli_fetch_assoc($resultado)) {             
                $obj=new Productos();
                $obj->id_producto=$res['id_producto'];
                $obj->nombre=$res['nombre'];
                $obj->descripcion=$res['descripcion'];
                $obj->foto=$res['foto'];
                $obj->precio_compra=$res['precio_compra'];
                $obj->precio_venta=$res['precio_venta'];
                $obj->precio_promocional=$res['precio_promocional'];
                $obj->cantidad=$res['cantidad'];
                $obj->status=$res['status'];
                $obj->id_categoria=$res['id_categoria'];
                $obj->nombre_categoria=$res['nombre_categoria'];
                $retorno=$obj;                        
            }else{
                $retorno=null;
            }
            return $retorno;   
        }




}


?>