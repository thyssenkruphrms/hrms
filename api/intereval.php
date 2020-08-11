<?php 
include 'db.php';

error_reporting(0);

$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $digit13 = $_GET['id'];
    $digit13 = explode("-",$digit13);
    $interviews = $db->interviews->findOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"intvmail"=>$cursor['mail']));
    for($i=0;$i<count($interviews['members']);$i++)
    {
        if($_GET["name"] == $interviews['members'][$i])
        {
            $time = $interviews['times'][$i];
            $date = $interviews['dates'][$i];
        }
    }
    $selection=$_GET['result'];
    //  echo $selection;
    $values=array(
        "candidateknowledge"=>$_GET["candidateknowledge"],
        "candidateexperience"=>$_GET["candidateexperience"],
        "candidatestrength"=>$_GET["candidatestrength"],
        "candidateweakness"=>$_GET["candidateweakness"],
        "candidatespecial"=>$_GET["candidatespecial"],
        "candidatereasonhold"=>$_GET["candidatereasonhold"],
        "candidatedesignation"=>$_GET["candidatedesignation"],
        "date"=>$_GET["date"],
        "remark"=>$_GET["remark"],
        "email"=>$_GET["name"],
        "result"=>$_GET['result'],
        "prf"=>$digit13[0],
        "pos"=>$digit13[1],
        "iid"=>$digit13[2],
        "rid"=>$digit13[3],
        "interviewer"=>$cursor['mail'],
        "inv_dept"=>$cursor['dept'],
        "inv_name"=>$cursor['name'],
        "inv_dsg"=>$cursor['dsg'],
        "inv_date"=>$date,
        "inv_time"=>$time,
        "inv_place"=>$interviews['iperson'],
        "inv_cperson"=>$interviews['iperson']
            
    );
    $result = $db->intereval->insertOne($values);
    $result1 = $db->interviews->find(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]));
    $interviewcriteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"intvmail"=>$cursor['mail']);
    $roundcriteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]);
    
    if($result1)
    {
        //push evaluated candidates in evaluated array 
        $db->interviews->updateOne($interviewcriteria,array('$push'=>array('evaluated'=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));

        
        //pull candidates from members array 
        $db->interviews->updateOne($interviewcriteria,array('$pull'=>array('members'=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        
        //check if all our evaluated START
        $membercount = $db->interviews->findOne($interviewcriteria,array('projection' => array('members' => 1)));
        $membercount =count( iterator_to_array($membercount['members']));
        if($membercount == 0)
        {
           $db->interviews->updateOne($interviewcriteria,array('$set'=>array('accepted'=>'alleval')));    
        }
        
         //check if all our evaluated END
        $selectedcandidate = ($selection=="selected") ? $_GET['name']:"false";
        if($selectedcandidate=="false")
        {
                //enter logic for rejected
                $db->rounds->updateOne($roundcriteria,array('$push'=>array($selection=>$_GET["name"]),'$pull'=>array("members"=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  
    
        }
        else
        {
            //push selected/rejected/onhold candidates into array and pull members from members array
            //push only selected candidates in the selected remove array
            $db->rounds->updateOne($roundcriteria,array('$push'=>array($selection=>$_GET["name"],"selectedremove"=>$selectedcandidate),'$pull'=>array("members"=>$_GET["name"])),array('safe'=>true,'timeout'=>5000,'upsert'=>true));  
            
        }
        echo "success";

    }

      
    
}

else{
    header("refresh:0,url=notfound.html");
}


?>