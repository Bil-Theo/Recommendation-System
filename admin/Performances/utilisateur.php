<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rempli la base de données movielens</title>
<body>
<p>
<?php


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
if(!empty($_GET)){
    $input =$_GET['input'];
    $sql = "select count(*) as nbr from user where IDuser = ".$input;
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    $set = $resultat->fetch(PDO::FETCH_ASSOC);
    if($set["nbr"]==0){
        echo "<p><h1>Utilisateur inexistant dans la base de données</h1></p>";
    }
    else{
        $sql = "select Avg(Quality) as myn from tests group by IDuser having IDuser = ".$input;
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $set = $resultat->fetch(PDO::FETCH_ASSOC);
        echo "<p><h1>La moyenne de recommandation pour L'user ".$input."est : ".$set['myn']."</h1></p>";      
    }

}
else{
    echo "<p><h1>Entrer un user dans l'url en tapant: ?input=value</h1></p>";
}