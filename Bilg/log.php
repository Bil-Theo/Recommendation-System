<?php
  session_start();
  if(!empty($_POST)){
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
      $sql = "select count(*) as vrai from user where IDuser = ".$_POST['username'];
      $resultat = $dbh->prepare($sql);
      $resultat->execute();
      $set = $resultat->fetch(PDO::FETCH_ASSOC);
      if($set['vrai']>0){
        $_SESSION['input'] = $_POST['username'];
        header("Location:http://localhost/PFE/utilisateur/Recommandation/user.php");
      }

  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style\style.css">
    <link rel="stylesheet" href="style\fontawesome\css\all.min.css">
  </head>
  <body>
    <main>
      <div class="container mt-10 w-50 ms-25 text-center">
        <div class="forms-box">
          <div class="row">
            <div class="all col-12 col-md-12">
              <div class="col-lg-12 mt-3">
                <img src="img/lfm.png"><hr>
              </div>
              <div class="col-lg-12">
                <h2>CONNEXION</h2>
              </div> 
              <form action="" method="post">
                <div class="mt-5"></div>
                <div class="form-row px-5">
                  <div class="col-12 py-2 px-5">
                    <div class="input-group">
                      <div class="input-group-prepend me-1">
                        <div class="input-group-text bg-transparent">
                          <i class="fas fa-user"></i>
                        </div>
                      </div>
                      <input required class="form-control input" type="text" placeholder="Identifiant" maxlength="30" name="username">
                    </div>
                  </div>
                  <div class="col-12 py-2 px-5">
                    <div class="input-group">
                      <div class="input-group-prepend me-1">
                        <div class="input-group-text bg-transparent">
                          <i class="fas fa-lock"></i>
                        </div>
                      </div>
                      <input required class="form-control input" type="password" name="password" placeholder='Mot de passe' maxlength="30">
                    </div>
                  </div>
                  <div class="mt-5"></div>
                  <div class="col-12 py-3 mb-3">
                    <input class="btn btn-danger mx-2" type="submit" name="connexion" value='Valider'>
                    <a href="index.html" class="btn btn-dark mx-2">Annuler</a>
                  </div>
                </div>
                      <!--<span class="msg"><?php /* if ($msg != ""){echo $msg;} */?></span>-->
              </form>
            </div>
          </div>
          <div class="justify-content-end">
            <div class="row">
              <div class="col-12">
                <p class="head-contact text-center mt-3">
                  <span> Vous n'avez pas encore de compte ? </span><a href="sign.html">Créez-en un !</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
</html>