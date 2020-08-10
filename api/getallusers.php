<?php
require 'db.php';
header('Content-Type: application/json');
//var_dump($GLOBALS);

if(isset($_COOKIE['sid']))
{
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "hr" || $designation == "ceo")
    {

        $users=$db->users->find();
        if($users){
        $userstoshow=array();

        foreach($users as $user=>$val){
            $newuser=[];

            $newuser["uid"]=$val->uid;
            $newuser["name"]=$val->name;
            $newuser["mail"]=$val->mail;
            $newuser["dept"]=$val->dept;
            $newuser["rg"]=$val->rg;
            $newuser["dsg"]=$val->dsg;
            
            $userstoshow[]=$newuser;
        }

        echo json_encode(["status"=>"true","users"=>$userstoshow,"message"=>"Users Founds"]);
    }
    else{
        echo json_encode(["status"=>"false","message"=>"No Users Found"]);
    
    }
}
}}else{
    echo json_encode(["status"=>"false","message"=>"You are not allowed to see it"]);
}
?>


