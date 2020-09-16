<?php 
session_start();
include "db.php";
    
$mail=$_SESSION['mailid'];
$mailid=$_SESSION['mailid'];

$time = date("h.i.sa");
$date = date("Y.m.d");
$mail = $mail."(".$date."--".$time.")";
mkdir("../upload/".$mail);
$folder = $mail;
$nameappletter = $_FILES['appletter']['name'];
$tempappletter = $_FILES["appletter"]['tmp_name'];
move_uploaded_file($tempappletter,"../upload/".$folder."/".$nameappletter);
$nameappletter = "upload/".$folder."/".$nameappletter;
$namesalarybreak = $_FILES['salarybreak']['name'];
$tempsalarybreak = $_FILES["salarybreak"]['tmp_name'];
move_uploaded_file($tempsalarybreak,"../upload/".$folder."/".$namesalarybreak);
$namesalarybreak = "upload/".$folder."/".$namesalarybreak;
$namepastpayslip = $_FILES['pastpayslip']['name'];
$temppastpayslip = $_FILES["pastpayslip"]['tmp_name'];
move_uploaded_file($temppastpayslip,"../upload/".$folder."/".$namepastpayslip);
$namepastpayslip = "upload/".$folder."/".$namepastpayslip;
$uan = $_POST['uan'];
$namecancelcheck = $_FILES['cancelcheck']['name'];
$tempcancelcheck = $_FILES["cancelcheck"]['tmp_name'];
move_uploaded_file($tempcancelcheck,"../upload/".$folder."/".$namecancelcheck);
$namecancelcheck = "upload/".$folder."/".$namecancelcheck;
            
$nameadhaar = $_FILES['proof_identity_addhar']['name'];
$tempadhaar = $_FILES["proof_identity_addhar"]['tmp_name'];
move_uploaded_file($tempadhaar,"../upload/".$folder."/".$nameadhaar);
$nameadhaar = "upload/".$folder."/".$nameadhaar;

$nameidproof = $_FILES['proof_otherthanadhar']['name'];
$tempidproof = $_FILES["proof_otherthanadhar"]['tmp_name'];
move_uploaded_file($tempidproof,"../upload/".$folder."/".$nameidproof);
$nameidproof = "upload/".$folder."/".$nameidproof;

$nameproof_address = $_FILES['proof_address']['name'];
$tempproof_address = $_FILES["proof_address"]['tmp_name'];
move_uploaded_file($tempproof_address,"../upload/".$folder."/".$nameproof_address);
$nameproof_address = "upload/".$folder."/".$nameproof_address;

$nameugcert = $_FILES['ugcert']['name'];
$tempugcert = $_FILES["ugcert"]['tmp_name'];
move_uploaded_file($tempugcert,"../upload/".$folder."/".$nameugcert);
$nameugcert = "upload/".$folder."/".$nameugcert;

if(!file_exists($_FILES['pgcert']['tmp_name']) || !is_uploaded_file($_FILES['pgcert']['tmp_name'])) 
{
    $namepgcert = "NA";
}
else
{
    $namepgcert = $_FILES['pgcert']['name'];
    $temppgcert = $_FILES["pgcert"]['tmp_name'];
    move_uploaded_file($temppgcert,"../upload/".$folder."/".$namepgcert);
    $namepgcert = "upload/".$folder."/".$namepgcert;    
}

$nom1=$_POST['nom1'];
$nom2=$_POST['nom2'];
$nom3=$_POST['nom3'];
$nom4=$_POST['nom4'];
echo $namecancelcheck;
echo "<br>".$mailid;
$criteria=array("email"=>$mailid);
$info=array(
    "appletter"=>$nameappletter,
    "salarybreakup"=>$namesalarybreak,
    "uan"=>$uan,
    "pastpayslip"=>$namepastpayslip,
    "proof_address"=>$nameproof_address,
    "adhaar"=>$nameadhaar,
    "idproof"=>$nameidproof,
    "cancelledcheck"=>$namecancelcheck,
    "ugcert"=>$nameugcert,
    "pgcert"=>$namepgcert,
    "nom1"=>$nom1,
    "nom2"=>$nom2,
    "nom3"=>$nom3,
    "nom4"=>$nom4,
    "postfilled"=>"filled",
    "progress"=>"Post Selection Form Submitted");
$queryInsert=$db->tokens->updateOne($criteria,array('$set'=>$info));


if($queryInsert)
{
    $db->tokens->updateOne(array("email"=>$mailid),array('$set'=>array("afterselection"=>"0")));
    $query=$db->tokens->updateOne($criteria,array('$set'=>$info));
    if($query)
    {
        echo "done";
        header("location:../post-candidate-selection.php?token=123");
    }
    else
    {
        echo "fail";
    }
}
else
{
    echo "fail";
}

?>