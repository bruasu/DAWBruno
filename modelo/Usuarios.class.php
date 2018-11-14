<?php
class Usuarios{
	private $id_usuario;
	private $nombre;
    private $apellido;
    private $contrasena;
    private $email;
    private $fecha_nacimiento;
    private $telefono=0;
    private $celular=0;
    private $status='activo';
    private $tipo='user';
	private $conexion; //conexion con el banco de datos
	private $tabela;	//para saber cual son las tabelas de la classe

        public function __construct() {
            $this->conexion= mysqli_connect('localhost','root','','shopfree')or die('NO CONECTO AL BD');
            $this->tabela="usuarios";
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
        	$sql="INSERT INTO $this->tabela(nombre,apellido,contrasena,email,fecha_nacimiento,telefono,celular,status,tipo) VALUES ('$this->nombre','$this->apellido','$this->contrasena','$this->email','$this->fecha_nacimiento','$this->telefono','$this->celular','$this->status','$this->tipo')";
            $resultado= mysqli_query($this->conexion,$sql);
        	return $resultado;
        }
        public function listar($complemento=""){
            $sql="SELECT * FROM $this->tabela ".$complemento;
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            while($res = mysqli_fetch_assoc($resultado)){
                $obj=new Usuarios();
                $obj->id_usuario=$res['id_usuario'];
                $obj->nombre=$res['nombre'];
                $obj->apellido=$res['apellido'];
                $obj->email=$res['email'];
                $obj->fecha_nacimiento=$res['fecha_nacimiento'];
                $obj->telefono=$res['telefono'];
                $obj->celular=$res['celular'];
                $obj->status=$res['status'];
                $obj->tipo=$res['tipo'];

                $retorno[]=$obj;
            }
            return $retorno;
        }
        public function borrar(){
            $sql="DELETE FROM $this->tabela WHERE id_usuario = $this->id_usuario";
            $resultado=mysqli_query($this->conexion,$sql);
            return $resultado;
        }
        public function retornarunico(){
            $sql="SELECT * FROM $this->tabela WHERE id_usuario = $this->id_usuario";
            //echo $sql;
            $resultado= mysqli_query($this->conexion,$sql);
            $retorno=null;
            if ($res=mysqli_fetch_assoc($resultado)) {
                $obj=new Usuarios();
                $obj->id_usuario=$res['id_usuario'];
                $obj->nombre=$res['nombre'];
                $obj->apellido=$res['apellido'];
                $obj->email=$res['email'];
                $obj->fecha_nacimiento=$res['fecha_nacimiento'];
                $obj->telefono=$res['telefono'];
                $obj->celular=$res['celular'];
                $obj->status=$res['status'];
                $obj->tipo=$res['tipo'];
                $retorno=$obj;
            }else{
                $retorno=null;
            }
            return $retorno;
        }

        public function editar(){
            $sql="UPDATE $this->tabela SET nombre='$this->nombre', apellido='$this->apellido', email='$this->email', fecha_nacimiento='$this->fecha_nacimiento' WHERE id_usuario= $this->id_usuario";
            $resultado=mysqli_query($this->conexion, $sql);
            return $resultado;
        }
        public function cambiar_contrasena(){
            $sql="UPDATE $this->tabela SET contrasena='$this->contrasena' WHERE id_usuario= $this->id_usuario";
            $resultado=mysqli_query($this->conexion, $sql);
            return $resultado;
        }
				public function login(){
					$sql="SELECT * FROM $this->tabela where email='$this->email' and contrasena='$this->contrasena'";
					echo $sql;
					$resultado= mysqli_query($this->conexion,$sql);
					$retorno=null;
					if ($res=mysqli_fetch_assoc($resultado)) {
							$obj=new Usuarios();
							$obj->id_usuario=$res['id_usuario'];
							$obj->nombre=$res['nombre'];
							$obj->apellido=$res['apellido'];
							$obj->email=$res['email'];
							$obj->fecha_nacimiento=$res['fecha_nacimiento'];
							$obj->telefono=$res['telefono'];
							$obj->celular=$res['celular'];
							$obj->status=$res['status'];
							$obj->tipo=$res['tipo'];
							$retorno=$obj;
					}else{
							$retorno=null;
					}
					return $retorno;
				}
}

?>
