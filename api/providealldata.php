<?php
include 'db.php';
header('Content-Type: application/json');



$fullprf= json_decode($_GET["prf"]);
//$iid = json_decode($_GET["iid"]);
$prf=substr($fullprf,0,6);
$iid=substr($fullprf,8,3);

$data=$db->rounds->find(array("prf"=>$prf,"iid"=>$iid));

function findallpossible(){
    
}
foreach($data as $key=>$val){
    $allstatus[]=$val->status;
    if($val->status){
        findallpossible();
    }
}

//echo json_encode(["prf"=>$prf,"iid"=>$iid]);

echo json_encode(["data"=>$allstatus]);
?>