<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  //hii by AD
  $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
  
  if($cursor)
  {
    $cursor = $db->users->findOne(array("uid" => $cursor['uid']));
    $designation = $cursor['dsg'];
    $name = $cursor['name'];


    
    if($designation == "hr" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
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

        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

    <script src="public/jquery-3.2.1.min.js"></script>
    <script src="./public/js/logout.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    <style>
  #loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(0,0,0,0.96)  url(loader2.gif)  no-repeat center center !important;
    z-index: 10000;
  }
  #loader > #txt{
          font-size:25;
          margin-left:35% !important;
          margin-top:18% !important; 
  }
  #accept {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(0,0,0,0.96)  url(loader2.gif)  no-repeat center center !important;
    z-index: 10000;
  }
  #accept > #txt{
          font-size:25;
          margin-left:35% !important;
          margin-top:18% !important; 
  }
#modal6{
  width:85%;
}

</style>
</head>
<script>

function abort_round(confr)
{
  
  if(confr)
  {
 
    $.ajax({
        url:"http://localhost/hrms/api/abortround.php",
      type:"POST",
      data: {
        "digit13" :  id_round
      },
      success:function(para){
      console.log(para)
      if(para=="success")
      {
        document.location.reload();
      }
      else if(para == "fail")
      {
        alert("operation failed")
      }
      else if(para == "notfound")
      {
        alert("PRF Does Not Exist")
      }
      else
      {
        console.log("something went wrong")
      }
      } 

    })

  }
}
</script>
<body>

<!-- No data modal starts here -->
  <!-- Modal Structure -->
  <div id="nodatamodal" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>No Data Available</h2></center>
      
    </div>
    <div class="modal-footer">
      <center>
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

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
        <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
      </a>
      <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
      <ul style="float:right;">
          <li>
            <select id="logout"class="dropdown-trigger btn blue darken-1">
              <option value=""><?php echo($name) ?></option>
              <option value="profile">Profile</option>
              <option value="logout">Logout</option>
            </select>
          </li>
        </ul> 
      </div>
  </nav>
  <br><br>
