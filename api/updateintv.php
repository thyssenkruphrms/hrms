<?php
include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{

    include 'maildetails.php';
    $mail->setFrom("tkep", 'Update in the interview procedure');
    $mail->addReplyTo(Email, 'Information');
    $mail->isHTML(true);   

    $invname=$_POST['intv'];
    $oldintv=$_POST['oldintv'];
    $emails = $_POST['emails'];
    $ctr = 0;
    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    $dates = $_POST['dates'];
    $times = $_POST['times'];


    if($ctr == 0)
    {
        $digit13 = preg_split('/[-]/', $_POST['prf']);
    
        
            //Start - Check whether the new interviewer exists or not 
            $res=$db->interviews->findOne(
                array("rid"=>$digit13[3],
                    'iid'=>$digit13[2],
                    "prf"=>$digit13[0],
                    "pos"=>$digit13[1],
                    "intvmail"=>$_POST['intv'],
                    ),array('projection' => array('intvmail'=>1)));
            $res=count($res);
            // echo json_encode($res);
            //END - Check whether the new interviewer exists or not

            //Start -If new interviewer exists
            if($res != 0)
            {
                echo $_POST['intv'];
                //Start - Check whether he is initially rejected by some hr so delete reject status
                $res=$db->interviews->findOne(
                    array("rid"=>$digit13[3],
                        'iid'=>$digit13[2],
                        "prf"=>$digit13[0],
                        "pos"=>$digit13[1],
                        "intvmail"=>$_POST['intv'],
                        "reject"=>array('$exists'=>true)
                        ));
                        $res=count($res);
                    if($res !=0)
                    {
                        // echo $_POST['intv'];
                            $result = $db->interviews->updateOne(
                                array("rid"=>$digit13[3],
                                    'iid'=>$digit13[2],
                                    "prf"=>$digit13[0],
                                    "pos"=>$digit13[1],
                                    "intvmail"=>$_POST['intv']),
                                array(
                                    '$unset' => array('reject' => true,)),array('multi' => true)
                                );
                    }
                    else
                    {

                    }
                //End - Check whether he is initially rejected by some hr so delete reject status

                    
                    //Start - Push the members from old interviewer doc to new interviewr doc which already exists
                    $result=$db->interviews->updateOne(
                        array("rid"=>$digit13[3],
                            'iid'=>$digit13[2],
                            "prf"=>$digit13[0],
                            "intvmail"=>$invname,
                            ),
                        array('$set'=>array("dates"=>$dates,"moddates"=>$dates,"times"=>$times,"modtimes"=>$times,"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"invstatus"=>"0")));
                        $result=$db->interviews->updateOne(
                            array("rid"=>$digit13[3],
                                'iid'=>$digit13[2],
                                "prf"=>$digit13[0],
                                "intvmail"=>$_POST['oldintv'],
                                ),
                            array('$set'=>array("reject"=>"Assigned To Other Interviewer","invstatus"=>"0","accepted"=>"no")));
                        
                        foreach($emails as $d)
                        {
                            $result=$db->interviews->updateOne(
                                array("rid"=>$digit13[3],
                                'iid'=>$digit13[2],
                                "prf"=>$digit13[0],
                                "intvmail"=>$invname,
                                ),
                                array('$addToSet'=>array("members"=>$d)));
                        }
                        //END - Push the members from old interviewer doc to new interviewr doc which already exists

                        
                    }
                    //End -If new interviewer exists

                    else
                    {
                        //Start - Create new document if the new interviewer doesnt exists.
                        $result=$db->interviews->updateOne(array("rid"=>$digit13[3],"prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"intvmail"=>$_POST['oldintv']),array('$set'=>array("intvmail"=>$_POST['intv'],"invname"=>$_POST['iname'],"designation"=>$_POST['idesg'],"dept"=>$_POST['idept'],"dates"=>$dates,"moddates"=>$dates,"times"=>$times,"modtimes"=>$times,"ilocation"=>$_POST['iloc'],"iperson"=>$_POST['iperson'],"invstatus"=>"0","accepted"=>"no")));
                        //END - Create new document if the new interviewer doesnt exists.
                    }
        
        
    }
    else
    {
        echo "notsent";
    }
}
else
{
    header("refresh:0;url=notfound.php");    
}
?>