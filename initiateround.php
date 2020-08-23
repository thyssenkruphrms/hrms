<?php
error_reporting(0);

if(isset($_COOKIE['sid']))
{
  include 'api/db.php';
  
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
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#loader > #txt{
  font-size:23px;
  color:lightskyblue;
  margin-left:31% !important;
  margin-top:18% !important; 
}

#notified {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.95)  url(loader2.gif)  no-repeat center center !important;
  z-index: 10000;
}
#notified > #txt{
  font-size:23px;
  color:lightskyblue;
  margin-left:31% !important;
  margin-top:18% !important; 
}
</style>


</head>
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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/hrdash.php">OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>
<!-- no data modal ends here -->

<!-- refresh data modal starts here -->
  <!-- Modal Structure -->
  <div id="refreshmodal" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>Please Wait Refreshing</h2></center>
      
    </div>

  </div>
<!-- refresh data modal ends here -->

<!-- modal 2 starts here -->
<div id="modal2" class="modal">
    <div class="modal-content">
      <center><i class="material-icons large " style="color: #ff5252;">error_outline</i></center>
      <br>
      
      <center><h2>Are You Sure ?</h2></center>
      <center><p>Interview Process Will Be Completed.You Can See These Members in Your History</p></center>
    </div>
    <div class="modal-footer">
      <center>
      <a onclick="allocateSubmit(true)" class="modal-close waves-effect green btn" >Confirm<i class="material-icons left" >check_box</i></a>
      <a onclick="allocateSubmit(false)" class="modal-close waves-effect red btn">Cancel<i class="material-icons left">highlight_off</i></a>
      </center>
    </div>
  </div>
<!-- modal 2 ends here -->

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
    <a href="http://localhost/hrms/" style="margin-left: 93%;" ><?php echo($name) ?></a>
 <select id="logout"class="dropdown-trigger btn blue darken-1" style="height:62px;width:30px;float:right;" >
  <option value="profile">Profile</option>
  <option value="logout">Logout</option>
</select> 
    </div>
</nav>
<br><br>
<!-- nav and side menu ended -->
                  

                  <br><br>

                  <div class="row">
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                            <table class="striped">
                                <thead>
                                  <tr>
                                  <th>PRF-POSITION-INSTANCE-ROUND</th>
                                      <th>Position Details</th>
                                      <th>Zone</th>
                                      <th>Department</th>
                                      <th>No. of Positions</th>
                                      <th>Initiate Round</th>
                                  </tr>
                                </thead>
                                <tbody id="addtr">
                                  
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <center id="nodata">
                  <b style="color:red">No Data Available..!!</b>
                  </center>
                  <center>
                  <b><p id="pleasewait" style="color:red">Updating Information Please Wait...</p></b>

                  </center>
                  <u><b id="nomems"  style="color:red;margin-left:30%;font-size:20px;cursor:pointer;"> Application Blank Not Submitted By The Members </b></u>
                  <br> <br>
                  <b id="expiry"  style="color:green;margin-left:35%;font-size:20px;cursor:pointer;"> Form Validity </b>

                  <div class="row">
                    <div class="col s5 offset-m3" id=showmembersdiv>
                  

                      <table class="stripped">
                      <thead>
                        <tr class="blue darken-1 white-text">
                          <br>
                          <th>Sr No.</th>
                          <th>Name</th>
                          <th>Email ID &nbsp;&nbsp; <button id="notify" class="waves-effect orange  btn">Notify candidates</button>
                        </tr>
                      </thead>
                      
                      <tbody id="memberstable">
                      </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="row" id="allocatingcandidate" >
                    <div class="col s12 m12">
                      <div class="card  white">
                        <div class="card-content blue-text">
                          <p id='rid'><b></b></p>
                          <div class="row" id="allocation" >
                            <div class="col s12 m12" style="border: solid 5p">
                              <div class="card white">
                              <div class="row">
                              <div class="input-field col s3 m3 " >
                              <select id='intchoice' class="dropdown-trigger btn blue darken-1 " onchange="feedvalue(this)">
                              <option value=""  style="color: white">Select Interviewer</option> </select></div></div>
                                <div class="card-content blue-text">
                                  <div class="row">
                                    <div class="input-field col s3 m3 " >
                                      Interviewer Name: <input id="iname" type="text" class="text">
                                     </div>           
                                    <div class="input-field col s3 m3" >
                                      Interviewer Mail Id: <input id="imail" type="text" required>
                                      </div> 
                                    <div class="input-field col s3 m3 " >
                                          Interview Location: <input id="location" type="text" class="text" required>
                                         </div>
                                        <div class="input-field col s3 m3 " >
                                        Contact Person Name:  <input id="contactperson" type="text" class="text" required>
                                          </div>
                                  </div>       
                                    <div class="row">
                                        <div class="input-field col s3 m3 " >
                                        Interviewer Department:  <input id="idept" type="text" class="text" required>
                                        </div>                                    
                                        <div class="input-field col s3 m3 " >
                                        Interviewer Designation:  <input id="idesg" type="text" class="text" required>
                                        </div>
                                       
                                        
                                    </div>          

                                
                                  <div class="row">
                                    <button class="btn waves-effect blue darken-1 col m3 s3 offset-m4" id='allocatesubmit'>Submit
                                    <i class="material-icons right">send</i>
                                    </button>
                                      
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <button class="btn waves-effect green" style="float:right;margin-bottom: 10px;" id="rfresh" onclick="getit()">Refresh</button>
                          
                          <table class="striped">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Mail ID</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Select</th>
                                <th class="btn blue darken-1" name="submit" id="submit" disabled>Assign Interviewer</th>
                                <th class="btn red" style="margin-left: 25px;" id="abort" onclick='$("#modal1").modal("open")'> Abort</th>
                                
                              </tr>
                            </thead>
                            <tbody id="adddetail">
                              
                                  <div id="temp">

                                  </div>
                              
                            </tbody>
                          </table>

                        </div>          
                      </div>
                    </div>
                  </div>
                  </div> 
                  <div id="loader">
                    <div id="txt">
                      <b>Please wait.. while we schedule this interview</b>
                    </div>
                  </div>
                  
                  <div id="notified">
                    <div id="txt">
                      <b>Sending a reminder mail to these candidates..</b>
                    </div>
                  </div>
    </div>        
                          
    <style>
    html{
    scroll-behaviour:smooth;

  }
    </style>
    <script src="public/js/common.js"></script>

