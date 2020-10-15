<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    
    $mymail=$cursor["mail"];
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>

<link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
<link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">

<!-- for sidenav -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

<script src="public/jquery-3.2.1.min.js"></script>

<script src="public/js/materialize.js"></script>
<script src="public/js/materialize.min.js"></script>
<script src="./public/js/logout.js"></script>

<style>


.button{
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden;overflow-y:hidden">

  <h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
  <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
  </a></h3> <br><br>

  <a href="http://localhost/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
  <a href="http://localhost/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
  <a href="http://localhost/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
  <a href="http://localhost/hrms/allocateround.php" class="w3-bar-item w3-button"> <span class="new badge green" data-badge-caption="New Round(s)" id="badge_ongoing">4</span>On going rounds</a> <br>
  <a href="http://localhost/hrms/history.php" class="w3-bar-item w3-button">See History</a> <br>
  <a href="http://localhost/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling<span class="new badge green" data-badge-caption="Request(s)" id="badge_rescheduling">4</span></a> <br>
  <a href="http://localhost/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
  <a href="http://localhost/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter<span class="new badge green" data-badge-caption="Request(s)" id="badge_letter">4</span></a> <br>
  <a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

</div>

<div id="remin">
  <nav> 
      <div class="nav-wrapper blue darken-1">
        <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i></a>
        <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>

        <ul style="float:right;">
          <li>
            <select id="logout"class="dropdown-trigger btn blue darken-1">
              <option value=""><?php echo($name) ?></option>
              <option value="profile" id="profile" onclick="">Profile</option>
              <option value="logout">Logout</option>
            </select>
          </li>
        </ul> 
      </div>
  </nav>
</div>
<table id="customers">
  <tr>
    <th>Name    </th>
    
   

    <td><?php echo $cursor['name']; ?></td>
    
    
    

    
  </tr>
  <tr><th>Mail</th>
  <td id="mail"><?php echo  $cursor['mail']; ?></td></tr>

  <tr><th>Designation</th>
  <td><?php echo  $cursor['dsg']; ?></td></tr>

  <tr><th>Region</th>
<td><?php echo  $cursor['rg']; ?></td></tr>

  <tr><th>Department</th>
     <td><?php echo  $cursor['dept']; ?></td></tr>

  <tr> <th>Enable Change Password</th>
  <td><input type="button" value="Enable Change Password" onclick="showhide()"/></td></tr>

  
  <tr> <th>Type New  Password</th>
  <td><input type="text" style="visibility:hidden" id="case"/></td></tr>
  
  
  
  
</table>
<br>
<center>
<div>
<button type="button"  style="visibility:hidden" id="chps" onclick="changepassword()">Change Password</input>
</div>
<br>
<div class="msg" id="msg"/>
</center>

</body>
<script src="public/js/common.js"></script>
<script src="public/jquery-3.2.1.min.js"></script>    
<script src="public/js/materialize.js"></script>
<script src="public/js/materialize.min.js"></script>
<script src="./public/js/logout.js"></script>
</html>

<script>

function showhide(){
  console.log("hi")
document.getElementById("case").style.visibility = 'visible '
document.getElementById("chps").style.visibility = 'visible '
}

function changepassword(){
  var newpassword=document.getElementById("case").value
 
  
 
  if(newpassword==""){
    console.log("null")
  }else{
    //console.log("mymail"+mymail)
    $.ajax({
    url:'http://localhost/hrms/api/updatepass.php',
    type:'POST',
    data:{
      "pass":newpassword
      
    },
    success:function(para)
    {
      console.log(para)

      if(para.success=="true"){
        setTimeout(function(){
     document.getElementById("msg").innerHTML="Password Updated";
     },100);


     setTimeout(function(){
     document.getElementById("msg").innerHTML="";
     document.getElementById("msg").color="green"
     },5000);
      }

    }});



  

    
    
    



  }
}

</script>

<?php

}?>