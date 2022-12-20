<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mes fonctions</title>
<body>
<p>
<?php
function affiche_Ensemble($v){
    echo "<div style = 'width: 150px;'><h3>{";
      for ($i=0; $i < count($v); $i++) { 
          if($i != (count($v)-1)){
              echo "".$v[$i].";";
          }
          else{
              echo "".$v[$i]."}</h3></div>";
          }
      }
}
function zero($matrix){
    for($i = 0; $i<count($matrix); $i++){
        for($j = 0; $j<count($matrix); $j++){
            $matrix[$i][$i] = 0;
        }
    }
    return $matrix;
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
function supprimer($mat, $index){
    unset($mat[$index]);
    $mat = array_values($mat);
    return $mat;
}
function tout_Element(){
    $tmp = array();
    global $MRC;
    for ($i=0; $i < count($MRC); $i++) { 
        array_push($tmp, $i);
    }
    return $tmp;
}
function union_vecteur($v1, $v2){
    $v3 = $v1;
    for($i = 0; $i<count($v2); $i++) { 
            if(verication_Appartenance($v1,$v2[$i]) == 0){
                array_push($v3,$v2[$i]);
            }
        }
        return $v3;
}

function Verification_Adj($value1, $value2){
    global $MRC;
    $verite = 0;
    for($i = 0; $i<count($MRC); $i++){
        for($j = 0; $j<count($MRC[$i]); $j++){
            if(($value1 == $i && $value2 == $j) || ($value1 == $j && $value2 == $i)){
                if($MRC[$i][$j]==1 || $MRC[$j][$i]==1){
                    $verite = 1; break;
                }
            }
        }
        if($verite == 1){ break;}
    }
      return $verite;
}
function verifier_Couple($mesParents, $i, $j){
    $resultat = 0;
      for ($K=0; $K < count($mesParents); $K++) { 
          if(($mesParents[0][$K]==$j && $mesParents[1][$K]==$i) or ($mesParents[0][$K]==$i && $mesParents[1][$K]==$j)){
              $resultat = 1; break;
          }
      }
    return $resultat;
}
function calculate_Absd($comk, $o){
  global $MRC;
  $Abs = array();
  for ($i=0; $i < count($comk); $i++) { 
      if(Verification_Adj($comk[$i],$o) == 1 && verication_Appartenance($Abs,$comk[$i]) == 0){
            array_push($Abs, $comk[$i]);
      }
  }
  return $Abs;
       
}
function Cadj($Adi, $Adj){
    $k = 0;
    $cadj = array();
     for($i = 0; $i<count($Adi); $i++){
         for($j = 0; $j<count($Adj); $j++){
             if( $Adi[$i] == $Adj[$j] && verication_Appartenance($cadj,$Adi[$i]) == 0){
                 $cadj[$k] = $Adi[$i];
                 $k++;
             }
         }
     }
     return $cadj;
}
function intersection($Adi, $Adj){
    $cadj = array();
    $k = 0;
     for($i = 0; $i<count($Adi); $i++){
         for($j = 0; $j<count($Adj); $j++){
             if( $Adi[$i][0] == $Adj[$j][0]){
                 echo "".$Adi[$i][0]." et ".$Adj[$j][0]."<br>";
                 $cadj[$k] = $Adi[$i];
                 $k++;
             }
         }
     }
     return $cadj;   
}
function Adjacent($ii){
    global $MRC;
    $k = 0;
    $t = array();
    for($i = 0; $i<count($MRC); $i++){
        if($ii == $i){
          for($j = 0; $j<count($MRC[$i]); $j++){
              if($MRC[$i][$j] == 1 && $i != $j){
                  $t[$k] = $j;
                  $k++;
              }
          }
         return $t;
        }
    }
    
}
function expression($a, $b){
    $x=(log($a + 1, 10) - log($b + 1, 10));
    return ($x*$x);
}
function RMSLE($predi, $reel){
    $val = 0;
    for($i = 0; $i< count($reel); $i++){
        
        echo "<br>".$predi[$i][0]. " et ".$reel[$i][0].":<br>";

        if($predi[$i][0] == $reel[$i][0]){
            $y=expression($predi[$i][3], $reel[$i][1]);
             $val = $val + $y; //log($a + 1, 10) - log($b + 1, 10))^2;
            echo "<br>".$predi[$i][3]. " et ".$reel[$i][1]." donnent val= ".$y."<br>";
        }
    }
    $val = $val/count($reel);
    return (1-sqrt($val)) * 100;
}
function community($namefile, $input){
$fichier = fopen($namefile, "r");
$com = array(); 
$k = 0;
echo "<h2>final = { } avec Input IDuser = ".$input."<br></h2>";
while(!feof($fichier)){
     $line=fgets($fichier);
     $resultat = explode(";",$line);
     if(verication_Appartenance($resultat,$input)){
         echo "<br><h3> ".$input." appartient à la communauté ".$k."</h3><br>";
         echo "<h3>alors final = final union Com[".$k."]</h3>";
         $com = union_vecteur($com,$resultat);
     } 
     $k++;
 }
  return $com;
}

function union_vecteur_rating($v1, $v2){
    $verite = false;
    for($i = 0; $i<count($v1); $i++){
        if($v1[$i][0]==$v2[0] && $v1[$i][1]==$v2[1] && $v1[$i][2]==$v2[2]){
           $verite = true; break;
        }
    }
    if(!$verite){
        array_push($v1, $v2);
    }
    return $v1;

}

?>

</body>
</html>