<script>
$("#nomems").hide()
$("#expiry").hide()

var id_round = "0";
var selectedmail = []
var selectedmailID = []
var selecteddate = []
var selecteddate2 = []
var timearray=[]
var allmail = []
$(document).ready(function(){

  // functionality for notifications start here
  $('#badge_ongoing').hide();
  $('#badge_rescheduling').hide();
  $('#badge_letter').hide();
  // ajax call for getting notification details
  $.ajax({
    url:'http://localhost/hrms/api/getGeneralizedData.php',
    type:'GET',
    success:function(para)
    {
      // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
     // para = {'ongoing':10,'rescheduling':5,"offerletter":0} 
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
  $("#nomems").hide()
  $("#expiry").hide()
  $("#showmembersdiv").hide()
  $("#loader").hide()
  $("#notified").hide()
  
  $('.datepicker').datepicker();
  $('.timepicker').timepicker();
  $('.modal').modal();

  // $("#rfresh").click(function(){
  //   window.setTimeout(function(){location.reload()},1000)
  // })

  $("#nodata").hide()
  $("#pleasewait").hide();
  $.ajax(
    {
      url:'http://localhost/hrms/api/baserounds.php',
      type:'POST',
      success:function(para){
      if(para != "no data")
      {
       $("#nodata").hide()
       var arr =  JSON.parse(para)
       console.log(arr)
       
        for(let i =0;i<arr.length;i++)
        {
          var appended=arr[i].prf+"-"+arr[i].pos+"-"+arr[i].iid+"-"+arr[i].rid
          var appended2=arr[i].prf+"/"+arr[i].pos+"/"+arr[i].iid+"/"+arr[i].rid+"/"+arr[i].dept+"/"+arr[i].poszone;
          console.log(appended2)
          var s1='<tr id="'+appended+'row">'
          var s2='<td><b>'+appended+'</b></td><td>'+arr[i].position+'</td><td>'+arr[i].poszone+'</td><td>'+arr[i].dept+'</td><td>'+arr[i].pos+'</td>'
          var s4='<td><button class="waves-effect green  btn"  id="'+appended2+'" onclick="createnextround(this.id)">Initiate Round</button></td></tr>'
          var str=s1+s2+s4
           $('#addtr').append(str)
        }
      }
      
      else
      {
        $("#nodatamodal").modal("open");
        console.log("No Data Found")
        $("#nodata").fadeIn(400)
      }
      }
    });



  
  
  $('#allocation').hide();
  $('#allocatingcandidate').hide();

  //final assignment for interviwer,date and time  
  $('#submit').click(function(){
    
    // console.log("Length of selecteddate "+selecteddate.length)
    var iid=window.iid;
    if(selectedmail.length <= 0 )
    {
      alert("Please Select Atleast 1 Member")
    }
    else
    {
    for(let i=0;i<selectedmail.length;i++)
    {
     console.log(window.iid)
     
    }

    $('#allocation').show(600);
    $.ajax({
    url:'http://localhost/hrms/api/getinterviewers.php',
    type:'POST',
    success:function(para)
    { 
      para = JSON.parse(para)
      names=para.names
      console.log("this is para :",para)
      para=para.interviewers
      for(i=0;i<para.length;i++)
       {
         var str = '<option id="'+para[i]+'"  value="'+para[i]+'"  style="color: white">'+names[i]+'</option>'
          $('#intchoice').append(str);

       }
      

    }
  })

    }
  
  })

  $('#allocatesubmit').click(function(){
    $("#modal2").modal("open");

   

  })


})
//end of document.ready(function)   

function feedvalue(select){

 // console.log("selected "+id)
  var interviewer=select.options[select.selectedIndex].getAttribute("id");
  console.log(interviewer)
  if(interviewer!=" "){

    $.ajax({
    url:'http://localhost/hrms/api/getinterviewerDetails.php',
    type:'POST',
    data:{
      "interviewer":interviewer
    },
    success:function(para)
    { 
      para = JSON.parse(para)
      console.log("this is para :",para)
      para=para.interviewer
      document.getElementById("imail").value=interviewer
      document.getElementById("iname").value=para.name
      document.getElementById("idept").value=para.dept
      document.getElementById("idesg").value=para.dsg 
      

    }
  })














  }

  

}

function allocateSubmit(cnfrm)
{
  if(cnfrm)
  {
    var imail = $('#imail').val();
      var iname = $('#iname').val();
      var idept = $('#idept').val();
      var idesg = $('#idesg').val();
      var iloc = $('#location').val();
      var iperson = $('#contactperson').val();
      var posdept = window.dept
      var poszone = window.zone
      var candidatetime
    
      if(imail != "" && iname != "" && idept != "" && idesg != "" && iperson != "" && iloc != "")
      {
        $("#loader").show()
        $('#allocation').hide(600);
        $("#pleasewait").fadeIn(600);
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
        url:'http://localhost/hrms/api/interviewer.php',
        type:'POST',
        data:{
          //dept needed to be submitted
          'emails':selectedmail,
          'times':selecteddate,
          'dates':selecteddate2,
          'intv':imail,
          'prf':iid,
          'iname':iname,
          "idesg":idesg,
          "idept":idept,
          "iloc":iloc,
          "iperson":iperson,
          "dept":posdept,
          "poszone":poszone
          //"dept":"sales"

        },
        success:function(para){
          
          console.log("This is the para after interbiew = ",para)
          for(let i=0;i<selectedmail.length;i++)
            {
             var ml = selectedmail[i];
             var id = allmail.indexOf(ml) 
             var str='#check'+id+'row';
             
              $(str).remove();
              //document.location.reload();
              $("#pleasewait").hide();
              $("#loader").hide();
               window.setTimeout(function(){location.reload()},1000)

            }
            selectedmail = []
            selecteddate = []
            selecteddate2 = []
            selectedmailID=[]
        }
      })
      }
      else
      {
        alert("Please Fill All Data")
      }
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
    if($(b+"date").val() !="" && $(b+"date2").val() !="" )
    {
        // $(b).prop("checked")=false
        // alert("Date not entered");
        selectedmail.push($(y).text())
        selectedmailID.push(b)
        console.log('mail:'+selectedmail)
        console.log('ID:'+selectedmailID)
    }
    else
    {
      $(b).prop("checked",false)
      alert("Date not entered");
    }
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

//add interviewers



var id_round

function createnextround(id)
{
  $("#nomems").empty()
  
  // $('.timepicker').timepicker();
  window.iid=id;
  console.log(iid)
  id = id.split("/")
  id_round = id[0]+"-"+id[1]+"-"+id[2]+"-"+id[3]

  //dept zone added to database
  window.dept = id[4]
  window.zone = id[5]
  // console.log(zone)
  console.log(id_round)
  
  var p1='<b id="rid">ID:'+id_round+'<b>'
  $('#showmembersdiv').hide(); 
  $('#rid').replaceWith(p1);
  $.ajax({
    url:'http://localhost/hrms/api/baseroundmembers.php',
    type:'POST',
    data:{
          "id":id_round
         },
    success:function(para)
    {
      $('#allocatingcandidate').fadeIn(600);
      para = JSON.parse(para)
      var arr1=[]
      var toggle = 0   
      //  
      $("#nomems").click(function()
      {
        $("#memberstable").empty()
        if(toggle == 0)
        {
          toggle = 1
          $("#showmembersdiv").fadeIn(1200);
            for(let i=0;i<para[1];i++)
            {
              console.log("Members - "+para[2][i])
              j = parseInt(i)
              j += 1
              var membersdata='<tr><td>'+j+'</td><td>'+j+'</td><td>'+para[2][i]+'</td</tr>'
              $("#memberstable").append(membersdata)
            }
        }
        else
        {
          toggle = 0
          $("#showmembersdiv").fadeOut(100);

        }    
      })
      $("#notify").click(function()
      {
        $("#notified").show()
        console.log("Notified");
        $.ajax({
        url:'http://localhost/hrms/api/resendappblank.php',
        type:'POST',
        data:{
              "id":id_round,
              "emails":para[2]
            },
        success:function(para)
        {
          if(para == "success")
          {
              $("#notified").hide()
              window.setTimeout(function(){location.reload()},1000)
          }
          else
          {
              $("#notified").hide()
              window.setTimeout(function(){location.reload()},1000)
          }
        }
        })
      })
       console.log("this are base round mems  = ",para)

       if(para[0] == null)
       {
         $("#submit").hide()
         $("#abort").hide()
         $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
         $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }
       }
      else if(para[1] != 0)
      {
        $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
        $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }

      $('#adddetail').text("")
      var arr = para[0]
      // $('.timepicker').timepicker();
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name 1 - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="timepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="datepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
          
        var str=s1+s2+s3+s5+s4+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
        
      }
      
    }
    else
    {
      $("#nomems").hide()
 
 
      $('#adddetail').text("")
      var arr = para[0]
  
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="timepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="datepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
        var str=s1+s2+s3+s5+s4+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
      }
    }
    }
  })
  $(document).scrollTop($(document).height())   ;

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
        else
        {
          console.log("something went wrong")
        }
      } 
    })
  
  }

}

