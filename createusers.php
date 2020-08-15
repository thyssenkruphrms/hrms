<?php
//error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    
    if($designation == "ceo")
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <script src="public/jquery-3.2.1.min.js"></script>
  
  <script src="public/js/materialize.js"></script>
  <script src="public/js/materialize.min.js"></script>
<script>
      function readURL(input) {
        var f = $('#uploadcsv').val().split('.')
            var x=f[1]
            if(x=='csv')
            {
              var f = $('#uploadcsv').val()
            
            $('#myfile0').text(f)
            }
            else
            {
              alert('Invalid File\n Only CSV Files Accepted')
              $('#uploadcsv').val(" ")
            }
      }
</script>
</head>
<style>
    .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}</style>

<body>

  <nav>
  <div class="nav-wrapper blue darken-1">
  <a href="http://localhost/hrms/">
      <button class="btn waves-effect blue darken-1" style="float:left;margin-top: 18px;margin-right: 18px "> <- BACK</button>
      </a> 

      <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>

      <div id="logoutuser" class="row">
    <button class="btn waves-effect blue darken-1" type="submit" name="action" style="float:right;margin-top: 18px;margin-right: 18px ">LOGOUT</button>
  </div>
  
    </div>
  </nav>

    <br>
    <center>
<button class="button">Only you can create delete or update info of users.</button>
</center>

    <!-- card stars -->
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card white">
                <div class="card-content blue-text">
                <a class="btn red modal-trigger" href="#modal1" style="float:right;" id="mymodal">CSV FILE FORMAT</a>
                <span class="card-title">Upload Dump</span>
                <p>Upload csv dump here cosisting of all the previous data.<br>
                    Once the file is uploaded
                 cannot be changed.   
                </p>

                <form method="POST" id="myform" action="api/importUserExcel.php"  enctype="multipart/form-data">
                            
                         
                    <div class="input-field col s12 offset-m4" id="uphoto">
                            <label class="custom-file-upload" id="prof">
                                <a class="btn blue darken-1">
                                <input id="uploadcsv" required type="file" accept=".csv" name="uploadcsv" onchange="readURL(this)"><p id='myfile0'><i class="material-icons right">open_in_browser</i> </p></a>
                            </label>
                            <br><br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn blue darken-1" name="submit" id="submit" value="Upload">
                      <i class="material-icons right">send</i>Upload</button>

                    </div>
                </form>
                <br><br><br><br><br>
                </div>

            </div>
        </div>
  </div>
    <!-- card ends -->

    <br>
  <div class="row" id='row' >
    <div class="col m4 offset-m4">
      <div class="card  white">
        <div class="card-content white-text">
          
          
          <div class="col s12 ">

          <div class="input-field col s1 blue-text">
          <i class="material-icons prefix ">assignment_ind</i>
          </div>
          
          <div class="input-field col s11 blue-text ">
          <select id='dsgchoice' class="dropdown-trigger btn blue darken-1" required>
              <option value="0" disabled selected style="color: white">Select Designation</option>
              <option value="hod">Head of Department for all Regions</option>
              <option value="rghead">Head of Region</option>
              <option value="hr">HR</option>
              <option value="hr2">HR2</option>
              <option value="inv">Interviewer</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text" > 
          <i class="material-icons prefix " id="rg">location_city</i>
          </div>

          
          <div class="input-field col s11 blue-text">
                     <select id='rgchoice' class="dropdown-trigger btn blue darken-1"  required>
              <option value="0" disabled selected style="color: white">Select Region</option>
            </select>
            </div>

            <div class="input-field col s1 blue-text" >
          <i class="material-icons prefix " id="dept">account_balance</i>
          </div>

          <div class="input-field col s11  blue-text">
          <select id='deptchoice' class="dropdown-trigger btn blue darken-1"  required>
              <option value="0" disabled selected style="color: white">Select Department</option>
            </select>
            </div>
                        
            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">email</i>
              <input id="pos" type="text" class="validate" placeholder="Enter Mail"  required>               
            </div>
            
                        <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">account_circle</i>
              <input id="username" type="text" class="validate" placeholder="Enter Username" required>               
            </div>

            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">vpn_key</i>
              <input id="password" type="password" class="validate" placeholder="Enter Password" required>               
            </div>

            <div class="input-field col s11  blue-text">
              <i class="material-icons prefix">lock</i>
              <input id="cnfrmpassword" type="password" class="validate" placeholder="Confirm Password" required>               
            </div>
            <center>
            <div class="input-field col s12">

              <button class="btn waves-effect waves-light blue darken-1" id="checkprf">Update if exist or create
                <i class="material-icons right">send</i>
              </button>
            </center>
             <!-- <button class="btn waves-effect waves-light blue darken-1" id="deluser">Delete
                <i class="material-icons right">send</i>
              </button>-->

            </div>

          </div>  
          <div class="row" >
<center>
<p style="color: green" id="creatinggrp"> Inserting Details ...</p>
<p style="color: green" id="groupcreated"> Details inserted Successfully</p>
<p style="color: red" id="groupnotcreated"> These Details already exist</p>
</center>
</div>
          
          </div>
         


</div>



</div>

