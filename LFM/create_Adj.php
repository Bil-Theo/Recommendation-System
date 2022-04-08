<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nouveau utilisateur</title>
<body>
<p>
<?php


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
//On admet avant tout qu'aucun user est en relation avec un autre et donc notre matrice contiendra que des zeros
$matrice =  array();
$user = array();
$sql1 = "select  IDuser from user";
$requete = $dbh->prepare($sql1);
$requete->execute();
while($set = $requete->fetch(PDO::FETCH_ASSOC)){
    array_push($user,$set["IDuser"]);
}
for($i = 0; $i<count($user); $i++){
    for($j = 0; $j<count($user); $j++){
        $matrice[$i][$j] = 0;
    }
}
$sql2 = "select t1.IDuser u1, t2.IDuser u2 from user_item_rating as t1, user_item_rating as t2 
                                where t1.IDuser != t2.IDuser and t1.IDitem = t2.IDitem and t2.rating=t1.rating 
                                             and t1.IDuser<=100 and t2.IDuser<=100";
$resultat = $dbh->prepare($sql2);
$resultat->execute();
//Ici on remplace par 1 toutes les cases verifiants les conditions d'adjacence
while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
    $i = (intval($set["u1"]) - 1);
    $j = (intval($set["u2"]) - 1);
    
//echo "(".$set["u1"].",".$set["u2"].")<br>";
    $matrice[$i][$j] = 1;
}
$fichier =  fopen("matrice_Adj_User.txt","w");
for($i = 0; $i < count($user); $i++){
    $line = "";
    for($j = 0; $j<count($user); $j++){
        echo "".$matrice[$i][$j]." ";
        $line .= $matrice[$i][$j].";";
    }
    echo "<br>";
    $line .="\n";
    fputs($fichier,$line);
}
fclose($fichier);

?>

</body>
</html>