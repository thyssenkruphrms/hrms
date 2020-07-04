<?php
error_reporting(0);

if (isset($_COOKIE['sid'])) {
    include 'api/db.php';

    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));

    if ($cursor) {
        $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
        $designation = $cursor['dsg'];

        if ($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead") {
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Basic Styles and Scripts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="public/jquery-3.2.1.min.js"></script>

    <!-- materialize Styles and Scripts -->
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>

    <!-- common Styles and Scripts -->
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">
    <!-- for sidenav -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- view Styles -->
    <script src="public/css/view/hrnew.css"></script>


</head>
<style>
    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>

<body>

    <!-- No data modal starts here -->
    <!-- Modal Structure -->
    <div id="nodatamodal" class="modal">
        <div class="modal-content">
            <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
            <br>

            <center>
                <h2>No Data Available</h2>
            </center>

        </div>
        <div class="modal-footer">
            <center>
                <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php">OK<i class="material-icons left" >check_box</i></a>
            </center>
        </div>
    </div>
    <!-- no data modal ends here -->

    <!-- Modal Structure -->
    <!-- modal1 starts here -->
    <div id="modal1" class="modal" style="width:90%">
        <div class="modal-content">

            <table style="border-radius:5px solid black;">
                <tr id="modalheader">

                    <th>Instance ID </th>
                    <th>Instance Name </th>
                    <th>Submissiong Date </th>
                    <th>Requester </th>
                    <th>Position Details</th>
                    <th>Production Line </th>
                    <th>Hiring Type </th>
                    <th>Classification 100</th>
                    <th>Classification 110 </th>
                    <th>Classification 111 </th>
                    <th>Zone </th>
                    <th>Branch </th>
                    <th>Cost Center Name</th>
                    <th>Cost Center Code </th>
                    <th>Department </th>
                    <th>Location </th>
                    <th>Number of Position Open </th>
                    <th>Workforce Classification </th>
                    <th>Request Type </th>
                    <th>Employee Code & 8ID </th>
                    <th>Employee Name </th>
                    <th>New Joiner 8 ID </th>
                    <th>New Joiner Name </th>
                    <th>Required Date </th>
                    <th>Reporting To </th>
                    <th>Budget CTC in INR </th>
                    <th>Internal Posting Recommended </th>
                    <th>Status </th>
                    <th>Next Handler</th>
                </tr>

                <tr id="modalrow">
                    <!-- td will go here -->
                </tr>
            </table>

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect green btn" style="float:left;color:white">Close</a>
        </div>

    </div>
    <!-- modal1 ends here -->

    <!-- modal2 starts here -->
    <!-- <div id="modal2" class="modal">
<div class="modal-content">
<center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
<br>

<center><h2>Are You Sure ?</h2></center>
<center><p>This Position Will Be Withdrawn.</p></center>
<div id="appending_id"></div>
</div>
<div class="modal-footer">
<center>
<a onclick="withdraw(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
<a onclick="withdraw(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
</center>
</div>
</div> -->
    <!-- modal2 ends here -->

    <div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

        <h3 class="w3-bar-item white">
            <center><a href="/hrms/">Home</a>
                <i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>
            </a>
        </h3> <br><br>

        <a href="/hrms/csvupload.php" class="w3-bar-item w3-button">Create new Department and PRF</a> <br>
        <a href="/hrms/hrnew.php" class="w3-bar-item w3-button">Create New Instance</a> <br>
        <a href="/hrms/initiateround.php" class="w3-bar-item w3-button">Initiate rounds for instances</a> <br>
        <a href="/hrms/allocateround.php" class="w3-bar-item w3-button"> <span class="new badge green" data-badge-caption="New Round(s)" id="badge_ongoing">4</span>On going rounds</a> <br>
        <a href="/hrms/history.php" class="w3-bar-item w3-button">See History</a> <br>
        <a href="/hrms/allocateround2.php" class="w3-bar-item w3-button">Rescheduling<span class="new badge green" data-badge-caption="Request(s)" id="badge_rescheduling">4</span></a> <br>
        <a href="/hrms/interview.php" class="w3-bar-item w3-button">Update Interviews</a> <br>
        <a href="/hrms/offerletter.php" class="w3-bar-item w3-button">Offer Letter<span class="new badge green" data-badge-caption="Request(s)" id="badge_letter">4</span></a> <br>
        <a href="#" id="logoutuser" class="w3-bar-item w3-button">Logout</a> <br>

    </div>

    <div id="remin">
        <nav>
            <div class="nav-wrapper blue darken-1">
                <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
</a>
                <a href="/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
            </div>
        </nav>
        <br><br>
        <!-- nav and side menu ended -->

        <select id='deptchoice' class="dropdown-trigger btn blue darken-1 ">
<option value="" disabled selected style="color: white">Select Department</option>
</select>

        <select id='zonechoice' class="dropdown-trigger btn blue darken-1 ">
<option value="" disabled selected style="color: white">Select Zone</option>
</select>
        <br>
        <br>
        <div style="color:white;width:18%;background-color:green;border-radius:2px;font-weight:bold;"> Showing
            <p id="result" style="display:inline;"> </p> PRF of
            <p id="result1" style="display:inline;"> </p> PRF</div><br>
        <div class="row" id="megblock">

            <div class="col s12  blue lighten-4">
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Instance ID</th>
                            <th>Position Details</th>
                            <th>Zone</th>
                            <th>Department</th>
                            <th>No. of Positions</th>
                            <th>Status</th>
                            <th>Initiate</th>
                            <!-- <th>Withdraw</th> -->
                        </tr>
                    </thead>

                    <tbody id='rawdata'>

                    </tbody>
                </table>
            </div>
        </div>

        <br>
        <center>
            <button class="button" id="kindlybtn">Kindly Enter the email IDs for below PRF</button>
        </center>
        <br>
        <div class="col s7 offset-m3 blue lighten-4" id="selectedrow">
            <table class="striped">
                <thead>
                    <tr>
                        <th>Instance ID</th>
                        <th>Position Details</th>
                        <th>Zone</th>
                        <th>Department</th>
                        <th>No. of Positions</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id='rawdata'>
                    <td id="oniid"></td>
                    <td id="onpos"></td>
                    <td id="onzone"></td>
                    <td id="ondept"></td>
                    <td id="onnpos"></td>
                    <td id="onsts"></td>

                </tbody>
            </table>
        </div>
    </div>
    <br>

    <div id="loader">
        <div id="txt">
            <b>Please wait while we are creating a batch and notifying them</b>
        </div>
    </div>


    <div class="row" id="dumpdiv">
        <div class="col s12 m4 offset-m4">
            <div class="card white darken-1">
                <div class="card-content blue-text">
                    <span class="card-title"><b><center>Upload Email Dump</center></b></span>
                    <center>
                        <form id="forms" method="POST" enctype="multipart/form-data">

                            <br><br>

                            <label class="custom-file-upload" id="prof">
<a class="btn blue darken-1">
<input id="uploadcsv" type="file" accept=".csv"  required  name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
</label>
                            <a class="btn red" id="fileformatmodal" style="margin-left:2%" onclick="mymodalopen()"><i class="material-icons right">format_align_justify</i>FILE FORMAT</a>
                            <br><br><br>

                            <button type="submit" onclick="showupdump()" class="btn blue darken-1" name="submit" id="submit" value="Upload"><i class="material-icons right">send</i>Upload</button>

                        </form>
                        <br>

<<<<<<< HEAD
<script>

$("#forms").submit(function(){
        $('#loader').show()
        $("#pleasewait").show()

})


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

function mymodalopen()
{
  
  $("#modal3").modal('open');
}

$('#dumpdiv').hide();
$('#emailcollection').hide();
$('#edump').hide();
$('#submitmaildump').hide();
$('#submitmail').hide();
$('#groupcreated').hide()
$('#groupnotcreated').hide()
$('#creatinggrp').hide()

$('#unsentmails').hide()

$('#emaildump').change(function()
{
      var f = $('#emaildump').val()
      var filesplit=f.split(".")
      checkfile=filesplit[1]
      if(checkfile=="csv")
      {
        $('#myfile').replaceWith(f);
      }
      else
      {
        alert("Invalid File Format")
      }
      
        
})

function removeusingSet(arr) { 
            let outputArray = Array.from(new Set(arr)) 
            return outputArray 
        } 

function filterbydept()
{
  $('#deptchoice').fadeIn(600)
  $('#deptchoice').empty()

  $.ajax({
    url:'http://localhost/hrms/api/getdepartments.php',
    type:'POST',
    success:function(para)
    {
      para = JSON.parse(para)
      uniquedept = removeusingSet(para);
      for(i=0;i<uniquedept.length;i++)
      {
        var str = '<option value="'+uniquedept[i]+'"  style="color: white">'+uniquedept[i]+'</option>'
         $('#deptchoice').append(str);
=======
                    </center>
>>>>>>> dd9d804fa83afe160eac1647d9be2522c0f24039




<<<<<<< HEAD
  var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr
var txt1 = "<div class='input-field col s12 m4 offset-m4  blue-text' style='width:60%;margin-left:20%;' >"
var txt2 = "<i class='material-icons prefix'>email</i>"
var txt3 = "<input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email Address'>"
var txt4 = "</div>"
$("#emailcollection").append(txt1+txt2+txt3+txt4);
}
var arr=[]
var dept=[]
$(document).ready(function(){

  // functionality for notifications start here
  $('#badge_ongoing').hide();
  $('#badge_rescheduling').hide();
  $('#badge_letter').hide();
  
  // ajax call for getting notification details
  $.ajax({
    url:'http://localhost/hrms/demo.txt',
    type:'GET',
    success:function(para)
    {
      // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
      para = {'ongoing':10,'rescheduling':5,"offerletter":0} 
      if(para.ongoing > 0)
      {
        $('#badge_ongoing').text(para.ongoing);
        $('#badge_ongoing').show();
      }
      if(para.rescheduling > 0)
      {
        $('#badge_rescheduling').text(para.rescheduling);
        $('#badge_rescheduling').show();
      }
      if(para.offerletter > 0)
      {
        $('#badge_letter').text(para.offerletter);
        $('#badge_letter').show();
      }
    }
  })
  // functionality for notification ends here
  $("#loader").hide();
  $('.modal').modal();
  
  $('#zonechoice').hide();
  $("#uploaddump").hide()
  $("#nodata").hide()
  $("#ordiv").hide()

 $.ajax({
    url:'http://localhost/hrms/api/getprfdump.php',
    type:'POST',
    // data:{'arr1':arr1},
    success : function(para)
    {
      if(para == "No Data")
      {
        $("#nodatamodal").modal("open");
      }
      else
      {
        console.log(para+"<br>")
        para=JSON.parse(para)
        // window.data=para
        // para=['1001','Developer','North','Sales','5','ongoing']
        console.log("this is length : "+para.length)
        for(let i=0;i<=para.length;i++)
        {
          arr[i]=para[i];
          
        }
        document.getElementById("result").innerHTML = arr.length;
        document.getElementById("result1").innerHTML = arr.length;
=======
                </div>
>>>>>>> dd9d804fa83afe160eac1647d9be2522c0f24039

            </div>
            <center>
                <p style="color:red" id="uploaddump">Please wait uploading email dump ...</p>
            </center>
            <center><b id='unsentmails'>Mails not sent to the following candidates . Please reinitiate the round</b>
                <div id="get"></div>
        </div>
    </div>


    <div class="row">

        <p style="color: green;text-align: center;margin-left:18%;" id="creatinggrp">Creating Group...! </p>
        <p style="color: green;text-align: center;margin-left:18%;" id="groupcreated">Group Created Successfully </p>
        <p style="color: red;text-align: center;margin-left:18%;" id="groupnotcreated">Unable to create group </p>

    </div>

    <div class="card white darken-1" id="ordiv" style="width:15%;margin-left:42%;">
        <center><b>OR <br></center></div><br>
<div class="row card white darken-1" style="width:35%;margin-left:32%;" id="emailcollection">
<center> <br> Enter Email IDs Manually Here <br></b> </center>
        <div class="input-field col s12 m4 offset-m4 blue-text" style="width:60%;margin-left:20%;">
            <i class="material-icons prefix">email</i>
            <input id="email" onfocus="addText(this)" type="text" class="validate" placeholder="Enter Email Address">
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12 m4 offset-m4 center">
            <button class="btn waves-effect waves-light blue darken-1" id="submitmail">Submit Mail
<i class="material-icons right">send</i>
</button>
        </div>
    </div>

    </div>

    <div id="nodata" style="margin-left:40%;color:white;background-color:red;width:15%;height:5%;border-radius:5px;text-align:center;">
        <b>NO PRF's AVAILABLE</b>
    </div>


    <div id="modal3" class="modal" style="width:50%;">
        <div class="modal-content">
            <table class="white-text teal">
                <tr>
                    <th>SrNo.</th>
                    <th>Email Address</th>
                </tr>
            </table>
        </div>
        <center><b class="red-text">Please ensure that the file to be uploaded must have above columns only</b></center>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" style="color:red">Close</a>
        </div>
    </div>

</body>
<style>
    html {
        scroll-behaviour: smooth;
    }

    input[type="file"] {
        display: none;
    }
</style>
<script src="public/js/common.js"></script>
<!-- view Scripts -->
<script src="public/js/view/hrnew.js"></script>

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