<!-- nav and side menu ended -->
    
    <div class="row">
      <div class="col s12 m12">
        <div class="card  white">
          <div class="card-content blue-text">
              <table class="striped">
                  <thead>
                    <tr>
                        <th>Completed Rounds</th>
                        <th>Position Details</th>
                        <th>Zone</th>
                        <th>Department</th>
                        <th>No. of Positions</th>
                        <th>Create Next Round</th>
                        <th>Complete Process</th>
                    </tr>
                  </thead>
                  <tbody id="addtr">
                    
                  </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
    <center>
    <b><p id="waiting" style="color:red">Updating Details Please Wait...</p></b>
    </center>
    <div class="row" id="allocatingcandidate" >
      <div class="col s12 m12">
        <div class="card  white">
          <div class="card-content blue-text">
            <p id='rid'><b></b></p>
            <div class="row" id="allocation" >
              <div class="col s12 m12" style="border: solid 5p">
                <div class="card white">
                  <div class="card-content blue-text">
                    <div class="row">
                  
                    <div class="input-field col s3 m3 " >
                        <input id="iname" type="text" class="text">
                        <label class="active" for="iname" id="iname" required>Interviewer Name</label>
                      </div>  

                      <div class="input-field col s3 m3 white-text" >
                        <input id="imail" type="text" >
                        <label class="active" for="imail" required>Interwiever Mail ID</label>
                      </div>

                      <div class="input-field col s3 m3 white-text" >
                        <input id="iloc" type="text" >
                        <label class="active" for="iloc" required>Interview Location</label>
                      </div>

                      <div class="input-field col s3 m3 white-text" >
                        <input id="iperson" type="text" >
                        <label class="active" for="iperson" required>Contact Person</label>
                      </div>        
                    </div>
                      
                    <div class="row">
                        <div class="input-field col s3 m3 " >
                          <input id="idept" type="text" class="text">
                          <label class="active" for="idept" id="idept" required>Interviewer Department</label>
                        </div>                                    
                        <div class="input-field col s3 m3 " >
                          <input id="idesg" type="text" class="text">
                          <label class="active" for="idesg" id="idesg" required>Interviewer Designation</label>
                        </div>
                    </div>          
                    

                    <div class="row">
                      <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" type="submit" id='allocatesubmit'>Submit
                      <i class="material-icons right">send</i>
                      </button>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row" id="allocation2" >
              <div class="col s12 m12" style="border: solid 5p">
                <div class="card white">
                  <div class="card-content blue-text">
                    <div class="row">
                  
                    <div class="input-field col s3 m3 " >
                        <input id="hr2name" type="text" class="text">
                        <label class="active" for="hr2name" id="hr2name" required>HR2 Name</label>
                      </div>  

                      <div class="input-field col s3 m3 white-text" >
                        <input id="hr2mail" type="text" >
                        <label class="active" for="hr2mail" required>HR2 Mail ID</label>
                      </div>
                      <div class="input-field col s3 m3 " >
                          <input id="hr2dept" type="text" class="text">
                          <label class="active" for="hr2dept" id="hr2dept" required>HR2 Department</label>
                        </div>                                    
                        <div class="input-field col s3 m3 " >
                          <input id="hr2desg" type="text" class="text">
                          <label class="active" for="hr2desg" id="hr2desg" required>HR2 Designation</label>
                        </div>
      
                    </div>
                      
                    
                    <div class="row">
                      <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" type="submit" id='allocatesubmit2'>Submit
                      <i class="material-icons right">send</i>
                      </button>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div> -->
            <table class="striped">
              <thead>
                <tr>
                  <th>Candidate Name</th>
                  <th>Candidate Mail ID</th>
                  <th>Interviewer Name</th>
                  <th>Interviewer Mail ID</th>
                  <th>Status</th>
                  <th>Time</th>
                  <th>Date</th>
                  <th>Select</th>
                  <th class="btn blue darken-1" id="submit">Assign Interviewer</th>
                  <th class="btn red" style="margin-left: 25px;" id="abort" onclick='$("#modal1").modal("open")'> Abort</th>

                </tr>
              </thead>
              <tbody id="adddetail">
                <tr>
                </tr>
              </tbody>
              
            </table>
            <br>
            <div id="noselect">
            </div>
            <!-- <a class="waves-effect red btn" disabled  id="completeprocess"  onclick='terminateround()'>Complete Interview Process</a>
            <br>
            <a class="waves-effect red btn" id="completeprocess2"  onclick="sendforhistory()">Complete Interview Process</a> -->
          </div>          
        </div>
      </div>
    </div>
  </div>
  <div class="row" >
    <center>
    <p style="color: green" id="sendingmail">Sending Mail to the candidate...Please Wait !  </p>
    <p style="color: green" id="sentsuccess">Mail sent successfully </p>
    <p style="color: red" id="fail">Unable to send mail </p>
    </center>
  </div> 
</div>


<div id="loader">
  <div id="txt">
    <b>Please wait.. while we Complete this Process</b>
  </div>
</div>

<div id="accept">
  <div id="txt">
    <b>Please wait.. while we schedule this interview</b>
  </div>
</div>
  <!-- modal starts here -->

    <!-- modal1 starts here -->
    <div id="modal1" class="modal">
      <div class="modal-content">
        <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
        <br>
        
        <center><h2>Are You Sure ?</h2></center>
        <center><p>This Round Will Be Removed From The Process.</p></center>
        
      </div>
      <div class="modal-footer">
        <center>
        <a onclick="abort_round(true)" class="modal-close waves-effect green btn">Confirm<i class="material-icons left">check_box</i></a>
        <a onclick="abort_round(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
        </center>
      </div>
    </div>
    <!-- modal1 ends here -->

    <!-- modal 2 starts here -->
      <div id="modal8" class="modal">
        <div class="modal-content">
          <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
          <br>
          
          <center><h2>Are You Sure ?</h2></center>
          <center><p>Interview Process Will Be Completed.You Can See These Members in Your History</p></center>
        </div>
        <div class="modal-footer">
          <center>
         <input type="hidden" id="hiddenID">
          <a onclick="completeProcess(true)" class="modal-open waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
          <a onclick="completeProcess(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
          </center>
        </div>
      </div>
    <!-- modal 2 ends here -->

    <!-- modal 3 starts here -->
    <div id="modal3" class="modal">
      <div class="modal-content">
        <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
        <br>
        
        <center><h2>Are You Sure ?</h2></center>
        <center><p>You want to create a new round </p></center>
      </div>
      <div class="modal-footer">
        <center>
        <a onclick="allocateSubmit(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
        <a onclick="allocateSubmit(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
        </center>
      </div>
    </div>
  <!-- modal 3 ends here -->

  <!-- modal ends here -->



