<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Administrateur</title>
  <link rel="stylesheet" type="text/css" href="style\bootstrap.css">
  <link rel="stylesheet" type="text/css" href="style\style.css">
  <link rel="stylesheet" href="http://localhost/PFE/admin/Cold_Start/fontawesome/css\all.min.css">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bgcolor">
    <div class="container">
      <strong class="navbar-brand px-3">
        <span class="navbar-text"><img style="width: 170px; height: 35px;" src="img/lfm.png"></span>
        <a type="button" data-mdb-toggle="collapse" data-mdb-target="#lien" aria-controls="lien" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-wrench"></i>
        </a>
      </strong>
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item active"><a class="nav-link" aria-current="page" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
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
                  <i class="fas fa-search"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  
  <div class="collapse navbar-collapse bg-dark p-3 ms-5" id="lien" style="width: 300px; height: 100vh;">
    <ul>
      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#" role="button" aria-expanded="false" >
          <span><i class="fas fa-database fa-fw me-3"></i>
            Vous êtes L'Administrateur
          </span>
        </a>
      </li>

      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-1" role="button" aria-expanded="false" >
          <span><i class="fas fa-table fa-fw me-3"></i>
            Remplissage de la BDD
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-1">
          <li>
            <a href="http://localhost/PFE/admin/ConstructionBDD/remplir_user.php">Users</a>
          </li>
          <li>
            <a href="http://localhost/PFE/admin/ConstructionBDD/remplir_item.php">Items</a>
          </li>
          <li>
            <a href="http://localhost/PFE/admin/ConstructionBDD/remplir.php">Relations</a>
          </li>
        </ul>
      </li>

      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-2" role="button" aria-expanded="false" >
          <span><i class="fas fa-database fa-fw me-3"></i>
            Projection
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-2">
          <li>
            <a href="http://localhost/PFE/admin/Projection/Projection_User.php">Users</a>
          </li>
          <li>
            <a href="http://localhost/PFE/admin/Projection/Projection_Item.php">Items</a>
          </li>
        </ul>
      </li>

      <li class="mb-3">
        <a class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-3" role="button" aria-expanded="false" >
          <span><i class="fas fa-code fa-fw me-3"></i>
            Algorithme LFM
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-3">
          <li>
            <a href="http://localhost/PFE/admin/LFM/LFM_2_1.php" >LFM Users</a>
          </li>
          <li>
            <a href="http://localhost/PFE/admin/LFM/LFM_item.php" >LFM Items</a>
          </li>
        </ul>
      </li>

      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-4" role="button" aria-expanded="false" >
          <span><i class="fas fa-code fa-fw me-3"></i>
            Ego-LFM
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-4">
          <li>
            <a href="http://localhost/PFE/admin/Recommandation/Ego_LFM_User.php" >Ego-LFM Users</a>
          </li>
          <li>
            <a href="#" >Ego-LFM Items</a>
          </li>
        </ul>
      </li>

      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-5" role="button" aria-expanded="false" >
          <span><i class="fas fa-puzzle-piece fa-fw me-3"></i>
            Cold Start
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-5">
          <li>
            <a href="http://localhost/PFE/admin/Cold_Start/inscription.php" >Users</a>
          </li>
          <li>
            <a href="#" >Items</a>
          </li>
        </ul>
      </li>

      <li class="mb-3">
        <a  class="sidenav-link ripple-surface-primary collapsed" data-mdb-toggle="collapse" href="#links-6" role="button" aria-expanded="false" >
          <span><i class="fas fa-wrench fa-fw me-3"></i>
            Performances
          </span>
          <i class="fas fa-angle-down"></i>
        </a>
        <ul class="collapse" id="links-6">
          <li>
            <a href="http://localhost/PFE/admin/Performances/generale.php" >Performance générale</a>
          </li>
          <li>
            <a href="http://localhost/PFE/admin/Performances/utilisateur.php" >Performance par utilisateur</a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
  <!--End-Nav-->
  <!--Main-->
  <div id="intro-example" class="p-5 text-center bgcolor2">
    <div class="mask w-100 h-100">
      <div class="d-flex justify-content-center align-items-center h-100">
        <div class="text-white">
          
        </div>
      </div>
    </div>
  </div>
  <!--End-Main-->

  
  <!--Footer-->

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