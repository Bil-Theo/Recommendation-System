<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="styles.css">
<title>Implementation LFM Basique Avec Chevauchement</title>
</head>
<body>
<p>
<?php

include("function.php");
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
/*Recuperation de la matrice d'Adjacence*/
$file = fopen("http://localhost/PFE/admin/Projection/matrice_Adj_User.txt", "r");
$matrix_Adj = array();
$matrix = array();
$i = 0;
while(!feof($file)){
    $line = fgets($file);
    $matrix[$i] = explode(";", $line); 
    $i++;
}
fclose($file);

for($i = 0; $i<100; $i++){
    for($j = 0; $j<100; $j++){
        $matrix_Adj[$i][$j] = $matrix[$i][$j];
    }
}

echo "<div id = 'titre'> <h1> Algorithme LFM basique à l'éxtension 'AVEC CHEVAUCHEMENT' </h1> </div>";
//print_r($matrix);
print_Matrix_Adj($matrix_Adj);

/*Les étapes d'execution de LFM */
echo "<h2> Etape LFM </h2>";
echo "<br><h2>La Matrice des Cadj<br></h2>";
$temp = calculate_Matrix_Cadj($matrix_Adj);
$matrix_Cadj = $temp[0];
$cadjMax = $temp[1];
$poids = $temp[2];
//print_r($matrix_Cadj);
print_Matrix_Cadj($matrix_Cadj);
//Print_r($poids);
echo "<br> <h2> Tableau de poids pour Chaque Noeuds <br></h2>";
$m = print_Poids($poids);

/*Creation des couples parents */
echo "<br><div class =\"soustitre\"> <h2> Le CadjMax est: ".$cadjMax."</h2> </div>";
echo "<br> <h2> Les Parents Pour le CadjMax = ".$cadjMax."</h2> ";
$parents = create_Parents($matrix_Cadj, $cadjMax);
//print_r($parents);
print_Matrix_Parents($parents);

/*Creation des communnautés  et generation des out*/
$tempo = communities($parents, $matrix_Adj);
$communities = $tempo[0];
$out = $tempo[1];
//print_r($communities);
echo "<br><h2> Tableau de Communautés Initiales </h2> <br> ";
print_Communities($communities);
//print_r($out);
echo "<br><h2> Tableau des Outs </h2> <br> ";
print_Out($out);
$temp = calculate_Matrix_Degree( $matrix_Adj, $communities, $out);
$communities = $temp[0];
$out_Degree = $temp[1];

//print_r($out_Degree);
echo "<br> <h2> Matrices de degrees des Outs Dans les Communautés </h2><br>";
print_Out_Degree($out_Degree, $out);

/*Joindre les outs dans les communautés*/
echo "<p class = 'info'> <strong> ====================================================<br> ";
echo "Les Noeuds Outs vont Joindre les Communautés Selon FIFO <br>";
echo "====================================================</strong> </p>";
echo "<br><h2> Tableau de Communautés Après avec les outs joindre </h2> <br> ";
//print_r($commmunities)
print_Communities($communities);

/*Fusion des communautés seulement une certain conditions*/
$communities = fusion_Communities($communities);
echo "<br><h2> Tableau de Communautés Après Fusion Selon certaines Conditions </h2> <br> ";
//print_r($communities)
print_Communities($communities);

/*Calcules de la modularité de Newman*/
$Q = Q_Newman($matrix_Adj, $poids, $m, $communities);
$Qop = $Q;
echo "<br><h2> La modularité de Newman Q est : ".$Q;
echo "<br>La modularité Optimal est <span class =\"vert\"> ".$Qop."</span></h2><br>";

$info = save($communities, $cadjMax, $Qop);/*La variable info va contenir la matrice 
communautés, le CadjMax et la valeur de la modularité Optimal*/

