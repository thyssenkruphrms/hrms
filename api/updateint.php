<?php 

include "db.php";
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{

    //echo "ello";
    $prf=$_POST['prf'];
    $iid=$_POST['iid'];
    $rid=$_POST['rid'];
    $oldname=$_POST['oldname']?$_POST['oldname']:"null";
    $oldemail=$_POST['oldemail']?$_POST['oldemail']:"null";
    $olddept=$_POST['olddept']?$_POST['olddept']:"null";
    $olddsg=$_POST['olddsg']?$_POST['olddsg']:"null";
    $newname=$_POST['newname']?$_POST['newname']:"null";
    $newemail=$_POST['newemail']?$_POST['newemail']:"null";
    $newdept=$_POST['newdept']?$_POST['newdept']:"null";
    $newdsg=$_POST['newdsg']?$_POST['newdsg']:"null";
    $newiloc=$_POST['iloc']?$_POST['iloc']:"null";
    $newiperson=$_POST['iperson']?$_POST['iperson']:"null";
    $members=$_POST['members']?$_POST['members']:"null";

    // echo $newname." ".$newemail." ".$prf." ".$rid." ".$iid;

    $res=$db->interviews->findOne(
        array("rid"=>$rid,
            'iid'=>$iid,
            "prf"=>$prf,
            "intvmail"=>$newemail,
            "invname"=>$newname));
        
    $res=count($res);
    
    if($res != 0)
    {

        // echo "NEew".$newemail;
        // echo "Old Email ".$oldemail;
        // echo "Yes gotit";
        $result=$db->interviews->updateOne(
            array("rid"=>$rid,
                'iid'=>$iid,
                "prf"=>$prf,
                "intvmail"=>$newemail,
                ),
            array('$set'=>array("ilocation"=>$newiloc,"designation"=>$newdsg,"dept"=>$newdept,"iperson"=>$newiperson,"accepted"=>"no","reject"=>"Assigned To Other Interviewer")));
                
        
            foreach($members as $d)
            {
                $result=$db->interviews->updateOne(
                    array("rid"=>$rid,
                        'iid'=>$iid,
                        "prf"=>$prf,
                        "intvmail"=>$newemail,
                        ),
                    array('$addToSet'=>array("members"=>$d)));
            }
            
            
    }
    else
    {
        $result=$db->interviews->updateOne(
        array("rid"=>$rid,
            'iid'=>$iid,
            "prf"=>$prf,
            "intvmail"=>$oldemail,
            "invname"=>$oldname),
        array('$set'=>array("intvmail"=>$newemail,"invname"=>$newname,"designation"=>$newdsg,"dept"=>$newdept,"ilocation"=>$newiloc,"iperson"=>$newiperson,"accepted"=>"no")));


        $result=$db->interviews->updateOne(
            array("rid"=>$rid,
                'iid'=>$iid,
                "prf"=>$prf,
                "intvmail"=>$oldemail,
                ),
            array('$set'=>array("reject"=>"Assigned To Other Interviewer")));
            

    }
 }
else
{
    header("refresh:0;url=notfound.html");    
}

?>