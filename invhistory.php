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
    if($designation == "inv" || $designation == "ceo" || $designation == "hod" || $designation == "rghead" )
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.css">
  <link rel="stylesheet" type="text/css" media="screen" href="./public/css/materialize.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>
<style>
@media screen and (min-width: 800px)
{
  #firsttb{
width: 100%;
}
#deptchoice{
  width: 19%;
} 

#zonechoice{
  width: 19%;
}

}

@media screen and (max-width: 800px)
{
#firsttb{
width: 350%;
}
#deptchoice{
  width: 70%;
} 

#zonechoice{
  width: 70%;
}

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
        
        <center><h2>No Data Avilable</h2></center>
        
        </div>
        <div class="modal-footer">
        <center>
        <a class="modal-close waves-effect green btn" href="http://localhost/hrms/invdash.php" >OK<i class="material-icons left" >check_box</i></a>
        </center>
        </div>
    </div>
<!-- no data modal ends here -->
<div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

<h3 class="w3-bar-item white"> <center><a href="/hrms/">Home</a>
<i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
</a></h3> <br><br>

<a href="/hrms/" class="w3-bar-item w3-button">To Do List <span class="new badge green" data-badge-caption="New Task(s)" id="badge_todo">4</span></a> <br>  
<a href="/hrms/invhistory.php" class="w3-bar-item w3-button">See History  </a> <br>  
<a href="/hrms/rejecedinvhistory.php" class="w3-bar-item w3-button">Rejected Interviews</a> <br>
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
      <br><br>
 <div class="row" id="firsttb">
<div class="col s12 blue lighten-4">
  <table class="striped">
    <thead>
      <tr>
          
          
          <th>PRF</th>
          <th>Position Details</th>
          <th>Zone</th>
          <th>Department</th>
          <th>No. of Positions</th>
          <th>Round</th>
          <th>IID</th>
          <th>Date</th>
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>

      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>


     
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
</style>
  
<script src="public/js/common.js"></script>

<script>
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
    document.location.replace("/hrms/")
    }
    } 
    
    })
    
    });
      //   $('#rejected').hide()
      // $('#hold').hide()
      // $('#mytabs').hide()

//     $('.tabs').tabs();
//    $('#roundchoice').hide();    

// $('#emailcollection').hide();
// $('#submitmail').hide();
// $('#groupcreated').hide()
// $('#groupnotcreated').hide()
// $('#creatinggrp').hide()

// $('#select').click(function(){
//         $('#rejected').hide()
//         $('#hold').hide()

//       $('#selected').show()
  
//     })



    
    // $('#reject').click(function(){
        
    //   $('#hold').hide()

    //   $('#selected').hide()
    //   $('#rejected').show()
  
    // })
    


    
    // $('#hld').click(function(){
    //     $('#rejected').hide()
     

    //   $('#selected').hide()
    //   $('#hold').show()
  
    // })
// var id;
// var flag0 = 0

// function xyz(x)
// {
//   roundid = x
//       console.log(roundid)
//       $('#tabledataselect').empty()

//       $.ajax({

//               url : 'http://localhost/hrms/api/getprfs2inv.php',
//               type : 'POST',
//               data : {'prf':roundid},

//               success:function(para)
//               {
//                 console.log("this is the data came from backeka;lksdjfl;askjdf : ",para)
                
//                 $("#select").click()
//               //  console.log( JSON.parse(para))
//               if(para != "no data")
//               {
//                 parseddata = JSON.parse(para)

//                 var element = parseddata[0].selected
//                 for (let i = 0; i < element.length; i++) {
//                   var str = "<tr><td><a href='http://localhost/hrms/documentcheckinv.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
//                   $('#tabledataselect').append(str)
                    
//                 } 

//                 var element = parseddata[0].rejected
//                 for (let i = 0; i < element.length; i++) {
//                   var str = "<tr><td><a href='http://localhost/hrms/documentcheckinv.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
//                   $('#tabledatareject').append(str)
                    
