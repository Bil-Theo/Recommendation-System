<!DOCTYPE html>
<html>
    <head>       
        <script src="../Recommandation/chart.js"></script>
        <title>Graphes Choix des users</title>
    </head>
    <body><?php  
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
    $file = fopen("datasets/u.occupation", "r");
    echo "<table> <tr>";
    while(!feof($file)){
        $occupation  = fgets($file);
        $sql = "select count(IDprog) as nbr from user where profession = '".$occupation."'";
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $set = $resultat->fetch(PDO::FETCH_ASSOC);
        echo "<td class='nbr'>".$set['nbr']."</td>";
        echo "<td class='label'>".$occupation."</td>";
    }
    echo "</tr></table>";
?>
        <div>
            <canvas id = "choix_user"></canvas>
        </div>
        <script src = "myChart.js"></script>
    </body>
</html>