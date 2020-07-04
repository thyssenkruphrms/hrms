<?php

include 'db.php';
header('Content-Type: application/json');

$cursor=$db->interviews->find(array('accepted'=>'yes','status'=>'0'));

if($cursor){

    $prf=[];
    $pos=[];
    $iid=[];
    $rid=[];
    $allmembers=[];
    $allinterviewers=[];


    foreach($cursor as $key=>$val){

        $members=[];

        foreach($val->members as $mem){

            $members[]=$mem;

        }

        
        if(in_array($val->prf,$prf)){
            $prf[]="";
        }else{
        $prf[]=$val->prf;
        }
        
        
        $pos[]=$val->pos;
        $iid[]=$val->iid;
        $rid[]=$val->rid;
        $allmembers[]=$members;
        $allinterviewers[]=$val->intvmail;


       }

       echo json_encode(array("data"=>array("prf"=>$prf,"pos"=>$pos,"iid"=>$iid,"rid"=>$iid,"members"=>$allmembers,"interviewer"=>$allinterviewers)));
    

}
else{
<<<<<<< HEAD
    header("refresh:0;url=notfound.html");
=======
      
    
    
    header("refresh:0;url=notfound.php");
>>>>>>> c10e0a90cbd36519ec22b017bfc5c81aa6e2bbcf


}
?>