<!--Complete Process Modal modal 3 starts here -->
<div id="modal6" class="modal">
      <div class="modal-content">
        <center>Select candidates to to complete the process</center>
        <br>
        <div class="modal-body">
          <table class="highlight">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Mail ID</th>
                    <th>Select</th>
                  </tr>
                </thead>
                <tbody id="finalcands">
                  <tr>
                  </tr>
                </tbody>
                
              </table>
        </div>
      </div>
      <div class="modal-footer openhr2">   
      
      </div>
      <div class="row" id="allocation3" style="display:none;">
              <div class="col s12 m12" style="border: solid 5p">
                <div class="card white">
                  <div class="card-content blue-text">
                    <div class="row">
                  
                    <div class="input-field col s3 m3 " >
                        <input id="hr2name" type="text" class="text">
                        <label class="active" for="hr2name" id="hr2name" required>HR2 Name</label>
                      </div>  

                      <div class="input-field col s3 m3 white-text" >
                        <input id="hr2mail" type="text" >
                        <label class="active" for="hr2mail" required>HR2 Mail ID</label>
                      </div>
                      <div class="input-field col s3 m3 " >
                          <input id="hr2dept" type="text" class="text">
                          <label class="active" for="hr2dept" id="hr2dept" required>HR2 Department</label>
                        </div>                                    
                        <div class="input-field col s3 m3 " >
                          <input id="hr2desg" type="text" class="text">
                          <label class="active" for="hr2desg" id="hr2desg" required>HR2 Designation</label>
                        </div>
      
                    </div>
                      
                    
                    <div class="row">
                      <!-- <input type="hidden" id="hiddenID"> -->
                      <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" type="submit" id='completeinvprocess' >Submit
                      <i class="material-icons right">send</i>
                      </button>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
    </div>
  <!-- modal 3 ends here -->


<center>
<p id="nodata"><b style="color:red;margin-left:12%;">No Data Available..!</b></p>
</center>                          
<script src="public/js/common.js"></script>

<script>
$('#sentsuccess').hide()
$('#fail').hide()
$('#noselected').hide()
$('#sendingmail').hide()

var allmail = []
var selectedmail = []
var selectedmailID = []
var selecteddate = []
var selecteddate2 = []