//                 } 

//                 var element = parseddata[0].hold
//                 for (let i = 0; i < element.length; i++) {
//                   var str = "<tr><td><a href='http://localhost/hrms/documentcheckinv.php?aid="+element[i]+"' target='_blank'>"+element[i]+"</td></tr>"
                  
//                   $('#tabledatahold').append(str)
                    
//                 } 

//               }

                
                
//                 $('#mytabs').fadeIn(900); 
//                 $('#select').click()
//                 flag0 = 1
//               },
//               error:function(err)
//               {

//               }
//               });



// $('#logoutuser').click(function(){

// $.ajax({
// url:"http://localhost/hrms/api/logout.php",
// type:"POST",
// success:function(para){

// if(para=="success")
// {
// $("#row").hide()
// $("#logout").show()
// document.location.replace("http://localhost/hrms/index.php")
// }
// else
// {
// $("#notlogout").show()
// document.location.replace("/hrms/")
// }
// } 

// })

// });

// j=x
//   // alert(id)
//   var res = j.split("*");
//   id='#'+res[0];
//   // alert("Here - "+res[0])
//   window.prf = res[0]
//   window.pos = res[1]
//   window.zone = res[2]
//   window.dept = res[3]
//   window.posno =res[4]
//   window.status = res[5]
//   $.ajax({
//     url : 'http://localhost/hrms/api/getinfo.php',

//     type:'POST',

//     data:{
//       'prf':window.prf,
//       'dept':window.dept,
//       'posdetail':window.pos,
//       'pos':window.posno,
//       'status':window.status
//     },
//     success : function(para)
//     {
//       if(para)
//       {
//           console.log(para)
//       }
//   }
// })
//   $(document).scrollTop($(document).height());
  // }
  var ctr = 0
function addText(x)
{
ctr = ctr+1
var str = 'email'+ctr
var txt="<div class='row'><div class='input-field col s4 offset-m4  blue-text' ><i class='material-icons prefix'>email</i>  <input id='"+str+"' onfocus='addText(this)' type='text' class='validate' placeholder='Enter Email'></div></div>"
$("#emailcollection").append(txt);
}
var arr=[]
$(document).ready(function(){

  // functionality for notifications start here
  $('#badge_todo').hide();
  // ajax call for getting notification details
  $.ajax({
      url:'http://localhost/hrms/demo.txt',
      type:'GET',
      success:function(para)
      {
          // dummy data : give notification count, if no new notification please give 0 ex todo:0
          para = {'todo':10} 
          if(para.todo > 0)
          {
              $('#badge_todo').text(para.todo);
              $('#badge_todo').show();
          }

      }
  })
  // functionality for notification ends here
  
  $('.modal').modal();
 $.ajax({
    url:'http://localhost/hrms/api/getprfs2inv.php',
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
        console.log("This is the data came from backend = ",para)
        console.log("this is length : "+para.length)
        for(let i=0;i<para.length;i++)
        { 
          var x='<tr id="rows"><td id="prf" value="'+para[i].prf+'">'+para[i].prf+'</td><td>'+para[i].posdetail+'</td><td>'+para[i].poszone+'</td><td>'+para[i].dept+'</td><td>'+para[i].position+'</td><td id="pos">'+para[i].rid+'</td><td id="posno">'+para[i].iid+'</td><td id="status">'+para[i].date+'</td><td id="status">'+para[i].members+'</td><td id="email">'+para[i].email+'</td><td id="statusevaluated">'+para[i].status+'</td></tr>'
          $('#rawdata').append(x);
        }
      }
       
     
     
    },
  })
  

})
</script>
</html>
 
<?php
            }
            else
            {
                header("refresh:0;url=notfound.html");
            }
        }
        else
        {
            header("refresh:0;url=notfound.html");
        }
    }
    else
    {
        header("refresh:0;url=notfound.html");
    }  
?>
       