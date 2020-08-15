<?php

include 'db.php';
header('Content-Type: application/json');
//var_dump($GLOBALS);
$action=$_POST['action'];
$mail=$_POST['mail'];
$username=$_POST['username'];

if($action=='1'){
$password=$_POST['password'];
$region=$_POST['region'];
$dsg=$_POST['dsg'];
$dept=$_POST['dept'];
}


if($action=='3'){
    $uid=$_POST['uid'];
    $region=$_POST['region'];
    $dsg=$_POST['dsg'];
    $dept=$_POST['dept'];
}

function checkByUID($db,$uid){
    return $db->users->count(["uid"=>$uid]);
   }

function checkByName($db,$name){
    return $db->users->count(["name"=>$name]);
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

function deleteUser($db,$name,$mail){
   // echo json_encode(checkByName($db,$name));
     if(checkByName($db,$name)>0 && checkByMail($db,$mail)>0){
        if($db->users->deleteOne(["name"=>$name,"mail"=>$mail])){
        
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



function UpdateUser($db,$uid,$name,$mail,$dsg,$region,$dept){
        $criteria=array('mail'=>$mail);
        if(checkByMail($db,$mail)){
       if( $db->users->updateOne($criteria,array('$set'=>array("rg"=>$region,"name"=>$name,"uid"=>$uid,"dsg"=>$dsg,"dept"=>$dept)))){

       echo json_encode(["status"=>true,"message"=>"user updated successfully"]);
       }
     else{
        echo json_encode(["status"=>false,"message"=>"user not updated"]);
    
    }
}
   
    else{
       echo json_encode(["status"=>false,"message"=>"user not found here"]);
    

    }
}

switch($action){
    case "1": addUser($db,$username,$password,$mail,$dsg,$region,$dept);
            break;
    case "2":
            deleteUser($db,$username,$mail);
            break;
    case "3":
            UpdateUser($db,$uid,$username,$mail,$dsg,$region,$dept);
            break;

    default: echo json_encode(["status"=>"false","message"=>"invalid action","dept"=>$dept]); 
}


?>