$(document).ready(function(){

  // functionality for notifications start here
  $('#badge_ongoing').hide();
  $('#badge_rescheduling').hide();
  $('#badge_letter').hide();
  $('#loader').hide();
  $('#accept').hide();
  
  // options={'dismissible': false}
  // $('#modal6').modal(options);
  
  // ajax call for getting notification details
  $.ajax({
    url:'http://localhost/hrms/api/getGeneralizedData.php',
    type:'GET',
    success:function(para)
    {
      // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
      //para = {'ongoing':10,'rescheduling':5,"offerletter":0} 
      if(para.general.ongoing_round > 0)
      {
        $('#badge_ongoing').text(para.general.ongoing_round);
        $('#badge_ongoing').show();
      }
      if(para.general.schdule_count > 0)
      {
        $('#badge_rescheduling').text(para.general.schdule_count);
        $('#badge_rescheduling').show();
      }
      if(para.completeddata.olrequest+para.completeddata.completed > 0)
      {
        $('#badge_letter').text(para.completeddata.olrequest+para.completeddata.completed);
        $('#badge_letter').show();
      }
    }
  })
  // functionality for notification ends here

  $('#nodata').hide()
  $("#completeprocess2").hide()

  $('.datepicker').datepicker
  ({
      minDate:new Date(),
  })
  $('.timepicker').timepicker();
  $('.modal').modal();



$("#waiting").hide();
$.ajax(
  {
    url:'http://localhost/hrms/api/allocateround.php',
    type:'GET',
    success:function(para){
      if(para=='no data')
      {
        $('#nodata').fadeIn(600)
        $("#nodatamodal").modal("open");
      }
      else if(para == "404")
      {
        alert("Please Use GET Method")
      }
      else
      {
        
        var arr = JSON.parse(para)
        console.log(arr)
        var oldarr = []
        arr


        for(let i =0;i<arr.length;i++)
        {
           
            if(oldarr.indexOf(arr[i]) == -1)
            {
              digit13 = arr[i][0]+"-"+arr[i][1]+"-"+arr[i][2]+"-"+arr[i][3]
              appended2=  arr[i][0]+"/"+arr[i][1]+"/"+arr[i][2]+"/"+arr[i][3]+"/"+arr[i][4]+"/"+arr[i][5]
              oldarr.push(digit13)
              var s1='<tr id="'+digit13+'row">'
              var s2='<td>'+digit13+'</td><td>'+arr[i][6]+'</td><td>'+arr[i][5]+'</td><td>'+arr[i][4]+'</td><td>'+arr[i][1]+'</td>'
              var s4='<td><button class="waves-effect green  btn"  id="'+appended2+'" onclick="createnextround(this.id)">See Members</button></td>'
              var s5='<td><button class="waves-effect blue btn finalmodal"  id="'+appended2+'" onclick="completepro(this.id)">Complete Process</button></td></tr>'
              
              var str=s1+s2+s4+s5
              $('#addtr').append(str)
            }
        }
      }
      
  }

})


$('#allocation').hide();
// $('#allocation2').hide();

$('#allocatingcandidate').hide();

});

$('#submit').click(function()
{

    for(let i = 0;i<selectedmailID.length;i++)
    {
      // console.log("id - "+$(selectedmailID[i]+"date").val())
      if($(selectedmailID[i]+"date").val()!="" || $(selectedmailID[i]+"date2").val()!="" )
      {
        flag =0;
        // alert("Data  present");
      }
      else
      {
        // alert("Data not present");
        flag =1;
        break;
      }
    }
   if(selectedmail.length <= 0)
    {
      alert("Please Select Atleast 1 Member")
    }
    else if(flag==1)
    {
      alert("Please Select date or time")
    }
    else
    {
        for(let i=0;i<selectedmail.length;i++)
        {
          console.log(selectedmail[i])
        }

      $('#allocation').show(600);

    }                      
})






counter=1;


function cancelModal()
{
  finalselectionmail = []
  finalselectionmailID = []
  $('#allocation3').css("display","none")
}



function completepro(id)
{
 
  $('#finalcands').empty()
  $('.openhr2').empty()
  arr=[]
  id=id.split('/');
  id=id[0]+'-'+id[1]+'-'+id[2]+'-'+id[3];
  console.log("This is ",id)

  $.ajax({
      url:'http://localhost/hrms/api/getfinalselected.php',
      type:'POST',
      data : {
        'digit13':id
      },

      success:function(para)
      {
        console.log(para)
        arr = JSON.parse(para);
        window.finalmembers = arr;
        if(arr.length > 0)
        {
            for(let i =0;i<arr.length;i++)
            {
              // console.log(arr[i])
              allmail[i] = arr[i]
              var s1='<tr id="check'+i+'row">'
              var s2='<td><a href="http://localhost/hrms/documentcheck.php?aid='+arr[i][1]+'" target="_blank" "><p >'+arr[i][0]+'</p></a></td>'
              var s3='<td><a href="http://localhost/hrms/documentcheck.php?aid='+arr[i][1]+'" target="_blank" "><p id="finalcheck'+i+'mail">'+arr[i][1]+'</p></a></td>'
            
              var s6='<td><label><input type="checkbox" class="filled-in" id="finalcheck'+i+'" onclick="finalselection(this.id)">'
              var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
              
        
              var str=s1+s2+s3+s6+s7
              $('#finalcands').append(str)
            }
            var foot1 = '<center>'
            var foot2 = '<a id='+id+' onclick="terminateround(this.id,true)" class="modal-open waves-effect green btn openhr2" >Confirm<i class="material-icons left" >check_box</i></a> &nbsp;&nbsp;&nbsp;'
            var foot3 = '<a  onclick="cancelModal()"class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>'
            var foot4 = '</center>'
            $('.openhr2').append(foot1+foot2+foot3+foot4)
        }
        else
        {
            var s1 = "<p style ='color:red;'>There are no candidates selected you can complete this round</p>"
            var foot1 = '<center>'
            var foot2 = '<a id='+id+' onclick="terminateround(this.id,false)" class="modal-open waves-effect green btn openhr2" >Complete Process<i class="material-icons left" >check_box</i></a> &nbsp;&nbsp;&nbsp;'
            var foot3 = '<a  onclick="cancelModal()"class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>'
            var foot4 = '</center>'
            $('#finalcands').append(s1)
            $('.openhr2').append(foot1+foot2+foot3+foot4)
        }
      
      
        $('#modal6').modal({
          dismissible: false,
          backdrop: "static"
        });
       
        $("#modal6").modal('open')
       
       
      }


                
    })
  // $("#modal6").modal("open")
}

