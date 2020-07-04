<?php

include 'db.php';
header('Content-Type: application/json');

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

if($cursor){
    $uid="";

    foreach($cursor as $doc=>$value)
        {
            if($doc=='uid'){
                $uid=$value;
            }      
        }
    
    //echo "Current user ".$uid."<br>";

    $collection=$db->generalized;

    $completed=$collection->count(array('uid'=>$uid,'status'=>'completed'));


    $ongoings=$db->interviews->find(array("accepted"=>"yes",'status'=>'0'));
    $ongoingcount=0;
    if($ongoings){
       $prfs=[];
       foreach($ongoings as $key=>$cur_prf){

           if(in_array($cur_prf->prf,$prfs)==FALSE){
               $ongoingcount++;
               $prfs[]=$cur_prf->prf;
           }
    }
   }

    //$ongoing=$collection->count(array('uid'=>$uid,'status'=>'ongoing'));
    $avail=$collection->count(array('status'=>'avail'));
    
    $initiated_not_assign=$db->rounds->find(array("status"=>"bstart"));
    $initcount=0;
    if($initiated_not_assign){
       $prfs=[];
       foreach($initiated_not_assign as $key=>$cur_prf){

           if(in_array($cur_prf->prf,$prfs)==FALSE){
               $initcount++;
               $prfs[]=$cur_prf->prf;
           }
    }
   }

    
   // $initiated=$collection->count(array('uid'=>$uid,'status'=>'initiated'));
    
    $currentrounds=array("uid"=>$uid,"ongoing"=>$ongoingcount,"avail"=>$avail,"completed"=>$completed,"initiated"=>$initcount);

    //about initiated rounds


     $assigned=$db->interviews->count(array('accepted'=>"no"));

     
     $accepted=$db->interviews->count(array('status'=>'0','accepted'=>array('$in'=>array('pending','yes'))));
 
     $initiateddata=array("init"=>$initcount,"assigned"=>$assigned,"accepted"=>$accepted);
        

    //about completed rounds

    $collection=$db->tokens;

    $validate_process=$collection->find(['afterselection'=>['$exists'=>true]]);
    $validateprocessprfs=array();
    $validatedprfs=array();
    $completedprfs=array();
    $offerrequestedmem=array();
    if($validate_process){


        foreach($validate_process as $key=>$val){
            //echo "here   ".$val->prf." "."<br>".$val->afterselection;
            if(($val->afterselection=="0" or $val->afterselection=="1" or  $val->   afterselection=="4")  and in_array($val->prf,$validateprocessprfs)==false){
                $validateprocessprfs[]=$val->prf;

            }


            
            else if(($val->afterselection=="2")  and (in_array($val->prf,$validatedprfs)==false)){
                $validatedprfs[]=$val->prf;

            }

            
            else if(($val->afterselection=="5")  and (in_array($val->prf,$offerrequestedmem)==false)){
                $offerrequestedmem[]=$val->prf;

            }


            
            else if(($val->afterselection=="6")  and in_array($val->prf,$completedprfs)==false){
                $completedprfs[]=$val->prf;

            }

        }

        $completeddata=array("compl_not_hr2"=>count($validateprocessprfs),"validated"=>count($validatedprfs),"olrequest"=>count($offerrequestedmem),"completed"=>count($completedprfs),"aborted"=>0);
    }
    else{

        $completeddata=array("compl_not_hr2"=>0,"validated"=>0,"completed"=>0);

    }

    echo json_encode(array("general"=>$currentrounds,"initiateddata"=>$initiateddata,"completeddata"=>$completeddata,"para4"=>"ok","para5"=>"ok"));

}
else{
    header("refresh:0;url=notfound.html");

}





?>