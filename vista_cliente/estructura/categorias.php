<?php
  include_once '../../modelo/Categorias.class.php';
  $conectar=new Categorias();
  $categorias=$conectar->listar();
 ?>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

  <!-- Navbar brand -->
  <span class="navbar-brand">Categorias:</span>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse" id="basicExampleNav">

    <!-- Links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="listar_productos.php">Todas
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <?php
        foreach ($categorias as $key => $value) {
          echo "<li class='nav-item'>
            <a class='nav-link' href='#'>$value->nome</a>
          </li>";
        }
      ?>
    </ul>
    <!-- Links -->
    <form class="form-inline">
      <div class="md-form my-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
      </div>
    </form>
  </div>
  <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
