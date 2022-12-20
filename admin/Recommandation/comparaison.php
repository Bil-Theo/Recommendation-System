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
try {
    $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();	
    }
    if(!empty($_GET)){
        $user1 = $_GET['tranche'];
        $file = fopen("http://localhost/PFE/admin/ConstructionBDD/datasets/u.genre", 'r');
        while(!feof($file)){
            $line = explode('|', fgets($file));
            $sql = "select avg(rating) as note from user_item_rating as rel, user as u, item as i where rel.IDuser=u.IDuser and i.IDitem = rel.IDitem and i.".$line[0]."=1 age between ".$user1."and ".($user1+10);
            echo $sql."<br>";
            

        }
    }  
    else{
        echo "<h1>Donner les tranges d'age</h1>";
    }  
?>
<script src = "myChart.js"></script>
</body>
</html>