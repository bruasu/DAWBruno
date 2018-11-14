<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
  <div class="container">

    <!-- Brand -->
    <a class="navbar-brand waves-effect" href="home-page.php">
      <strong class="blue-text">ShopFree</strong>
    </a>

    <!-- Collapse -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- Left -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link waves-effect" href="../contenido/home-page.php">Inicio
            <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>

      <!-- Right -->
      <ul class="navbar-nav nav-flex-icons">
        <li class="nav-item">
          <?php if (isset($_SESSION['user'])) {
            echo "<span class='btn-outline-info btn-sm nav-link mr-2'>".$_SESSION['user']['nombre']."</span>";
          } ?>
        </li>
        <li class="nav-item">
          <a class="nav-link waves-effect" href="carro.php">
            <span class="badge red z-depth-1 mr-1">
              <?php
                if (isset($_SESSION['carro_add'])) {
                  echo count($_SESSION['carro_add']);
                }else {
                  echo "0";
                }
              ?>
             </span>
            <i class="fa fa-shopping-cart"></i>
            <span class="clearfix d-none d-sm-inline-block"> Carro </span>
          </a>
        </li>
        <li>
          <?php if (isset($_SESSION['user'])) { ?>
          <a href="../../vista/usuarios/cerrar_session.php" class="btn btn-danger btn-sm">Cerrar</a>
        <?php }else {
          ?>
          <a href="../../vista/usuarios/login.php" class="btn btn-primary btn-sm">Iniciar Sesion</a>
          <?php
        } ?>
        <?php if (isset($_SESSION['user'])) {
          if ($_SESSION['user']['tipo']=='admin') {
            ?>
            <a href="../../vista/inicio/admin.php" class="btn btn-outline-info btn-sm">Area Administrativa</a>
            <?php
          }
        } ?>
        </li>
      </ul>
    </div>

  </div>
</nav>
<!-- Navbar -->