/*===============================================================
================================================================
=================================================================
=================================================================
================================================================
=================================================================
===================================================================
==================================================================*/
/*Repeter le même travail jsuqu'à 1*/
$cadjMax--;
while($cadjMax>30){
    /*Creation des couples parents */
echo "<br> <div class =\"soustitre\"> <h2> Pour CadjMax egale à  ".$cadjMax."</h2> </div>";
if(verifier_CadjMax($matrix_Cadj, $cadjMax)){
    echo "<br> <h2> Les Parents Pour le CadjMax = ".$cadjMax."</h2> ";
    $parents = create_Parents($matrix_Cadj, $cadjMax);
    //print_r($parents);
    print_Matrix_Parents($parents);
    
    /*Creation des communnautés  et generation des out*/
    $tempo = communities($parents, $matrix_Adj);
    $communities = $tempo[0];
    $out = $tempo[1];
    //print_r($communities);
    echo "<br><h2> Tableau de Communautés Initiales </h2> <br> ";
    print_Communities($communities);
    //print_r($out);
    echo "<br><h2> Tableau des Outs </h2> <br> ";
   print_Out($out);
    $temp = calculate_Matrix_Degree( $matrix_Adj, $communities, $out);
    $communities = $temp[0];
    $out_Degree = $temp[1];
    
    //print_r($out_Degree);
    echo "<br> <h2> Matrices de degrees des Outs Dans les Communautés </h2><br>";
    print_Out_Degree($out_Degree, $out);
    
    /*Joindre les outs dans les communautés*/
    echo "<p class = 'info'> <strong> ====================================================<br> ";
    echo "Les Noeuds Outs vont Joindre les Communautés Selon FIFO <br>";
    echo "====================================================</strong> </p>";
    echo "<br><h2> Tableau de Communautés Après avec les outs joindre </h2> <br> ";
    //print_r($commmunities)
    print_Communities($communities);
    
    /*Fusion des communautés seulement une certain conditions*/
    $communities = fusion_Communities($communities);
    echo "<br><h2> Tableau de Communautés Après Fusion Selon certaines Conditions </h2> <br> ";
    //print_r($communities)
    print_Communities($communities);
    
    /*Calcules de la modularité de Newman*/
    $Q = Q_Newman($matrix_Adj, $poids, $m, $communities);
    if(Q_optimal($Qop, $Q)){
        $Qop = $Q;
        $info = save($communities, $cadjMax, $Qop);
    }
}
else{
    echo "<br><h2 class = 'no_thing'>======================================================";
    echo "<br>Pour CadjMax = ".$cadjMax." il n'y pas de parents donc pas de communautés <br>";
    echo "==================================================</h2> <br>";
}

echo "<br><h2> La modularité de Newman Q est : ".$Q;
echo "<br>La modularité Optimal est <span class =\"vert\"> ".$info[2]." de CadjMax = ".$info[1]."</span></h2><br>";

$cadjMax--;
}

echo "<p class = 'info'> <strong> ====================================================<br> ";
echo "Le Cadj Optimal Pour La Meilleur distrubition Communautaire est ".$info[1]." <br>";
echo "La Modularité Optimal Pour Cette Distribution est ".$info[2]."<br>====================================================</strong> </p>";

echo "<br><h2> Tableau de Communautés Finales </h2> <br> ";
print_Communities($info[0]);

/*Generer le Outpout de l'algorithme qui est le fichier des communautés*/
$file_communities = fopen("communities.txt", "w");
for($k = 0; $k<count($info[0]); $k++){
    $line = "";
    for($i = 0; $i< count($info[0][$k]); $i++){
        if($info[0][$k][$i]==1){
            $j = $i+1;
            $sql = "select IDuser from user where IDprog = ".$j;
            $resultat = $dbh->prepare($sql);
            $resultat->execute();
            while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
                $j = $set["IDuser"]; break;
            }
            $line .= $j.";";
        }
    }
    if($k < (count($info[0])-1)){
        $line .="\n";
    }
    fputs($file_communities, $line);

}
fclose($file_communities);

?>
</p>
</body>
</html>