// Function for round Completion (AD)
$('#completeinvprocess').click(function()
{
  console.log("This is complete");
  $('#modal8').modal({
          backdrop: "static"
        });
  $("#modal8").modal("open")

})
function terminateround(id,status)
{
  // hiddenID
  console.log("My ID",id)
  if(status !=false)
  {
    if(finalselectionmail.length <= 0 && counter == 1)
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
       $('#allocation3').css("display","block")
       $('#hiddenID').attr('value', id);
       console.log("this is ")
    }
  }
  else
  {
     $('#hiddenID').attr('value', id);
    $('#modal8').modal({
          backdrop: "static"
        });
      $("#modal8").modal("open")
  }

    
}

finalselectionmail = []
finalselectionmailID = []

function completeProcess(cnfrm)
{
  console.log("Complete")

  if(cnfrm)
  {
    // id=id.split('/')
    // id = id[0]+'-'+id[1]+'-'+id[2]+'-'+id[3]
    var id  = $("#hiddenID").val();
    console.log("This is prf - "+id)
    
    // $("#waiting").fadeIn(600);
   
    var hr2name = ($('#hr2name').val())?$('#hr2name').val():"na";
    var hr2dept = ($('#hr2dept').val())?$('#hr2dept').val():"na";
    var hr2desg = ($('#hr2desg').val())?$('#hr2desg').val():"na";
    var hr2mail = ($('#hr2mail').val())?$('#hr2mail').val():"na";
    console.log("HR Name - ",hr2name)
    var allmembers = window.finalmembers
    for(i=0;i<allmembers.length;i++)
    {
      console.log("This is member  - ",allmembers[i])
    }
    console.log("Final member lenght - ",finalselectionmail.length)
  
          // $('#allocation2').hide(600);
          if(hr2mail != "" && hr2name != "" && hr2dept != "" && hr2desg != "")
          {
            console.log("Thuis si ")
            // $("#pleasewait").fadeIn(600);
            $('#loader').show();
            // $('#allocation2').hide(600);
          
            $.ajax({
            url:'http://localhost/hrms/api/terminateround.php',
            type:'POST',
            data:{
              "allmembers":allmembers,
              "emails":(finalselectionmail.length==0)?'nomail':finalselectionmail,
              "hr2name":hr2name,
              "hr2mail":hr2mail,
              "prf":id,
              "hr2desg":hr2desg,
              "hr2dept":hr2dept
            },
            success:function(para)
            {
              // alert(para)
              // $("#waiting").hide();
               $('#loader').hide();
              console.log("This is : ",para)
              if(para == "nomails")
              {
                
                window.setTimeout(function(){location.reload()},1000)
              }
              if(para=="sent")
              {
                $('#sentsuccess').fadeIn(600)
                $('#sendingmail').hide()
                window.setTimeout(function(){location.reload()},1000)
    
                finalselectionmail = []
              }
              else
              {
                alert("Mail was not sent.")
                $('#sendingmail').hide()
                window.setTimeout(function(){location.reload()},1000)

              }
              console.log((para))
              // $(str).remove();

            }


                      
          })
          
          }
          else
          {
            console.log("This sis else")
          }
    


   
  }
  else
  {
    finalselectionmail=[]
    finalselectionmailID=[]

  }
  
}



