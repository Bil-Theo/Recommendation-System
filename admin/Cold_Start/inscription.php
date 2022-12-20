<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Inscription</title>
        <link rel = "stylesheet" type ="text/css" href="/css/bootstrap.css" />
        <link rel = "stylesheet" type ="text/css"  href ="style.css" />
    </head>
    <body>
        <form method="post" action = "preference.php" > 
            <span class="message"> Informations générale de L'utilisateur </span>
            <div id = "info_generale" class="row">
                <div class= "classer">
                    <label for ="username">username <span class="obligatoire">*</span></label><br>
                    <input type="text" name="username" class = "input" placeholder="Groupe RS" value = "bil theo" required>
                </div>
                <div class="classer">
                    <label for="mymail">adresse Electronique <span class="obligatoire">*</span></label><br>
                    <input type ="email" name = "mymail" placeholder="ml.recsyst@mail.com"  value = "ml.recsyst@mail.com"class = "input" required>
                </div>
            </div>
            <span class="message"> Informations Personnelles de L'utilisateur</span>
            <div  id="info_perso" class="row">
                <div class= "classer">
                    <label for = "dtn">Date de Naissance <span class="obligatoire">*</span></label><br>
                    <input type = "date" class = "input" name="dtn" value = "01/01/2022" min="01/01/1950" max="01/01/2022" id="dtn" required>
                </div>
                <div class = "classer" >
                        <label>Genre <span class="obligatoire">*</span></label>
                        <select class="form-control" id="list"  name = "genre" required>
                            <option>Donnez votre genre</option>
                            <option value="M" class="opt">Masculin</option>
                            <option value = "F" class="opt">Féminin</option>
                        </select>
                </div>
                <div class="classer">
                    <label for = "codePostal">Code Postal <span class="obligatoire">*</span></label><br>
                    <input type="text" placeholder="35000" name = "codePostal"class = "input" value="35000" required>
                </div>
                <div class = "classer" >
                        <label>Profession<span class="obligatoire">*</span></label>
                        <select class="form-control" id="prof"  name = "prof" required>
                            <option>Donnez votre Profession</option>
                            <?php
                                
                                $profession = fopen("http://localhost/PFE/admin/ConstructionBDD/datasets/u.occupation", "r");
                                while(!feof($profession)){
                                    $prof = fgets($profession);
                                    echo "<option class = 'opt' value = '".$prof."'>".$prof."</option>";
                                }
                            ?>
                        </select>
                </div>
            </div>
            <span class="message">Confidentialité</span>
            <div id="confi" class="row">
                <div class="classer">
                    <label for="mdp">Tapez un mot de passe <span class="obligatoire">* <span id="msm"></span></span></label><br>
                    <input type="password" name="mdp" id="mdp" class = "input" required>
                </div>
                <div class="classer"> 
                    <label for="vermdp">Vérifie le mot de passe tapé<span class="obligatoire"> * <span id="vmsm"></span></span></label><br>
                    <input type="password" name ="vermdp" id="vermdp" class = "input" required>
                </div>
            </div>
            <div class="mesbuttons">
                <div class="classer" id = "retour">
                    <a href="www.facebook.com">Retour</a>
                </div>
                <div id="buttoninvalide" class="classer" title="Assurer vous de remplir tous les deux champs de mot de passe sont identiques">
                    Enregistrer
                </div>
                <div  class="classer">
                    <input type="submit" value="Enregistrer" id="env">
                </div>
            </div>
        </form>
        <script type="text/javascript" src="myscripts.js"></script>
    </body>
</html>