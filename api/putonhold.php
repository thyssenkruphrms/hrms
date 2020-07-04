<?php 

include 'db.php';
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
if($cursor)
{
    $mail=$_POST['mail'];
    $digit13=$_POST['id'];
    $digit13 = explode("-",$digit13);
    
    $criteria=array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3]);

    $m = $mail.",absent";
    $result=$db->rounds->updateOne($criteria,array('$addToSet'=>array("onhold"=>$m)));
    if($result)
    {
        $q1 = $db->rounds->updateOne($criteria,array('$pull'=>array('members'=>$m)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        $q2 = $db->interviews->updateOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"intvmail"=>$cursor['mail'],"invname"=>$cursor['name']),array('$pull'=>array('members'=>$mail)),array('safe'=>true,'timeout'=>5000,'upsert'=>true));
        $q3 = $db->interviews->updateOne(array("prf"=>$digit13[0],"pos"=>$digit13[1],"iid"=>$digit13[2],"rid"=>$digit13[3],"intvmail"=>$cursor['mail'],"invname"=>$cursor['name']),array('$addToSet'=>array("evaluated"=>$m)));

        if($q1 and $q2 and $q3)
        {
            echo "success";
        }
        else
        {
            echo "error";
        }
    }
    else
    {
        echo "fail";
    }
}
else
{
    header("refresh:0;url=notfound.html");    
}
?>