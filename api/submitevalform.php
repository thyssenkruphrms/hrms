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
            //$namerelletter = $_FILES['relletter']['name'];
            // $temprelletter = $_FILES["relletter"]['tmp_name'];
            // move_uploaded_file($temprelletter,"../upload/".$folder."/".$namerelletter);
            //$namerelletter = "upload/".$folder."/".$namerelletter;
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
            
            $namealldocs = $_FILES['alldocs']['name'];
            $tempalldocs = $_FILES["alldocs"]['tmp_name'];
            move_uploaded_file($tempalldocs,"../upload/".$folder."/".$namealldocs);
            $namealldocs = "upload/".$folder."/".$namealldocs;
            
            $nameadhaar = $_FILES['adhaar']['name'];
            $tempadhaar = $_FILES["adhaar"]['tmp_name'];
            move_uploaded_file($tempadhaar,"../upload/".$folder."/".$nameadhaar);
            $nameadhaar = "upload/".$folder."/".$nameadhaar;

            $namepancard = $_FILES['pancard']['name'];
            $temppancard = $_FILES["pancard"]['tmp_name'];
            move_uploaded_file($temppancard,"../upload/".$folder."/".$namepancard);
            $namepancard = "upload/".$folder."/".$namepancard;

            $nameproof_address = $_FILES['proof_address']['name'];
            $tempproof_address = $_FILES["proof_address"]['tmp_name'];
            move_uploaded_file($tempproof_address,"../upload/".$folder."/".$nameproof_address);
            $nameproof_address = "upload/".$folder."/".$nameproof_address;


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
                "pancard"=>$namepancard,
                "proof_address"=>$nameproof_address,
                "adhaar"=>$nameadhaar,
                "cancelledcheck"=>$namecancelcheck,
                "alldocs"=>$namealldocs,
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