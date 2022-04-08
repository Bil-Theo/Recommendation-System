<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nouveau utilisateur</title>
<body>
<p>
<?php


$localcost  = "127.0.0.1";
$database = "movie100";
$itemname = "root";
$password = "root";
try {
    $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $itemname, $password);
} catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();	
	}
//On admet avant tout qu'aucun user est en relation avec un autre et donc notre matrice contiendra que des zeros
$matrice =  array();
$item = array();
$sql1 = "select distinct IDitem from user_item_rating order by IDitem";
$requete = $dbh->prepare($sql1);
$requete->execute();
while($set = $requete->fetch(PDO::FETCH_ASSOC)){
    array_push($item,$set["IDitem"]);
}
for($i = 0; $i<count($item); $i++){
    for($j = 0; $j<count($item); $j++){
        $matrice[$i][$j] = 0;
    }
}
$sql2 = "select t1.IDitem i1, t2.IDitem i2 from user_item_rating as t1, user_item_rating as t2 
where t1.IDitem != t2.IDitem and t1.IDuser=t2.IDuser and t1.rating=t2.rating and t1.IDuser<100 and t2.IDuser";
$resultat = $dbh->prepare($sql2);
$resultat->execute();
//Ici on remplace par 1 toutes les cases verifiants les conditions d'adjacence
while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
    $i = (intval($set["i1"]) - 1);
    $j = (intval($set["i2"]) - 1);
    
//echo "(".$set["u1"].",".$set["u2"].")<br>";
    $matrice[$i][$j] = 1;
}
$fichier =  fopen("matrice_Adj_Item.txt","w");
for($i = 0; $i < count($item); $i++){
    $line = "";
    for($j = 0; $j<count($item); $j++){
        echo "".$matrice[$i][$j]." ";
        $line .= $matrice[$i][$j].";";
    }
    echo "<br>";
    $line .="\n";
    fputs($fichier,$line);
}

?>

</body>
</html>