<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Essai</title>
  <link rel="stylesheet" type="text/css" href="style\bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style\style.css">
  <link rel="stylesheet" href="style\fontawesome\css\all.min.css">
</head>
<body>
<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bgcolor">
    <div class="container">
      <strong class="navbar-brand px-5">
        <span class="navbar-text"><img style="width: 170px; height: 35px;" src="img/lfm.png"></span>
      </strong>
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active"><a class="nav-link" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item dropdown" id="Dropdown"><a class="nav-link menu-dropdown" href="#" role="button" data-toggle="dropdown">Recommandations</a>
            <ul class="dropdown-menu" aria-labelledby="Dropdown" role="menu" id="cache" style="display: none;">
              <li><a class="dropdown-item a" href="#">Approche 1...</a></li>
              <li><a class="dropdown-item a" href="#">Approche 2...</a></li>
              <li><a class="dropdown-item a" href="#">Approche 3...</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">Ajouter un film</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Se déconnecter</a></li>
        </ul>
        <div class="d-flex align-items-center ms-5">
        <div class="input-group">
          <input required id="search" class="form-control input" type="search" placeholder="Rechercher un film" maxlength="30">
          <div class="input-group-prepend me-5">
            <div class="input-group-text bgcolor2">
              <!--<a href="" type="submit">-->
              <a id="btn">
                <i class="fas fa-star"></i>
              </a>
            </div>
          </div>
        </div>
        <!--
        <a type="button" href="addm.php" class="but btn-outline-success me-2"><i class="fas fa-plus"></i></a>
        <a type="button" href="delm.php" class="but btn-outline-danger me-2"><i class="fas fa-trash"></i></a>
        <a type="button" href="delm.php" class="but btn-outline-primary me-2"><i class="fas fa-sign-out-alt"></i></a> -->
      </div>
      </div>
    </div>
  </nav>
  <!-- Navbar -->


  <div id="intro-example" class="p-5 text-center bgcolor2">
    <div class="mask w-100 h-100">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
        </div>
      </div>
    </div>
  </div>

  <input type="text" id="error" value="0.7" style="display: none;">

</header>
  <footer class="text-white text-center px-5 py-1 bgcolor2">
    <hr>
    <div class="container-fluid pt-5 pb-5">
      <div class="row">
        <div class="col-md-4 fs-6 text-white-50">
          <h4 class="font-weight-bold mb-3">Projet</h4><hr>
          <p>........................</p>
        </div>

        <div class="col-md-3">
          <h1 class="font-weight-bold mb-3">_</h1>
          <h6 class="font-weight-bold mb-3">Itoua Bil Théodore</h6>
          <p>1919</p>
          <p>L3 - SI</p>
        </div>
        
        <div class="col-md-3">
          <h1 class="font-weight-bold mb-3">_</h1>
          <h6 class="font-weight-bold mb-3">Sissoko Seyba Yacouba</h6>
          <p>1919</p>
          <p>L3 - ISIL</p>
        </div>

        <div class="col-md-2">
          <div class="col-12">
            <img src="img/lfm.png" class="w-100 p-1 mb-3 photo">
          </div>
          <div class="col-12">
            <a class="but btn-outline-light px-3 my-1" href="#"><i class="fab fa-github"></i></a>
            <a class="but btn-outline-primary px-3 my-1" href="#"><i class="fab fa-twitter"></i></a>
            <a class="but btn-outline-danger px-3 my-1" href="#"><i class="fab fa-instagram"></i></a>
            <a class="but btn-outline-primary px-3 my-1" href="#"><i class="fab fa-facebook"></i></a>
        </div>
      </div>
    </div>
  </footer>

    <div class="container-fluid bgcolor">
      <div class="row">
        <div class="col-md-12">
          <h6 class="text-center text-light py-3">© Copyright 2022 | Département Informatique - FS - UMBB</h6>
        </div>
      </div>
    </div>

  <script type="text/javascript" src="js\bootstrap.js"></script>
  <script type="text/javascript" src="js\mdb.min.js"></script>
  <script type="text/javascript" src="js\cacher.js"></script>

</body>
</html>









<!-- Pour les photos
  <div class="bg-image hover-zoom">
    <img src="https://mdbcdn.b-cdn.net/img/new/standard/city/053.webp" class="w-100" />
  </div>
-->