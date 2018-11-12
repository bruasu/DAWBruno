<?php
  include_once '../estructura/header_home.php';
  include_once '../estructura/nav_header.php';

  include_once '../../modelo/Productos.class.php';
  $conectar=new Productos();
  $conectar->id_producto=$_GET['id'];
  $producto=$conectar->retornarunico();

  if (isset($_POST['add'])) {
    $add=0;
    if (isset($_SESSION['carro_add'])){
      $datos=$_SESSION['carro_add'];
      for ($i=0; $i <count($datos) ; $i++) {
        if ($_GET['id']==$datos[$i]['id']) {
          $add=1;
        }
      }
    }
    if ($add==0) {
        if (isset($_SESSION['carro_add'])){
          $cantidad=count($_SESSION['carro_add']);
          $_SESSION['carro_add'][$cantidad]['id']=$_GET['id'];
          $_SESSION['carro_add'][$cantidad]['cantidad']=$_POST['cantidad'];
        }else {
          $_SESSION['carro_add'][0]['id']=$_GET['id'];
          $_SESSION['carro_add'][0]['cantidad']=$_POST['cantidad'];
        }
      }
  }
 ?>
 <!--Main layout-->
 <main class="mt-5 pt-4">
   <div class="container dark-grey-text mt-5">

     <!--Grid row-->
     <div class="row wow fadeIn">

       <!--Grid column-->
       <div class="col-md-6 mb-4">

         <img src="../../vista/img/Productos/<?php echo $producto->foto; ?>" class="img-fluid" alt="">

       </div>
       <!--Grid column-->

       <!--Grid column-->
       <div class="col-md-6 mb-4">

         <!--Content-->
         <div class="p-4">

           <p class="lead">
             <span class="mr-1">
               <del>$ <?php echo $producto->precio_venta*1.30; ?></del>
             </span>
             <span>- $ <?php echo $producto->precio_venta; ?></span>
           </p>

           <p class="lead font-weight-bold">Descripción</p>

           <p><?php echo $producto->descripcion; ?></p>

           <form class="d-flex justify-content-left" method="post" action="">
             <!-- Default input -->
             <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px" name="cantidad">
             <button class="btn btn-primary btn-md my-0 p" type="submit" name='add' >Añadir al Carro
               <i class="fa fa-shopping-cart ml-1"></i>
             </button>

           </form>

         </div>
         <!--Content-->

       </div>
       <!--Grid column-->

     </div>
     <!--Grid row-->

     <hr>

 <?php
 include_once '../estructura/footer_home.php';
  ?>
