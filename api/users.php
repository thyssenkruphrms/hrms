<?php

include 'db.php';
header('Content-Type: application/json');
//var_dump($GLOBALS);
$action=$_POST['action'];
$mail=$_POST['mail'];
$username=$_POST['username'];
$password=$_POST['password'];
$region=$_POST['region'];
$dsg=$_POST['dsg'];
$dept=$_POST['dept'];

// if($_POST['action']){
//     echo json_encode("set");
// }
// else{
//     echo json_encode("not set");
// }
function checkByUID($db,$uid){
    return $db->users->count(["uid"=>$uid]);
   }

function checkByMail($db,$mail){
     return $db->users->count(["mail"=>$mail]);
   }

function addUser($db,$uid,$password,$mail,$dsg,$rg,$dept){
    if(checkByUID($db,$uid) or checkByMail($db,$mail)){
        echo json_encode(array("status"=>"false","message"=>"Hey User Already Found!"));
    
    }
    else{
        $db->users->insertOne(["uid"=>$dsg,"name"=>$uid,"password"=>$password,"mail"=>$mail,"dsg"=>$dsg,"rg"=>$rg,"dept"=>$dept]);
        echo json_encode(array("status"=>"true","message"=>"User Added Successfully"));
    
    }   
}

function deleteUser($db,$uid,$mail){
    if(checkByUID($db,$uid) or checkByMail($db,$mail)){
        if($db->users->deleteOne(["uid"=>$uid,"mail"=>$mail])){
        
            echo json_encode(array("status"=>"true","message"=>"User Deleted Successfully"));
        }
        else{
            echo json_encode(array("status"=>"true","message"=>"User Not Deleted...Something went Wrong"));
        }   
    }
    else{
        echo json_encode(array("status"=>"false","message"=>"User Not Found!"));      
    }   
}



function UpdateUser(){

}


switch($action){
    case "1": addUser($db,$username,$password,$mail,$dsg,$region,$dept);
            break;
    case "2": deleteUser($db,"hrrohit1233","er1abhosale@mitaoe.ac.in");
            break;
    default: echo json_encode(["status"=>"false","message"=>"invalid action"]); 
}


?>