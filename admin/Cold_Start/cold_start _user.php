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
        header('Location:preference.php');
        exit;
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="fontawesome\css\all.min.css"/>
<link rel="stylesheet" href="monstyle.css"/>
<script src="../Recommandation/chart.js"></script>
<title>Cold Start</title>
</head>
<body id = "invisble">
<form method="POST" action="fifo_cold_start_user.php"> 
<?php
    include("function2.php");
    include("mathematical.php");
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
    echo "<input style='display:none' class='valeur' type = 'number' value='".$values[$i]."'>";
    echo "<input style='display:none' class='categorie' type='text' value='".$key[$i]."'>";
    $sql = "select i.IDitem as itm from item as i, user_item_rating as r, r.IDitem = i.IDitem and r.rating <=3 and i.".$key[$i]."=1";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
        array_push($bad_Recommendation, $set["itm"]);
    }
    if($values[$i]==4 || $values[$i]==5){
        $sql = "select i.IDitem as itm, i.titre as tle, i.url as ur, rel.rating as rat  from user_item_rating as rel, item i, user u where i.IDitem=rel.IDitem and rel.IDuser = u.IDuser and i.".$key[$i]." =  1 and profession = '".$prof."' and rel.rating between 4 and 5 and age between ".$age." and ".($age +10)."";
    }
    //echo  "select i.IDitem as itm, i.titre as tle, i.url as ur, rel.rating as rat  from user_item_rating as rel, item i, user u where i.IDitem=rel.IDitem and rel.IDuser = u.IDuser and i.".$key[$i]." =  1 and rel.rating = ".$values[$i]." and profession = '".$prof."' and age between ".$age." and ".($age +10)." order by rat desc";
    echo "<br>";
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
            
    //Afficher les recommandation et prediction  s'il existe
    if(count($recommandations)>0){
        echo "<input type='number' value='".count($recommandations)."' name = 'nbr_rec' id ='nbr_rec'>";
        //Faire des recommnandation
        for($i = 0; $i<count($recommandations); $i++){
            $recommandations[$i][3] = prediction($recommandations, $i, $dbh);
        }
        echo "<p> <h1> Voici Le Top ".count($recommandations)." de recommandations pour vous</h1> </p>";
echo "<table class = \"MyRecs\">
         <tr>
            <th>
               <h2> Identifiant Film </h2>
            </th>
            <th>
               <h2> Categorie </h2>
            </th>
            <th>
               <h2> Valeur de la Categorie </h2>
            </th>
            <th>
               <h2> Titre </h2>
            </th>
            <th>
               <h2> Predi </h2>
            </th>
            <th>
               <h2> Donner une note à l'item l'item </h2>
            </th>
         </tr>
         ";
for($i = 0; $i<count($recommandations); $i++){
    echo "<tr>
            <td> <h3> ".$recommandations[$i][0]." </h3> </td>
            <td> <h3> ".$recommandations[$i][4]." </h3></td>
            <td> <h3> ".$recommandations[$i][5]." </h3></td>
            <td> <h3> ".$recommandations[$i][1]." </h3> </td>
            <td> <h3> ".$recommandations[$i][3]." </h3> </td>
            <td>   <div id='rec_".$i."'> <h3>  &nbsp &nbsp &nbsp
                      <span class = 'fas fa-star note_1'></span>
                      <span class = 'fas fa-star note_2'></span>
                      <span class = 'fas fa-star note_3'></span>
                      <span class = 'fas fa-star note_4'></span>
                      <span class = 'fas fa-star note_5'></span></h3> <input type='number' value='1' name='reel_".$i."' class='rien'> 
                      <input type='number' value='".$recommandations[$i][3]."' name='predi_".$i."' style ='display:none;'>
                      <input type='number' value='".$recommandations[$i][0]."' name='item_".$i."' style ='display:none;'> </div></td>
          </tr>
        ";
    }
    echo "</table>";
    echo "<input type='text' name='new_user' value= '".$age.",".$genre.",".$prof.",".$codePostal."' style = 'display: none;'>";
    }
    else{
        echo "<p> <h1> Voici Les recommandations pour vous</h1> </p>";
        $sql = "select i.IDitem as itm, i.titre as tle, i.url as ur, avg(rel.rating) as rat, count(rel.IDitem) as nbr  from user_item_rating as rel, item as i where i.IDitem = rel.IDitem group by rel.IDitem order by nbr desc limit 10 ";
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $recommandations = array();
        while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
                $line = array();
                array_push($line,$set["itm"]);
                array_push($line,$set["tle"]);
                array_push($line,$set["ur"]);
                array_push($line,$set["rat"]);
                array_push($line,$key[$i]);
                array_push($line,$values[$i]);
                $recommandations = union_vecteur_rating($recommandations,$line);
            }
            echo "<table class = \"MyRecs\">
            <tr>
               <th>
                  <h2> Identifiant Film </h2>
               </th>
               <th>
                  <h2> Titre </h2>
               </th>
               <th>
                  <h2> Predi </h2>
               </th>
               <th>
                  <h2> Donner une note à l'item l'item </h2>
               </th>
            </tr>
            ";
   for($i = 0; $i<count($recommandations); $i++){
       echo "<input type='number' value='".count($recommandations)."' name = 'nbr_rec' id ='nbr_rec'>";
       echo "<tr>
               <td> <h3> ".$recommandations[$i][0]." </h3> </td>
               <td> <h3> ".$recommandations[$i][1]." </h3> </td>
               <td> <h3> ".$recommandations[$i][3]." </h3> </td>
               <td>   <div id='rec_".$i."'> <h3>  &nbsp &nbsp &nbsp
                         <span class = 'fas fa-star note_1'></span>
                         <span class = 'fas fa-star note_2'></span>
                         <span class = 'fas fa-star note_3'></span>
                         <span class = 'fas fa-star note_4'></span>
                         <span class = 'fas fa-star note_5'></span></h3> <input type='number' value='1' name='reel_".$i."' class='rien'> 
                         <input type='number' value='".$recommandations[$i][3]."' name='predi_".$i."' style ='display:none;'>
                         <input type='number' value='".$recommandations[$i][0]."' name='item_".$i."' style ='display:none;'> </div></td>
             </tr>
           ";
       }
       echo "</table>";
       echo "<input type='text' name='new_user' value= '".$age.",".$genre.",".$prof.",".$codePostal."' style = 'display: none;'>";

    }
    $utilisateur = array($age, $genre, $prof, $codePostal);
?>

<div id="mybtn">
<div class="classer" id = "retour">
                    <a href="PFE/admin/cold_start/preference.php">Retour</a>
</div>
<div  class="classer">
    <input type="submit" value="Suivant" id="env">
</div>
</div>
</form>
        <div>
            <canvas id = "choix_user"></canvas>
        </div>
<script src = "myChart.js"></script>
<script src="bascrypte.js" defer></script>
</body>
</html>