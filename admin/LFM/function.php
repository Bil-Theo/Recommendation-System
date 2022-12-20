<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="styles.css">
<title>Mes fonctions</title>
<body>
<p>
<?php

function union_vecteur($v1, $v2){
    $v3 = $v1;
    for($i = 0; $i<count($v2); $i++) { 
        array_push($v3,$v2[$i]);
    }
    return $v3;
}

function print_Matrix_Adj($matrix){
    $size = count($matrix);
    echo "<h1> Matrice D'adjacence <h1>";
    echo "<table> <tr> <td class = \"head_table\">  Si\Sj </td>";
    for($i = 0; $i<$size; $i++){
        echo "<td class = \"head_table\">  S".$i." </td>";
    }
    echo "</tr>";
    for($i = 0; $i<$size; $i++){
        echo "<tr> <td class = \"head_table\">  S".$i."  </td>";
        for($j = 0; $j<$size; $j++){
            if($matrix[$i][$j]!=0){
                echo "<td class = \"vert\">  ".$matrix[$i][$j]."</td>";
            }
            else if($i==$j){
                echo "<td class = \"ciel\"> 0 </td>";
            }
            else{
                echo "<td class = \"no_thing\"> ".$matrix[$i][$j]." </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}
function print_Matrix_Cadj($matrix){

    $size = count($matrix);
    echo "<table> <tr> <td class = \"head_table\">  Si\Sj </td>";
    for($i = 0; $i<$size; $i++){
        echo "<td class = \"head_table\">  S".$i." </td>";
    }
    echo "</tr>";
    for($i = 0; $i<$size; $i++){
        echo "<tr> <td class = \"head_table\">  S".$i."  </td>";
        for($j = 0; $j<$size; $j++){
            echo "<td>".$matrix[$i][$j]."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

function calculate_Matrix_Cadj($matrix){

$size = count($matrix);    
$matrix_Cadj = array();
$poids = array();
$cadjMax = 0;

for($i = 0; $i<$size; $i++){
    $poids[$i] = 0;
    for($j = 0; $j<$size; $j++){
        $matrix_Cadj[$i][$j] = 0;
        
        $poids[$i] += $matrix[$i][$j];
        for($k = 0; $k<$size; $k++){
            if($matrix[$i][$k]==1 && $matrix[$j][$k]==1 && $i!=$j){
                $matrix_Cadj[$i][$j] +=1; 
            } 
        }
        if($cadjMax < $matrix_Cadj[$i][$j]){
            $cadjMax = $matrix_Cadj[$i][$j];
        }
    }    
}
    return [$matrix_Cadj, $cadjMax, $poids];
}

function print_Poids($poids){

    $size = count($poids);
    $m = 0; 
    echo "<table> <tr> <td class = \"pds\"> Si ";
    for($i = 0; $i<$size; $i++){
        echo "<td class = \"pds\"> S".$i."</td>";
    }
    echo "</tr> <tr> <td> Poids(i) </td>";
    for($i = 0; $i<$size; $i++){
        echo "<td> ".$poids[$i]."</td>";
        $m += $poids[$i];

    }
    echo '</tr></table>';
    return $m;
}

function create_Parents($matrix_Cadj,$cadjMax){
    $parent = array();
    $size = count($matrix_Cadj);
    $k = 0;
    for($i = 0; $i<($size); $i++){
        for($j = $i+1; $j<$size; $j++){
            if($matrix_Cadj[$i][$j] >= $cadjMax){
                $parent[0][$k] = $i;
                $parent[1][$k] = $j;
                $k++;
            }
            
        }
    }
    return $parent;
}

function print_Matrix_Parents($parent){

    $size = count($parent[0]);
    echo "<table> <tr> <td class = \"head_table\" > Families </td>";
    for($k = 0; $k<$size; $k++){
        echo "<td class = \"head_table\"> F".$k." </td>";
    } 
    echo "</tr> <tr> <td class = \"head_table\"> Parent 0 </td>";
    for($k = 0; $k<$size; $k++){
        echo "<td> ".$parent[0][$k]."</td>";
    }
    echo "</tr> <tr> <td class = \"head_table\"> Parent 1 </td>";
    for($k = 0; $k<$size; $k++){
        echo "<td> ".$parent[1][$k]."</td>";
    }
    echo "</tr> </table>";
    //print_r($parent);
}

function Cadj($i, $j, $matrix){
    $cadj = array();
    $size = count($matrix);
    $k = 0;
    for($x = 0; $x<$size; $x++){
        $a = ($matrix[$i][$x]==1 || $matrix[$x][$i]==1);
        $b = ($matrix[$x][$j]==1 || $matrix[$j][$x]==1);
        if($a && $b){
            $cadj[$k] = $x;
            $k++;
        }
    }
    return $cadj;
}

function alls($matrix){
    $alls = array();
    for($i = 0; $i<count($matrix); $i++){
        $alls[$i] = $i;
    }
    return $alls;
}

function complement($v1, $v2){
    $res = array();
    for($i = 0; $i<count($v1); $i++){
          if(verication_Appartenance($v2, $v1[$i])==0){
              array_push($res,$v1[$i]);
          }
    }
    return $res;
}

function verication_Appartenance($v, $I){
    $verite = 0;
    for($i = 0; $i<count($v); $i++){
        if($v[$i] == $I){
            $verite =  1; break;
        }
    }
    return $verite;
}

function communities($parent, $matrix){
    $size = count($parent[0]);
    $com = array();
    $comk = array();
    $matrix_Com = array();
    $line = array();
    $out = alls($matrix);
    $t= count($out);

    /*echo "<br> tout element: ";
    print_r($out);*/

    for($k = 0; $k<$size; $k++){
        for($i = 0; $i<$t; $i++){
            $matrix_Com[$k][$i] = 0;
        }
    }

    /*echo "<br> Matric com: ";
    print_r($matrix_Com);*/

    for($k = 0; $k<$size; $k++){
        $comk[0] = $parent[0][$k];
        $comk[1] = $parent[1][$k];
        $a = Cadj($parent[0][$k], $parent[1][$k], $matrix);
        $com[$k] = union_vecteur($comk, $a);
        $out = complement($out, $com[$k]);

        /*echo "<br> com".$k.": ";
        print_r($com[$k]);*/

        for($i = 0; $i<count($com[$k]); $i++){
            $indice = $com[$k][$i];
            $matrix_Com[$k][$indice] = 1; 
        }
    }
    
    /*echo "<br> Matrix com: ";
    print_r($matrix_Com);*/

    return [$matrix_Com, $out];
}

function print_Out($out){
    
    if(count($out)>0){
        echo "<table> <tr> <td class = \"head_table\"> Noeuds Outs </td>";
        for($i = 0; $i<count($out); $i++){
            echo "<td class = 'no_thing'> S".$out[$i]." </td>";
        }
        echo "</tr></table>";
    }
    else{
        echo "<h2 class = \"no_thing\"> Il y'a pas de Outs</h2>";
    }
}

function print_Communities($communities){

    $size = count($communities[0]);
    echo "<table> <tr> <td class = \"head_table\"> Comi\Sj </td>";
    for($i = 0; $i<$size; $i++){
        echo "<td class = \"head_table\">  S".$i." </td>";
    }
    echo "</tr>";
    for($com = 0; $com<count($communities); $com++){
        echo "<tr> <td class = \"head_table\">  Com".$com."  </td>";
        for($j = 0; $j<$size; $j++){
            if($communities[$com][$j]==1){
                echo "<td class = \"vert\"> 1 </td>";
            }
            else{
                echo "<td class = \"no_thing\"> 0 </td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";

}

function calculate_Matrix_Degree($matrix, $communities, $out){

    $out_Degree = array();
    /*Est un tableau dont la case 0 contient le degre max et la case 1 contient d'indice de la communautés 
    que le out O va rejoindre*/
    for($o = 0; $o<count($out); $o++){
        $Domax = 0;
        $DoMax = 0;
        for($k = 0; $k <count($communities); $k++){
            $degree = 0;
            for($j = 0; $j<count($matrix); $j++){
                $indice = $out[$o];
                if($communities[$k][$j]==1 && ($matrix[$indice][$j]==1 || $matrix[$j][$indice]==1)){
                    $degree++;
                }
            }
            $out_Degree[$o][$k] = $degree;
            if($Domax < $degree){
                $Domax = $degree;
                $DoMax = $k;
            }
        }
        $i = $DoMax;
        $O = $out[$o];
        $communities[$i][$O] = 1;
    }
    return [$communities, $out_Degree];

}

function print_Out_Degree($out_Degree, $out){
    if(count($out)>0){
        echo "<table> <tr> <td class = \"head_table\"> Out\Com </td>";
        for($k = 0; $k <count($out_Degree[0]); $k++){
            echo "<td class = \"head_table\"> Com".$k." </td>";
        }
        echo "</tr>";
        for($o = 0; $o<count($out); $o++){
            echo "<tr> <td class = \"head_table\"> S".$out[$o]."</td>";
            for($k = 0; $k <count($out_Degree[0]); $k++){
                echo "<td> ".$out_Degree[$o][$k]." </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<h2 class = \"no_thing\"> Il y'a pas de Outs</h2>";
    }
}

function intersection($a, $b){
    $res = 0;
    for($i = 0; $i<count($a); $i++){
        if($a[$i]==1 && $b[$i]==1){
            $res++;
        }
    }
    return $res;
}

function nbr_union($a, $b){
    $res = 0;
    $size = count($a);
    $comk = array();
    for($i = 0; $i<$size; $i++){
        if($a[$i]==1 || $b[$i]==1){
            $comk[$i] = 1;
            $res++;
        }
        else{
            $comk[$i] = 0;
        }
    }
    return [$comk, $res];
}

function delete_com($communities, $indice){
    $temp = array();
    $k = 0;
    for($i = 0; $i<count($communities); $i++){
        if($i!=$indice){
            $temp[$k] = $communities[$i];
            $k++;
        }
    }
    return $temp;
}

function fusion_Communities($communities){
    $size = count($communities);
    $k = 0;
    while($k < $size){
        $recommencer = false;
        for($r = $k+1; $r<$size; $r++){
            $nbr_agree = intersection($communities[$k], $communities[$r]);
            $res = nbr_union($communities[$k], $communities[$r]);
            $nbr_disgree = $res[1] - $nbr_agree;
            if($nbr_agree > $nbr_disgree){
                $communities[$k] = $res[0];
                $communities = delete_com($communities, $r);
                $recommencer = true; break;
            }
        }
        if($recommencer){
            $k = 0;
            $size--;
        }
        else{
            $k++;
        }
    }
    return $communities;
}

/*function fusion_Communities($communities){
    $size = count($communities);
    for($k = 0; $k<$size; $k++){
        for($r = $k+1; $r<count($communities); $r++){
            $nbr_agree = intersection($communities[$k], $communities[$r]);
            $res = nbr_union($communities[$k], $communities[$r]);
            $nbr_disgree = $res[1] - $nbr_agree;
            echo "<br> Com".$k." et com".$r." ****union: ".$res[1]."**** intersection: ".$nbr_agree."********nbr_disgree".$nbr_disgree."<br>";
            if($nbr_agree >= $nbr_disgree && $r!= $k){
                $communities[$k] = $res[0];
                $communities = delete_com($communities, $r);
                echo "<br> Com".$k." et com".$r." s'unissent<br>";
            }
        }
    }
    return $communities;
}*/

function save($a, $b, $c){
    return [$a, $b, $c];
}

function gamma($i, $j, $com){
    for($k = 0; $k<count($com); $k++){
        if($com[$k][$i]==1 && $com[$k][$j]==1){
            return true;
        }
    }
    return false;
}

function Q_Newman($matrix, $poids, $m, $communities){
    $size = count($communities[0]);
    $somme = 0;
    for($i = 0; $i<$size; $i++){
        for($j = $i+1; $j<$size; $j++){
            if(gamma($i,$j, $communities)){
                $p = $poids[$i] * $poids[$j];
                $P = $p/$m;
                $somme += ($matrix[$i][$j] - $P);
            }
        }
    }
    return $somme/$m;
}

function Q_optimal($Qop, $Q){
    return $Qop<$Q;
}
function verifier_CadjMax($matrix_Cadj, $cadjMax){
    $size = count($matrix_Cadj);
    for($i = 0; $i<$size; $i++){
        for($j = $i+1; $j<$size; $j++){
            if($matrix_Cadj[$i][$j]==$cadjMax){
                return true;
            }
        }
    }
    //Si on parcours toute la matrice et on trouve rien on retourne faux
    return false;
}
?>

</body>
</html>