// Function for inv assignment

$('#allocatesubmit').click(function()
{
  $("#modal3").modal("open")
})  


function allocateSubmit(cnfrm)
{
  if(cnfrm)
  {
    $("#waiting").fadeIn(600);

  console.log("dept - ",window.dept)
  console.log("zone - ",window.zone)
  var groupid=window.groupid
  var iname = $('#iname').val();
  var idept = $('#idept').val();
  var idesg = $('#idesg').val();
  var imail = $('#imail').val();
  var iloc = $('#iloc').val();
  var iperson = $('#iperson').val();

  $('#allocation').hide(600);
  if(imail != "" && iname != "" && idept != "" && idesg != "" && iperson != "" && iloc != "")
  {
    $('#allocation').hide(600);
    $("#pleasewait").fadeIn(600);
    $('#accept').show();
    for(let i=0;i<selectedmailID.length;i++)
    {
      var b = selectedmailID[i]
      b = b+'date'
      b2 = b+'2'
      console.log(b)
      console.log(b2)
      selecteddate.push($(b).val()) 
      selecteddate2.push($(b2).val()) 
      console.log("Email:",selectedmail[i]) 
      console.log("Time:",selecteddate[i])
      console.log("Date:",selecteddate2[i])
    }
    $.ajax({
    url:'http://localhost/hrms/api/interviewerongoing.php',
    type:'POST',
    data:{
          "emails":selectedmail,
          "cantimes" : selecteddate,
          "candates" : selecteddate2,
          "iname":iname,
          "intvmail":imail,
          "prf":groupid,
          "iloc":iloc,
          "iperson":iperson,
          "idesg":idesg,
          "dept":idept,
          "posdept":window.dept,
          "poszone":window.zone
        },
    success:function(para){
      console.log(para);
      $('#accept').hide();
      $('#sentsuccess').fadeIn(600)

      for(let i=0;i<selectedmail.length;i++)
      {
        var ml = selectedmail[i];
        var id = allmail.indexOf(ml) 
        var str='#check'+id+'row';
        $(str).remove();
        $("#waiting").hide();
      }
      selectedmail = []
      selecteddate = []
      selecteddate2 = []
      selectedmailID=[]

    }
    })
  }
  }
  
}


function finalselection(id)
{
  var b = '#'+id
  var y ='#'+id+'mail'  
  if($(b).prop("checked") == true)
  {
    finalselectionmail.push($(y).text())
    finalselectionmailID.push(b)
    console.log('mail:'+finalselectionmail)
    console.log('ID:'+finalselectionmailID)
  }
  else
  {
    for( var i = 0; i < finalselectionmail.length; i++)
    { 
      if ( finalselectionmail[i] === $(y).text()) 
      {
        finalselectionmail.splice(i, 1); 
        finalselectionmailID.splice(i, 1)
        i--;
      }
    }
    console.log(finalselectionmail)
    console.log(finalselectionmailID)
  }
}

var ctr=0
function selection(x)
{
  $('#submit').attr('disabled',false)
 

  var b = '#'+x
  var y ='#'+x+'mail'  
  if($(b).prop("checked") == true)
  {
    // console.log("Value of first - "+$(b+"date2").val())
    // // if($(b+"date").val() !="" && $(b+"date2").val() !="" )
    // // {
    // // $('#completeprocess').attr('disabled',false)
    // //     // $(b).prop("checked")=false
    // //     // alert("Date not entered");
       selectedmail.push($(y).text())
       selectedmailID.push(b)
      console.log('mail:'+selectedmail)
      console.log('ID:'+selectedmailID)
    // }
    // else
    // {
    //   $(b).prop("checked",false)
    //   alert("Date not entered");
    // }
    $('#completeprocess').attr('disabled',false)
  }
  else
  {                                            
    for( var i = 0; i < selectedmail.length; i++)
    { 
      if ( selectedmail[i] === $(y).text()) 
      {
        selectedmail.splice(i, 1); 
        selectedmailID.splice(i, 1)
        i--;
      }
    }
    console.log(selectedmail)
    console.log(selectedmailID)
  }
}


