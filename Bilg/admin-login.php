<?php
session_start();
$msg = "";
$username = "";
if(!empty($_POST))
{
    $user = $_POST['username'];
    $password = $_POST['password'];
    $value = "value=".$user."";
    if($user && $password)
    {
        if ($user=="Recsyst" && $password=="20212022") {
            header('Location:admin.php');
            die();
        }
        else{   
            $msg = "Nom d'utilisateur ou Mot de passe incorrect !";
        }
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
                        <h2>Identifiez-vous</h2>
                      </div> 
                      <form action="admin-login.php" method="post">
                        <div class="mt-5"></div>
                        <div class="form-row px-5">
                            <div class="col-12 py-2 px-5">
                                <div class="input-group">
                                    <div class="input-group-prepend me-1">
                                        <div class="input-group-text bg-transparent">
                                           <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <input required class="form-control input" type="text" placeholder="Identifiant" maxlength="30" name="username" <?php if(isset($_POST['connexion'])){echo $value;} ?>>
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
                                <button class="btn btn-danger mx-2" name="connexion">Valider</button>
                                <a href="index.html" class="btn btn-dark mx-2">Annuler</a>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <span class="text-warning"><?php if ($msg != ""){echo $msg;} ?></span>
                        </div>
                    </form>
                    </div>
                  </div>
                </div>
            </div>
        </main>
    </body>
</html>