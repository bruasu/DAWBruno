<?php
session_start();
include_once '../../modelo/Usuarios.class.php';
include_once '../../modelo/funciones_ayuda.php';
//var_dump($_POST);
$conectar=new Usuarios();
$conectar->email=filtrarPost('email');
$conectar->contrasena=filtrarPost('contrasena');

$resultado_login=$conectar->login();

if ($resultado_login) {
  $_SESSION['user']['tipo']=$resultado_login->tipo;
  $_SESSION['user']['nombre']=$resultado_login->nombre;
  $_SESSION['user']['id_usuario']=$resultado_login->id_usuario;
  if ($_SESSION['user']['tipo']=='admin') {
    header('location:../inicio/admin.php');
  }else {
    header('location:login.php');
  }
}else{
  header('location:login.php?error');
}

?>
