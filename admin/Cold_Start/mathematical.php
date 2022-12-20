<?php
    function sim_item($j, $jj, $dbh){
        $sim = 0;
        $num = 0;
        $d1 = 0;
        $d2 = 0;
        $sql = "select distinct t1.IDuser as u, t1.rating as r1, t2.rating as r2 from user_item_rating as t1, user_item_rating as t2 where t1.IDitem!=t2.IDitem and t2.IDuser=t1.IDuser and t1.IDitem = ".$j." and t2.IDitem = ".$jj;
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $user_r1_r2 = array();
        $k = 0;
        while($set = $resultat->fetch(PDO::FETCH_ASSOC)){
            if(count($set)>0){
                $line = array();
                array_push($line, $set["u"]);
                array_push($line, $set["r1"]);
                array_push($line, $set["r2"]);
                $user_r1_r2[$k] = $line;
                $k++;
                $num += $line[1] * $line[2];
            }
        }

        for($i = 0; $i<count($user_r1_r2); $i++){
            $d1 += $user_r1_r2[$i][1] * $user_r1_r2[$i][1];
            $d2 += $user_r1_r2[$i][2] * $user_r1_r2[$i][2];
        }
        if($d1>0 && $d2>0){
            $d =  sqrt($d1) * sqrt($d2);
            $sim = $num/$d;
        }
        return $sim;
    }

    function prediction($rec, $i, $dbh){
        $num = 0;
        $deno = 0;
        for($j = 0; $j<count($rec); $j++){
            if($rec[$i][0] != $rec[$j][0]){
                $sim = sim_item($rec[$i][0], $rec[$j][0], $dbh);
                echo "sim de ".$rec[$i][0]." et ".$rec[$j][0]." = ".$sim."<br>";
                $num += $sim * $rec[$i][3];
                $deno += $sim;

            }
        }
        if($deno>0){
            return $num/$deno;
        }
        return 1;
    }
    // Calcule l'âge à partir d'une date de naissance jj/mm/aaaa
function age($date_naissance){
    date_default_timezone_set("America/Los_Angeles");
    $date = date("dd/mm/y", strtotime($date_naissance));
    $am = explode('/', $date);
    $an = explode('/',date("dd/mm/y"));
    if(($am[1] < $an[1]) || (($am[1] == $an[1]) && ($am[0] <= $an[0]))) return $an[2] - $am[2];
        return $an[2] - $am[2] - 1;
    }

?>