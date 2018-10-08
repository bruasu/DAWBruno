<?php
class Categorias{
	private $id_categoria;
	private $nome;
	private $conexion; //conexion con el banco de datos
	private $tabela;	//para saber cual son las tabelas de la classe

        public function __construct() {            
            $this->conexion= mysqli_connect('localhost','root','','shopfree')or die('NO CONECTO AL BD');
            $this->tabela="categorias";            
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
        	$sql="INSERT INTO $this->tabela(nome) VALUES ('$this->nome')";  
            $resultado= mysqli_query($this->conexion,$sql);
        	return $resultado;
        }
        public function listar($complemento=""){
            $sql="SELECT * FROM $this->tabela ".$complemento;
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            while($res = mysqli_fetch_assoc($resultado)){
                $obj=new Categorias();
                $obj->id_categoria=$res['id_categoria'];
                $obj->nome=$res['nome'];

                $retorno[]=$obj;
            }
            return $retorno;            
        }
        public function borrar(){
            $sql="DELETE FROM $this->tabela WHERE id_categoria = $this->id_categoria";
            $resultado=mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function retornarunico(){
            $sql="SELECT * FROM $this->tabela WHERE id_categoria = $this->id_categoria";
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            if ($res=mysqli_fetch_assoc($resultado)) {             
                $obj=new Categorias();
                $obj->id_categoria=$res['id_categoria'];
                $obj->nome=$res['nome'];
                $retorno=$obj;                      
            }else{
                $retorno=null;
            }
            return $retorno;   
        }
        public function editar(){
            $sql="UPDATE $this->tabela SET nome= '$this->nome' WHERE id_categoria= $this->id_categoria";
            $resultado=mysqli_query($this->conexion, $sql);
            return $resultado;
        }

}

?>