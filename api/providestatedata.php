<?php
include 'db.php';
header('Content-Type: application/json');



//$fullprf= $_GET["label"];
$fullprf =$_GET["digit13"];
$prfdetails=explode("-",$fullprf);
$iid=$prfdetails[2];
$prf=$prfdetails[0];
$label=$_GET["label"];
$objno=$iid-1;


if($label=='bcomplete'){
$data=$db->generalized->findOne(array("prf"=>$prf));

if($data){
      $allstatus=$data->instances[$objno]->init_time;
 }
else{
     $allstatus="NA";
 }

$members=[];
$basecomplete=$db->rounds->findOne(["prf"=>$prf,"status"=>"bcomplete","iid"=>$iid]);
if($basecomplete){
    foreach($basecomplete->selected as $mem){
        $members[]=$mem;
    }

}
else{
    $members[]="NA";
}

$interviewer="NA";
$compl_time="NA";

$complete_data=$db->interviews->findOne(["prf"=>$prf,"rid"=>"01","iid"=>$iid]);
if($complete_data){
    $compl_time=$complete_data->dates[0]." ".$complete_data->times[0];
    $interviewer=$complete_data->intvmail;

}

echo json_encode(["digit13"=>[$fullprf],"start"=>[$allstatus],"end"=>[$compl_time],"invname"=>[$interviewer],"members"=>[$members]]);
}
else{
    echo json_encode(["digit13"=>["NA"],"start"=>["NA"],"end"=>["NA"],"invname"=>["NA"],"members"=>["NA"]]);

}
//echo "hi";
?>