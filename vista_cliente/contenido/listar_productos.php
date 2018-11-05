<?php
  include_once '../estructura/header_home.php';
  include_once '../estructura/nav_header.php';
 ?>
<main>
  <div class="container">

<div style="margin-top:75px">
  <?php
  include_once '../estructura/categorias.php';
  ?>
</div>

    <!--Section: Products v.3-->
    <section class="text-center mb-4">

      <!--Grid row-->
      <div class="row wow fadeIn">

          <?php
          include_once 'productos.php';
          ?>

      </div>
      <!--Grid row-->

    </section>
    <!--Section: Products v.3-->
  </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

<?php
include_once '../estructura/footer_home.php';

?>
