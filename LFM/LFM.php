<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Implementation LFM</title>
</head>
<body>
<p>
    <?php
    //Faire inclure le fichier contenant les fonction essentiel
    include("function.php");
      /*recuperation de la matrice d'adjacence*/
      $database = fopen("com.txt", "r");
      $MRC = array();
      $indice = 0;
      while(!feof($database)){
          $line = fgets($database);
          $MRC[$indice] = explode(";",$line);
          $indice++;
      }
      echo "afficher la matrice <br/>";
      foreach ($MRC as $value) {
          echo '<br/>';
          for($i = 0; $i<count($value); $i++){
             echo "".$value[$i]." ";
          }
      }

      /*    Partie principale equivaut à :
      public static void main( String [] args*){
          
      } */
      /*Calcule du nombre max de noeuds adjacents en commun entre tous les noeuds de MRCI*/
          $CadjMax = 0;
        for($i = 0; $i<count($MRC); $i++){
              for($j = 0; $j<count($MRC[$i]); $j++){
            $nbrCommun = count( Cadj(Adjacent($i), Adjacent($j) ) );
                  if($CadjMax < $nbrCommun AND $i != $j){
                      $CadjMax = $nbrCommun;
                  }
              }
            }
            echo '<p> Le CadjMax est: '.$CadjMax."</p>";
     /*Creation des parents et les communautés*/
     $parents = array();
     $k = 0;
     for($i = 0; $i<count($MRC); $i++){
         for($j = 0; $j<count($MRC[$i]); $j++){
            $nbrCommun = count( Cadj(Adjacent($i), Adjacent($j) ) );
            if($CadjMax == $nbrCommun && $i != $j && (verifier_Couple($parents,$i,$j)==0)){
                $parents[0][$k] = $i;
                $parents[1][$k] = $j;
                $k++;
            }
        }
      }
      $nbrParents = $k;
      echo "<p> L'ensemble des parents est: </p>";
      for($k = 0; $k<$nbrParents; $k++) {
          echo "couple: (".$parents[0][$k].",".$parents[1][$k].")<br/>";
      }
      echo "<p> Donc il y'a ".$nbrParents." communauté(s) </p>";
     /*générer l'ensemble des communautés initiales de MRCl et Out_nodes*/
      $out =  tout_Element($MRC);
      $in = array();
      $com = array();
      for($k = 0; $k<$nbrParents; $k++){
         $com[$k] = array($parents[0][$k], $parents[1][$k]);
         $com[$k] = union_vecteur($com[$k], Cadj( Adjacent($parents[0][$k],$MRC), Adjacent($parents[1][$k],$MRC) ));
         $out = complement($out,$com[$k]);
         $in = union_vecteur($in,$com[$k]);
      }
      echo "Affichage des communautés <br/>";
      for($k = 0; $k<$nbrParents; $k++){
          echo "<p> voici l'ensemble de la communauté ".($k+1).": ";
          affiche_Ensemble($com[$k]);
          echo "</p>";
      }
      echo "<p> L'ensemble des outs est: ";
      affiche_Ensemble($out);
      echo "</p>";
      /*joindre les nœuds "out" aux communautés */
      foreach($out as $O){
          $Dmax = 0;
          $Do = array();
          $abds = array();
          for($k = 0; $k<$nbrParents; $k++){
            $abds = calculate_Absd($com[$k],$O);
             array_push($Do, count($abds));
             echo "<br> Affiche absd de ".$O." : ";
             affiche_Ensemble($abds);
             if($Dmax <= $Do[$k]){
                 $Dmax = $Do[$k];
             }
          }
          for($k = 0; $k<$nbrParents; $k++){
            if($Dmax == $Do[$k]){
                if(verication_Appartenance($com[$k],$O) == 0){
                    array_push($com[$k],$O);
                }
            }
          }
          $out = complement($out,$O);
          array_push($in,$O);
      }
      echo "<p> les communautés après fusion: <br/>";
      for ($k=0; $k < count($com); $k++) { 
          echo "<br>la communauté ".($k+1).": ";
          ($com[$k]);
          affiche_Ensemble($com[$k]);
      }
      echo "</p>";
      /*Fusion de communauté selon certaine condition*/
      $private = array();
      for($k = 0; $k<$nbrParents; $k++){
          for ($r=0; $r < $nbrParents; $r++) { 
             $nbr_agre = count( union_vecteur($com[$k], $com[$r]) );
             $nbr_disagre = count( Cadj($com[$k], $com[$r]) ) - $nbr_agre;
             if($nbr_agre >= $nbr_disagre && $r!= $k){
                 $com[$k] = union_vecteur($com[$k], $com[$r]);
                 array_push($private,$r);
             }
          }
      }
      echo "<br> private! ";
      affiche_Ensemble($private);
      echo "<p> les communautés après fusion selon certaines conditions: <br/>"; 
      for ($k=0; $k < count($com); $k++) {
            echo "la communauté ".($k+1).": ";
          affiche_Ensemble($com[$k]);
          
      }
      echo "</p>";
      /*affichage et Sauvegarde des communautés dans un fichier text*/
      $mes_Communautes = fopen("communaute_Item.txt","w");
      for($k = 0; $k < count($com); $k++){
          $input = "";
          foreach ($com[$k] as $value) {
            $input .= $value.";";
          }
          $input .="\n";
          fputs($mes_Communautes,$input);
      }
      fclose($database);
      fclose($mes_Communautes);
    ?>
</p>
</body>
</html>