<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Projection Sur User</title>
<body>
<p>
<?php

include("../LFM/function.php");
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
//On admet avant tout qu'aucun user est en relation avec un autre et donc notre matrice contiendra que des zeros
$matrice =  array();
$fichier =  fopen("matrice_Adj_User.txt","w");
for($i = 0; $i<100; $i++){
    $line = "";
    for($j = 0; $j<100; $j++){
        $u1 = $i + 1;
        $u2 = $j + 1;
        $sql2 = "select t1.IDitem as ii, t1.rating as rr, t1.IDuser as u1, t2.IDuser as u2, count(*) nbr from user as u1, user u2, user_item_rating as t1, user_item_rating as t2 
                                  where t1.IDuser != t2.IDuser and t1.IDitem = t2.IDitem and t2.rating=t1.rating 
                                                             and t1.IDuser= u1.IDuser  and t2.IDuser = u2.IDuser
                                                                     and u1.IDprog = ".$u1." and u2.IDprog = ".$u2." limit 1";

        $resultat = $dbh->prepare($sql2);
        $resultat->execute();
        $set = $resultat->fetch(PDO::FETCH_ASSOC);
        $adj = intval($set["nbr"]);
        if($adj!=0){
            $matrice[$i][$j] = 1;
            echo "<h4> les users ".$set['u1']." et ".$set['u2']." se projectent sur l'item ".$set['ii']. " <br>avec la note ".$set['rr']."</h4> <br>";
        }
        else{
            $matrice[$i][$j] = 0;
        }
        $line .= $matrice[$i][$j].";";
    }
    if($i!=99){    
        $line .="\n";
    }
    fputs($fichier,$line);
}
fclose($fichier);
echo "<div style = 'margin-left: 25%;
                    margin-bottom: 20%;
                    padding: 15%;
                    padding-top: 5.999999999999%;
                    padding-bottom: 3.999999999999%
                    font-weight: bold;'><h1>Algorithme de Projection sur User</h1></div>";
print_Matrix_Adj($matrice);

?>

</body>
</html>