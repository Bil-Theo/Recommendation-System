<?php
    session_start();
    $predi = array();
    $reel = array();
    $item = array();
    if(!empty($_POST)){
        $nbr_rec = $_POST['nbr_rec'];
        for($i = 0; $i<$nbr_rec; $i++){
            $nr = "reel_".$i;
            $np = "predi_".$i;
            $id = "item_".$i;
            array_push($reel, $_POST[$nr]);
            array_push($predi, $_POST[$np]);
            array_push($item, $_POST[$id]);
        }
        $info = $_POST["new_user"];
        $user_info = explode(",", $info);
    }/*
    else{
        session_destroy();
        header('Location:cold_start.php');
        exit;
    }*/?>
<?php
    //Faire inclure le fichier contenant les fonction essentiel
 //Recommandtion Des items à un inpute
$localcost  = "127.0.0.1";
$database = "movielens100";
$username = "root";
$password = "root";

function RMSLE($predi, $reel){
    $val = 0;
    for($i = 0; $i< count($reel); $i++){
            //$y=expression($predi[$i][3], $reel[$i][1]);
            echo "<br>predi : ".$predi[$i]." et reel : ".$reel[$i];
            $a = $predi[$i]+1; 
            $b = $reel[$i]+1;
            $y =  (log($a, 10) - log($b, 10))*(log($a, 10) - log($b, 10));
            $val = $val + $y; //log($a + 1, 10) - log($b + 1, 10))^2;
    }
    $val = $val/count($reel);
    return (1 - sqrt($val))*100;
}




try {
    $dbh = new PDO('mysql:host='.$localcost.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
        print "Error!:" . $e->getMessage() . "<br/>";
        die();	
    }
//while(1){
    //$user = rand(2000, 5000);
    $sql = "select max(IDuser) as nb from user ";
  ///  echo  "<br>select count(*) as nb from user where IDuser = ".$user;
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
    $set = $resultat->fetch(PDO::FETCH_ASSOC);

    $user =$set['nb']+1;
      // break;
   // }
//}

//Enegistrer le new user dans la table user
$sql = "insert into user values(null,".$user.",".$user_info[0].",'".$user_info[1]."','".$user_info[2]."',".$user_info[3].")";
$resultat = $dbh->prepare($sql);
$resultat->execute();

//Faire enrichir la table user_item_rating avec les information du nouveau utilisateur
for($i = 0; $i<$nbr_rec; $i++){
    $sql = "insert into user_item_rating values(".$user.",".$item[$i].",".$reel[$i].",".time().")";
    $resultat = $dbh->prepare($sql);
    $resultat->execute();
}

//enregistrer les tests
$resultat = $dbh->prepare($sql);
$resultat->execute();

$com = array(); 
$k = 0; 
$joidre = 0;
$file = fopen("../LFM/communities.txt", "a+");
$maxDo = 0; 
while(!feof($file)){
    $line = fgets($file);
    $com[$k] = explode(";", $line);
    $Dko = 0;
    for($i = 0; $i <count($com[$k]); $i++){
        $sql = "select count(*) as adj from user_item_rating as t1, user_item_rating as t2 where
             t1.IDitem = t2.IDitem and t1.rating = t2.rating and t1.IDuser = ".$com[$k][$i]." and t2.IDuser = ".$user;
        $resultat = $dbh->prepare($sql);
        $resultat->execute();
        $set = $resultat->fetch(PDO::FETCH_ASSOC);
        if($set['adj']>0){
            $Dko +=1;
        }
    }
    if($maxDo<$Dko){
        $maxDo = $Dko;
        $joidre = $k;
    }
    $k++; 
}
$line = "";
for($i=0; $i< (count($com[$joidre])-1); $i++){
    $line .= $com[$joidre][$i].";";
}
$line .= $user.";\n";
fputs($file, $line);
fclose($file);
$_SESSION['input'] = $user;
header('Location:http://localhost/PFE/utilisateur/Recommandation/user.php');
?> 