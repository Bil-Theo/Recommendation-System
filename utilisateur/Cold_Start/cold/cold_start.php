<?php
    session_start();
    if(!empty($_POST)){
        $key = array_keys($_POST);
        $values = array_values($_POST);
        for($i = 0; $i<count($_POST); $i++){
            ${$key[$i]} = $values[$i];
        }
    }/*
    else{
        session_destroy();
        header('Location:../preference.php');
        exit;
    }*/
?>




<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Essai</title>
  <link rel="stylesheet" type="text/css" href="http://localhost/PFE/utilisateur/Recommandation/style.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/PFE/Bilg/style\bootstrap.css">
  <link rel="stylesheet" type="text/css" href="http://localhost/PFE/Bilg/style/style.css">
  <link rel="stylesheet" href="http://localhost/PFE/admin/Cold_Start/fontawesome\css\all.min.css">
  <link rel="stylesheet" href="monstyle.css">
</head>
<body>
<header>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bgcolor">
    <div class="container">
      <strong class="navbar-brand px-5">
        <span class="navbar-text"><img style="width: 170px; height: 35px;" src="http://localhost/PFE/Bilg/img/lfm.png"></span>
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
</header>
<main> <!--<div class="d-flex justify-content-center align-items-center h-100">-->
  <div id="" class="p-5 text-center container">
    <div class="row">
    <?php
    
    include("../function2.php");
    include("../mathematical.php");
    $localcost  = "127.0.0.1";
    $database = "movielens100";
    $username = "root";
    $password = "root";
    try {
        $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $username, $password);
    } catch (PDOException $e) {
            print "Error!:" . $e->getMessage() . "<br/>";
            die();	
        }

    $recommandations = array();
    $bad_Recommendation = array();
    $age = age($dtn);
    for($i = 0; $i<19; $i++){
        
    $sql = "select i.IDitem as itm from item as i, user_item_rating as r, r.IDitem = i.IDitem and r.rating <=3 and i.".$key[$i]."=1";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
        array_push($bad_Recommendation, $set["itm"]);
    }
    if($values[$i]==4 || $values[$i]==5){
        $sql = "select i.IDitem as itm, i.titre as tle, i.url as ur, rel.rating as rat  from user_item_rating as rel, item i, user u where i.IDitem=rel.IDitem and rel.IDuser = u.IDuser and i.".$key[$i]." =  1 and profession = '".$prof."' and age between ".$age." and ".($age +10)." and rel.rating between 4 and 5";
    }
    //echo  "select i.IDitem as itm, i.titre as tle, i.url as ur, rel.rating as rat  from user_item_rating as rel, item i, user u where i.IDitem=rel.IDitem and rel.IDuser = u.IDuser and i.".$key[$i]." =  1 and rel.rating = ".$values[$i]." and profession = '".$prof."' and age between ".$age." and ".($age +10)." order by rat desc";
    //echo "<br>";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
        if(!in_array($set["itm"], $bad_Recommendation)){
            $line = array();
            array_push($line,$set["itm"]);
            array_push($line,$set["tle"]);
            array_push($line,$set["ur"]);
            array_push($line,$set["rat"]);
            array_push($line,$key[$i]);
            array_push($line,$values[$i]);
            $recommandations = union_vecteur_rating($recommandations,$line);
        }
    }
}
    //Afficher les recommandation 
    echo "<div class='row'>";
    if(count($recommandations)>0){
        echo "nbr ".count($recommandations);
        echo "<input type='number' value='".count($recommandations)."' name = 'nbr_rec' id ='nbr_rec'>";
        //Faire des recommnandation
        for($i = 0; $i<count($recommandations); $i++){
            $recommandations[$i][3] = prediction($recommandations, $i, $dbh);
        }
        $like = explode('(', $recommandations[$i][1]);
        echo " <div class= 'col-lg-3  col-md-9 mb-4 mb-lg-0 picture' > 
                   <div> <a href = 'https://www.themoviedb.org/search?query=".$like[0]."'> <img class='img' src='image\img_".$recommandations[$i][0].".jpg'/></a>
                   </div><p>
                     <h3 class ='deca'>#".($i+1)." - ".$recommandations[$i][0]."<br>".$recommandations[$i][1]."<br>";
            echo "<div class='pos' id = 'rec_".$i."'><span class = 'fas fa-star couleur'></span>
            <span class = 'fas fa-star'></span>
            <span class = 'fas fa-star'></span>
            <span class = 'fas fa-star'></span>
            <span class = 'fas fa-star'></span></div>";
        echo "</h3></p></div>";
        echo "
        <input type='number' value='".$recommandations[$i][3]."' name='predi_".$i."' style ='display:none;'>
        <input type='number' value='".$recommandations[$i][0]."' name='item_".$i."' style ='display:none;'>";
        echo "<input type='text' name='new_user' value= '".$age.",".$genre.",".$prof.",".$codePostal."' style = 'display: none;'>";
    }
    echo "</div>";  
    
?>
      <!--  ICI   -->
    </div>
  </div>
</main>
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
    
  <script type="text/javascript" src="http://localhost/PFE/Bilg/js/bootstrap.js"></script>
  <script type="text/javascript" src="http://localhost/PFE/Bilg/js/mdb.min.js"></script>
  <script type="text/javascript" src="http://localhost/PFE/Bilg/js/cacher.js"></script>
  <script src="bascrypte.js" defer></script>
</body>






