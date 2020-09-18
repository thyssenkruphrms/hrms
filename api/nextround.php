<?php 

include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    
    error_reporting(0);
    if(isset($_POST))
    { 
        $arr=array();
        $digit13 = preg_split('/[-]/', $_POST['prf']);

        $cursor = $db->rounds->findOne(array('prf' => $digit13[0],'pos'=>$digit13[1],'iid'=>$digit13[2],'rid'=>$digit13[3]));

    
        if($cursor)
        {
            $cursor1 = $db->rounds->find(array("selectedremove"=>array('$exists'=>true)));
            $rc = count(iterator_to_array($cursor1));
            // echo "Value : ".$rc;
            if($rc==0)
            {
                $arr=array();
                echo json_encode($arr);
            }
            else
            {
                //get candidate of that particular prf initiated
                $selectednames=$cursor['selectedremove'];
                $i=0;
                foreach($selectednames as $d)
                {
                    $invdetails = $db->intereval->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"email"=>$d));
                    $getselectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
                    $arr[$i]=array($getselectednames['full_name'],$d,"Selected",$invdetails['interviewer'],$invdetails['inv_name']);
                    $i++;
                }
                $rejectednames=$cursor['rejected'];
                foreach($rejectednames as $d)
                {
                    $invdetails = $db->intereval->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"email"=>$d));
                    $getrejectednames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$d));
                    $arr[$i]=array($getrejectednames['full_name'],$d,"Rejected",$invdetails['interviewer'],$invdetails['inv_name']);
                    $i++;
                }

                $holdnames=$cursor['onhold'];
                foreach($holdnames as $d)
                {
                    $email = explode(",",$d);
                    $invdetails = $db->intereval->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"email"=>$d));
                    $getholdnames =  $db->tokens->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"email"=>$email[0]));
                    if($email[1] != "")
                    {
                        $arr[$i]=array($getholdnames['full_name'],$email[0],$email[1],$invdetails['interviewer'],$invdetails['inv_name']);
                        $i++;
                    }
                    else
                    {
                        $arr[$i]=array($getholdnames['full_name'],$email[0],"On Hold",$invdetails['interviewer'],$invdetails['inv_name']);
                        $i++;
                    }
                }
                    echo json_encode($arr);
            }
            

        }
        else
        {
            echo "404";
        }
            
    }

}
else
{
        header("refresh:0;url=notfound.php");    
}




?>