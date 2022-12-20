<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Implementation Ego-LFM et recommandation</title>
<link rel = "stylesheet" href = "style.css" />
<script src="./chart.js"></script>
</head>
<body>
<?php
    //Faire inclure le fichier contenant les fonction essentiel
include("function2.php");
include("mathematical.php");
 //Recommandtion Des items à un inpute
$localcost  = "127.0.0.1";
$database = "movielens100";
$username = "root";
$password = "root";


if(!empty($_GET)){
    $input = $_GET['input'];
    $k=0;
    $com = community("../LFM/communities.txt", $input);
    echo "<br><h1>voici la communauté final de l'user inpute avec l'ID: ".$input."<br/></h1>";
    affiche_Ensemble($com);
    if(count($com)<=0){
        echo "<div style='
        background-color: #ff0000;
        mpadding-left: 20%;
        mpadding-top: 10%;
        width: 70%;'><h1>L'input ".$input." entré ne figure pas dans la bas de donnée movieslens100</h1></div>";
        exit(0);
    }
    try {
        $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $username, $password);
    } catch (PDOException $e) {
            print "Error!:" . $e->getMessage() . "<br/>";
            die();	
        }
    
    $recommandations = array();
    $predi = array();
    $rejet = array();
    for($i = 0; $i<count($com); $i++){
        $sql = "select distinct IDitem  from user_item_rating where rating<=3 and IDuser = ".$com[$i];
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
            array_push($rejet,$set["IDitem"]);
        }
    }
    $rec = array();
    $sql = "select distinct IDitem, rating from user_item_rating where rating>3 and IDuser = ".$input;
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    $j = 0;
    while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
        $rec[$j][0] = $set["IDitem"];
        $rec[$j][1] = $set["rating"];
        $j++;
    }
    //print_r($rec);

    for($i = 0; $i<count($com); $i++){
        $sql = "select distinct I.IDitem as itm, I.titre as tle, I.url as ur, UI.rating as rat from 
        item as I, user_item_rating as UI where I.IDitem = UI.IDitem and UI.rating>3 and UI.IDuser = ".$com[$i];
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
            if(!in_array($set["itm"], $rejet)){
                $line = array();
                array_push($line,$set["itm"]);
                array_push($line,$set["tle"]);
                array_push($line,$set["ur"]);
                array_push($line,$set["rat"]);
                $recommandations = union_vecteur_rating($recommandations,$line);
            }
        }
    }
    //Afficher les recommandation 
    echo "<p> Voici Top ".count($recommandations)." Recommandations Pour l'Utilisateur avec IDuser =  ".$input.": </p>";
    echo "<table class = 'MyRecs'>
             <tr>
                <th>
                   <h2> Identifiant Film </h2>
                </th>
                <th>
                   <h2> Titre </h2>
                </th>
                <th>
                   <h2> Note Reelle </h2>
                </th>
                <th>
                   <h2> Note Predie </h2>
                </th>
                <th>
                   <h2> URL </h2>
                </th>
             </tr>
             ";
    for($i = 0; $i<count($recommandations); $i++){
        
        $predi[$i][0] = $recommandations[$i][0];
        $p = predi($rec, $recommandations[$i][0], $dbh);
        $predi[$i][1] = round($p);
        echo "<tr>
                <td> <h3> ".$recommandations[$i][0]." </h3> </td>
                <td> <h3> ".$recommandations[$i][1]." </h3> </td>
                <td> <h3 class='reel'> ".$recommandations[$i][3]." </h3> </td>
                <td> <h3 class = 'predi'>".$predi[$i][1]."  </h3> </td>
                <td> <a href = '".$recommandations[$i][2]."'>".$recommandations[$i][2]." </a> </td>
              </tr>
            ";
    }
    echo "</table>";

    $error = RMSLE($recommandations, $predi);
    if($error<80){
        echo "<div style='
                        background-color: #ff0000;
                        margin-left: 20%;
                        margin-top: 10%;
                        width: 30%;'><h1>RMSLE est mauvaise: ".$error."</h1><br></div>";
    }
    else if($error>=80 && $error<90){
        echo "<div style='
                        background-color: yellow;
                        margin-left: 20%;
                        margin-top: 10%;
                        width: 30%;'><h1>RMSLE est Moyenne: ".$error."</h1><br></div>";
    }
    if($error>=90 && $error<=95){
        echo "<div style='
                        background-color: green;
                        margin-left: 20%;
                        margin-top: 10%;
                        width: 30%; '><h1>RMSLE est Bonne: ".$error."</h1><br></div>";
    }
    if($error>95){ 
        echo "<div style='
        background-color: rgb(33, 211, 33);
        margin-left: 20%;
        margin-top: 10%;
        width: 30%; '><h1>RMSLE est Bonne: ".$error."</h1><br></div>";
    }

    $sql = "insert into tests values(".$input.",".$error.",".time().")";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
}
else{
    echo "<h1> Entrer un Input dans Url en tapant (?input=value)</h1>";
}
    


    ?> 

<?php
    if(!empty($_GET)){
        echo "<div margin = '50px'>
        <canvas id ='grapheError'></canvas>
    </div>";
    }
?>
<script src = "myChart.js"></script>
</body>
</html>