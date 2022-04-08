<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Implementation Ego-LFM et recommandation</title>
<link rel = "stylesheet" href = "style.css" />
</head>
<body>
<p>
    <?php
//   $x=log(2,10);
//echo "==================================$x==================";
    //Faire inclure le fichier contenant les fonction essentiel
include("function.php");
$input = 7;
$k=0;
 //Recommandtion Des items à un inpute
$localcost  = "127.0.0.1";
$database = "movie100";
$username = "root";
$password = "root";
try {
    $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();	
	}
$sql = "select IDitem, rating from user_item_rating where IDuser = ".$input;
$resultat = $dbh->prepare($sql);
$resultat->execute();
$reel = array();
while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
    $line = array();
    array_push($line, $set["IDitem"]);
    array_push($line, $set["rating"]);
    array_push($reel, $line);
}
$recommandations = array();
for($i = 0; $i<count($reel); $i++){
    $com = community("communaute_Item.txt", $reel[$i][0]);
    for($i = 0; $i<count($com); $i++){
        $sql = "select distinct I.IDitem as itm, I.titre as tle, I.url as ur, UI.rating as rat from 
        item as I, user_item_rating as UI where I.IDitem = UI.IDitem and UI.rating>3 and UI.IDuser = ".$com[$i];
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $proto = array();
        while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
            $line = array();
            array_push($line,$set["itm"]);
            array_push($line,$set["tle"]);
            array_push($line,$set["ur"]);
            array_push($line,$set["rat"]);
            array_push($proto,$line);
            $recommandations = union_vecteur($recommandations,$proto);
        }
    }
}
//Afficher les recommandation 
echo "<p> Voici Les recommandations: </p>";
echo "<table class = \"MyRecs\">
         <tr>
            <th>
               <h2> Identifiant Film </h2>
            </th>
            <th>
               <h2> Titre </h2>
            </th>
            <th>
               <h2> URL </h2>
            </th>
         </tr>
         ";
for($i = 0; $i<count($recommandations); $i++){
    echo "<tr>
            <td> <h3> ".$recommandations[$i][0]." </h3> </td>
            <td> <h3> ".$recommandations[$i][1]." </h3> </td>
            <td> <a href = \"".$recommandations[$i][2]."\">".$recommandations[$i][2]." </a> </td>
          </tr>
        ";
}
echo "</table>";
echo "RMSE = ".RMSLE($recommandations, $reel);       
echo "<br/>Fin";
    
?> 
</p>
</body>
</html>