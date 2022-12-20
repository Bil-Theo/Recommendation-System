<?php
    session_start();
    if(!empty($_POST)){
        $key = array_keys($_POST);
        $values = array_values($_POST);
        for($i = 0; $i<count($_POST); $i++){
            ${$key[$i]} = $values[$i];
        }
    }
    else{
        session_destroy();
        header('Location:inscription.php');
        exit;
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="fontawesome\css\all.min.css"/>
<link rel="stylesheet" href="monstyle.css"/>
<title>Proposition des sujets</title>
</head>
<body style = "background-color: whitesmoke;">
<form method="POST" action="cold_start.php" id="reco">
<?php
    $type = fopen("../ConstructionBDD/datasets/u.genre", "r");

    include("mathematical.php");
    echo "<div class='pref'> <h1>Questionnaire pour nouveau utilisateur</h1></div>";
    while(!feof($type)){
        $line = fgets($type);
        $value = explode("|", $line);
        echo "<div id='".$value[0]."' class='pref'> <h3><div class='etoiles'>-".$value[0]."</div>";
        echo "<div class='etoiles'><span class = 'fas fa-star note_1'></span>";
        echo "<span class = 'fas fa-star note_2'></span>";
        echo "<span class = 'fas fa-star note_3'></span>";
        echo "<span class = 'fas fa-star note_4'></span>";
        echo "<span class = 'fas fa-star note_5'></span>";
        echo "</div></h3> <input type='number' value='1' name='".$value[0]."' class='rien'></div>";
    }
    for($i=0; $i<count($key); $i++){
        echo "<input type = 'text' value = '".$values[$i]."' name = '".$key[$i]."' style ='display: none'>";
    }

?> 
<div id="mybtn">
<div class="classer" id = "retour">
                    <a href="PFE/admin/cold_start/inscription.php">Retour</a>
</div>
<div  class="classer">
    <input type="submit" value="Enregistrer" id="env">
</div>
</div>
</form>
<script src="bascrypte.js" defer></script>
</body>
</html> 