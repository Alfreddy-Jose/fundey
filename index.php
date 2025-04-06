<?php
  session_start();
  session_destroy();
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="./app/views/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Favicon -->
  <link href="./app/views/img/FUNDEY.png" rel="icon">

  <!-- Estilos CSS  -->
  <link rel="stylesheet" href="./app/views/css/style.css">

  <!-- Titulo -->
  <title>FUNDEY</title>

</head>

<body>

  <!-- Content Start -->
  <div class="barra">
    <!-- Navbar Start -->
    <nav class="navbar d-flex justify-content-end navbar-expand navbar-dark px-4 py-0">
      <a href="./app/views/login.php" class="iniciar">
        <button class="btn btn-danger my-2">Iniciar Sesión</button>
      </a>
      <a href="./app/controllers/manualesController.php?manual=usuario" target="_blank" class="btn btn-danger mx-2">
          Manual de Usuario
      </a>
    </nav>
  </div>
  
  <!-- Navbar End -->

  <h1 class="titulo">FUNDEY</h1>
  <h4 class="text-center">INSTITUTO AUTÓNOMO DEL DEPORTE DEL ESTADO YARACUY</h4>

  <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="4" aria-label="Slide 5"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="5" aria-label="Slide 6"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="6" aria-label="Slide 7"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="7" aria-label="Slide 8"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="8" aria-label="Slide 9"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="9" aria-label="Slide 10"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="10" aria-label="Slide 11"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="11" aria-label="Slide 12"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./app/views/img/ft0.jpg" class="d-block w-100" alt="juegos nacionales oriente 2024">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft4.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft5.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft6.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft7.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft8.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft9.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft10.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./app/views/img/ft11.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container padre d-flex">
    <div class="caj">
      <h5>MISIÓN</h5>
      <b>
        Garantizar el fomento y desarrollo de la Actividad Deportiva,
        con bases técnicas, presupuestarias y científicas que nos permitan,
        a través de los programas lograr los objetivos trazados.
      </b>

    </div>
    <div class="caj">
      <h5>VISIÓN</h5>
      <b>
        Lograr con nuestras fortalezas programáticas el modelo
        deportivo por excelencia a nivel Nacional.
      </b>
    </div>
    <div class="caj">
      <h5>VALORES</h5>
      <b>Liderazgo.</b>
      <b>Humanidad.</b>
      <b>Transparencia.</b>
      <b>Responsabilidad.</b>
    </div>
  </div>
  <div class="container frase">
    <h2>"El deporte es la mejor manera de descansar el cuerpo cuando la mente está cansada".</h2>
  </div>

  <!-- Footer Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="rounded-top footer p-4">
      <div class="row">
        <div class="col-12 col-sm-6 text-center text-sm-start">
          &copy; <span class="footer__letras">UPTYAB JAIMES/VARGAS</span>
        </div>
        <div class="col-12 col-sm-6 text-center text-sm-end">
          <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
          Diseñado por <span class="footer__letras">JAIMES/VARGAS</span>
          <br>Distribuido por: <span class="footer__letras">UPTYAB</span>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End -->
  <?php 
  if (!empty($_POST['manual'])) {
    echo'<meta http-equiv="refresh" content="0; url=./app/views/login.php">';
  }
  ?>
  <!-- Javascript -->
  <script src="./app/views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>