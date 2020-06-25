<?php 

// Connection to Database
include 'db.php';
error_reporting(0);

// Check for Login
$cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
if($cursor)
{
    $i=0;
    $result=$db->interviews->find(array("status"=>"0"));
    foreach($result as $d)
    {
        $getpos = $db->prfs->findOne(array("prf"=>$d['prf']));
        $arr[$i]=array($d['prf'],$d['rid'],$d['iid'],$d['intvmail'],$d['invstatus'],$d['invname'],$d['dept'],$d['designation'],$d['accepted'],$d['iperson'],$d['ilocation'],$d['sent'],$getpos['position'],$getpos['department'],$getpos['zone']);
        $i++;
    }
    if(count($arr)==0)
    {
        echo "No Data";
    }
    else
    {
        echo json_encode($arr);
    }
}
else
{
    header("refresh:0;url=notfound.html");
}

?>