function getit(){
  
  var cutme = $('#rid').text();
  cutme = cutme.split(":");
  cutme = cutme[1];
  console.log(cutme)

  $("#nomems").empty()

  console.log("cutme   = = ",cutme)
  $('#showmembersdiv').hide()
  
  $("#refreshmodal").modal("open");
  $.ajax({
    url:'http://localhost/hrms/api/baseroundmembers.php',
    type:'POST',
    data:{
          "id": cutme
         },
    success:function(para)
    {
      $("#refreshmodal").modal("close");
      $('#allocatingcandidate').fadeIn(600);
      para = JSON.parse(para)
      var arr1=[]
      var toggle = 0   
      //  
      $("#nomems").click(function()
      {
        $("#memberstable").empty()
        if(toggle == 0)
        {
          toggle = 1
          $("#showmembersdiv").fadeIn(1200);
            for(let i=0;i<para[1];i++)
            {
              j = parseInt(i)
              j += 1
              var membersdata='<tr><td>'+j+'</td><td>'+para[2][i]+'</td</tr>'
              $("#memberstable").append(membersdata)
            }
        }
        else
        {
          toggle = 0
          $("#showmembersdiv").fadeOut(100);

        }    
      })
       console.log("this are base round mems  = ",para)

       if(para[0] == null)
       {
         $("#submit").hide()
         $("#abort").hide()
         $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
         $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }
       }
      else if(para[1] != 0)
      {
        $("#nomems").text("Application Blank Not Submitted By "+para[1]+" Member(s)")
        $("#nomems").show()

        if(para[3] == "expired")
        {
          $("#expiry").text("Form Expired")
          $("#expiry").show()
        }
        else
        {
          $("#expiry").text("After "+para[3]+" Day(s) Form Will Expire")
          $("#expiry").show()
        }

      $('#adddetail').text("")
      var arr = para[0]
      // $('.timepicker').timepicker();
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name 1 - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="datepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="timepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
          
        var str=s1+s2+s3+s4+s5+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
        
      }
      
    }
    else
    {
      $("#nomems").hide()
 
 
      $('#adddetail').text("")
      var arr = para[0]
  
      for(let i =0;i<arr.length;i++)
      {
        allmail[i] = arr[i];
        console.log("Name - ",allmail[i][0]);
        console.log("Email - ",allmail[i][1]);
        var s1='<tr id="check'+i+'row">'
        var s2='<td><a href="http://localhost/hrms/applicationblank_readonly.php?aid='+arr[i][1]+'"  target="_blank" ><p >'+arr[i][0]+'</p></a></td>'
        var s3 ='<td><p id="check'+i+'mail">'+arr[i][1]+'</p></td>'
        var s4='<td><input id="check'+i+'date" class="datepicker" ></td>'
        var s5 ='<td><input id="check'+i+'date2" class="timepicker" ></td>'
        var s6='<td><label><input type="checkbox" class="filled-in" id="check'+i+'" onclick="selection(this.id)">'
        var s7='<span class="blue-text darken-1" ></span></label></td></tr>'
        var str=s1+s2+s3+s4+s5+s6+s7
       
        $('#adddetail').append(str)
        $('.timepicker').timepicker();
        $('.datepicker').datepicker({
          minDate:new Date()
        });
      }
    }
    $('#expiry').hide()
    }
  })
}

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
