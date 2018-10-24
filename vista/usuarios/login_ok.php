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
  $_SESSION['user']['admin']=true;
  header('location:../ventas/listar_ventas.php');
}else{
  header('location:login.php?error');
}


?>