</div>
</div>


<div id="logout">
<h1>Successfully Logged Out</h1>
</div>





</body>
</html>
<!-- end create group -->




<script>
var groupStatus;
var department
var prfno
var pos

var prfno
var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr

var txt="<div class='row'><div class='input-field col s11  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);


}

$(document).ready(function(){
$('#rgchoice').hide()
$('#deptchoice').hide()
$('#rg').hide()
$('#dept').hide()
$("#notlogout").hide()
$("#logout").hide()
$('#histbtn').hide()
$('#hide').hide()
$('#hide2').hide()
$('#Exist').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#groupcreation').hide();


$('#newgroup').hide();
$('#notexist').hide();

$('#groupcreation').click(function(){

$('#newgroup').show(600);
});


//load event to populate dept and regions event

$.ajax({
type:"GET",
url:"demo.txt",

success : function(para){
para = ['chakan','xyz','pqr','abc']
var para2 = ['dept1','dept2','dept3']
//for loop -> region
for(let i =0;i<para.length;i++)
{
  var str = '<option value="'+para[i]+'"  style="color: white">'+para[i]+'</option>'
  $("#rgchoice").append(str)
}
//for loop -> dept
for(let i =0;i<para2.length;i++)
{
  var str = '<option value="'+para2[i]+'" style="color: white">'+para2[i]+'</option>'
  $("#deptchoice").append(str)
}

}
});
  

$('#dsgchoice').change(function(){
  var dsg = $('#dsgchoice').val();
 // alert(dsg)

  console.log(dsg);
  if(dsg == 'hod')
  {
    $('#rgchoice').fadeOut()
    $('#rg').fadeOut()
    $('#dept').fadeIn()
    $('#deptchoice').fadeIn()



  }
  else if(dsg == 'rghead')
  {
    $('#dept').fadeOut()
    $('#deptchoice').fadeOut()
    $('#rgchoice').fadeIn()
    $('#rg').fadeIn()
    

  }
  else
  {
    $('#rg').fadeIn(600)
    $('#dept').fadeIn(600)
    $('#rgchoice').fadeIn(600)
    $('#deptchoice').fadeIn(600)
  }
})














//create PRF Number

$('#checkprf').click(function(){

$('#groupcreated').hide()
$('#groupnotcreated').hide()

$('#creatinggrp').hide()

$('#creatinggrp').fadeIn(500);


 var department = $('#deptchoice').val()
 var region=$('#rgchoice').val()
 if(region==undefined){
   region=""
 }
 var dsg = $('#dsgchoice').val()
 var mail=$('#pos').val()
 var username=$('#username').val()
 var password=$('#password').val()
 var cnfrmpassword=$('#cnfrmpassword').val()
console.log("p "+department+" "+region+ " "+dsg)
if(password==cnfrmpassword && (password!=''  && username!='' && mail!='' && department!=null &&  dsg!=null)){
$.ajax({
url : 'http://localhost/hrms/api/users.php',
type : 'POST',
//data : {'deptchoice':department,"prfno":prfno,"pos":pos},
data:{
  "action":1,
  "mail":mail,
  "department":department,
  "dsg":dsg,
  "region":region,
  "dept":department,
  "username":username,
  "password":password
}
,
success : function(para){
  console.log(para)
  $('#creatinggrp').empty()
  if(para.status=="true"){
    $('#creatinggrp').css('color','green')
  
  }
  else{
    $('#creatinggrp').css('color','red')
  
  }
  $('#creatinggrp').append(para.message);
  
  //$('#creatinggrp').height()=300;

  $('#creatinggrp').fadeOut(15000);
  

// if(para == '404')
// {

//   $('#groupnotcreated').fadeIn(600)

//   console.log("PRF ALREADY EXISTS")
// $('#notexist').hide()
// groupStatus=1
// var txt = '<b style="color: green" id="Exist">This PRF Number Already Exist</b>'
// $('#exist').append(txt)
// $('#histbtn').show()


// }
// else if(para == 'success')
// {

//   $('#groupcreated').fadeIn(600)

// groupStatus=0;
// $('#Exist').hide()
// console.log("INSERTED")
// var txt = '<b style="color: red" id="notexist">This PRF Number Does Not Exist</b> '
// $('#exist').append(txt)
// }
},
});
}
else{
  $('#creatinggrp').empty()
  $('#creatinggrp').css('color','red');
  $('#creatinggrp').append("password should match and fill all details");
}
$('#notexist').fadeIn(600);
});


//deleting user code







});



$('#logoutuser').click(function(){

$.ajax({
url:"http://localhost/hrms/api/logout.php",
type:"POST",
success:function(para){

if(para=="success")
{
$("#row").hide()
$("#logout").show()
document.location.replace("http://localhost/hrms/index.php")
}
else
{
$("#notlogout").show()
document.location.replace("http://localhost/hrms/")
}
} 

})

});


</script>

</body>
</html>









<?php
            }
            else
            {
                header("refresh:0;url=notfound.php");
            }
        }
        else
        {
            header("refresh:0;url=notfound.php");
        }
    }
    else
    {
        header("refresh:0;url=notfound.php");
    }  
?>