function sendforhistory()
{
  con = confirm("Are You Sure ?")
  if(con == true)
  {
    $.ajax({
      url:'http://localhost/hrms/api/sendforhistory.php',
      type:'POST',
      data:{
            "prf" : groupid
          },
      success:function(para)
      {
        console.log(para)
        if(para == "success")
        {
          document.location.reload();
        }
        else
        {
          alert("Some Error Occured")
        }
      }
    })
  }
}

var id_round
function createnextround(id)
{
  
  id = id.split("/")
  console.log("This is my - "+id[0])
  window.dept = id[4]
  window.zone = id[5]
  window.prf = id[0]
  window.iid = id[2]
  window.rid = id[3]
  console.log("Department : "+id[4])
  console.log("Zone : "+id[5])
  id = id[0]+"-"+id[1]+"-"+id[2]+"-"+id[3]

  $('#adddetail').text('')
  // alert(id)
  id_round = id
  window.groupid=id_round;
  $('#allocatingcandidate').fadeIn(600);
  var p1='<b>ID:'+id_round+'<b>'
  $('#rid').replaceWith(p1)
  console.log(" ID  = ",id_round)
  $.ajax({
    url:'http://localhost/hrms/api/nextround.php',
    type:'POST',
    data:{
          "prf" : id_round
         },
         
    success:function(para)
    {
      // alert(para)
      console.log(para)  
      para = JSON.parse(para)
      
      window.allmembers = para

      console.log("Array = ",para)
      if(para=="")
      {
        $("#completeprocess").hide()
        $("#completeprocess2").show()
        var s5='<b style="color: red;font-size:15px;" id="noselected"> There are no candidates selected for this process. Please complete this process to know about the candidates which are on hold and rejected</b><br><br>'
        $('#noselect').append(s5);
        counter=0;
        $('#completeprocess').attr('disabled',false)
        
        // alert("Empty")
      }
      else
      {
        var arr2 = []
        arr = para
        for(let i =0;i<para.length;i++)
        {
          allmail[i] = arr[i]
          var s1='<tr id="check'+i+'row">'
          var s2='<td><a href="http://localhost/hrms/documentcheck.php?aid='+arr[i][1]+'&prf='+window.prf+'&iid='+window.iid+'&rid='+window.rid+'&s=1" target="_blank" "><p >'+arr[i][0]+'</p></a></td>'
          var s3='<td><a href="http://localhost/hrms/documentcheck.php?aid='+arr[i][1]+'&prf='+window.prf+'&iid='+window.iid+'&rid='+window.rid+'&s=1" target="_blank" "><p id="check'+i+'mail">'+arr[i][1]+'</p></a></td>'
          
          var s9='<td><p style="color:black">'+arr[i][4]+'</p></td>'
          var s10='<td><p style="color:black">'+arr[i][3]+'</p></td>'
          
          var s4='<td><p >'+arr[i][2]+'</p></td>'
          if(arr[i][2] == "Selected")
          {
            var s5='<td><input id="check'+i+'date" class="timepicker" ></td>'
            var s6 ='<td><input id="check'+i+'date2" class="datepicker" ></td>'
            var s7='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
            var s8='<span class="blue-text darken-1" ></span></label></td></tr>'
          
          }
          else
          {
            var s5='<td><b>NA</b></td>'
            var s6 ='<td><b>NA</b></td>'
            var s7='<td><b>NA</b></td>'
            var s8='</tr>'
          }
          var str=s1+s2+s3+s9+s10+s4+s5+s6+s7+s8
          $('#adddetail').append(str)
          $('.timepicker').timepicker();
          $('.datepicker').datepicker();
        }
      }
      // alert(para.length)
      // para=['shoaibshaikh@mitaoe.ac.in','Atharva@mitaoe.ac.in','tanny@mitaoe.ac.in']
      
    }
  })
  $(document).scrollTop($(document).height());

}

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
