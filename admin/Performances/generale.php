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

    $sql = "select Avg(Quality) as myn from tests";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    $set = $resultat->fetch(PDO::FETCH_ASSOC);
    echo "<p><h1>La moyenne générale du Système est : ".$set['myn']."</h1></p>";


?>

</body>
</html>