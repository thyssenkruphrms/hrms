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
    
    if($designation == "hr" || $designation == "ceo")
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
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">

  <script src="./public/jquery-3.2.1.min.js"></script>
  
  <script src="./public/js/materialize.js"></script>
  <script src="./public/js/materialize.min.js"></script>
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
        font-size:23px;
        margin-left:23% !important;
        margin-top:18% !important; 
} 

@media screen and (min-width: 800px)
{
  #megblock, #selectedrow{
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
#megblock, #selectedrow{
width: 350%;
}


#fileformatmodal
{
  margin-top:5%;
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
      <a class="modal-close waves-effect green btn" href="http://localhost/hrms/ceodash.php" >OK<i class="material-icons left" >check_box</i></a>
      </center>
    </div>
  </div>

  <div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">
<!--    
<h3 class="w3-bar-item white"> <center><a href="http://localhost/hrms/">Home</a>
<i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>   
</a></h3> <br><br>-->
</div>

<div id="remin">
<nav> 
  <div class="nav-wrapper blue darken-1">
    <a href="#!" class="brand-logo left" style="margin-left: 2%;"><i id="showsidenbutton" class="material-icons">menu</i>
  </a>
  <a href="http://localhost/hrms/" class="brand-logo center">thyssenkrupp Elevators</a>
  </div>
</nav>
<br><br>
<!-- nav and side menu ended -->

 <div class="row" id="megblock">

<div class="col s12  blue lighten-4" >
  <table class="striped">
    <thead>
      <tr>
          <th>Role</th>
          <th>Name</th>
          <th>Mail</th>
          <th>Department</th>
          <th>Designation</th>
          <th>Region</th>
          <th>Update</th>
          <th>Delete</th>
          <!-- <th>Withdraw</th> -->
      </tr>
    </thead>

    <tbody id='rawdata'>
      
    </tbody>
  </table>
</div> 
</div>

<br>
          
<script>

// function for opening dialouge box
function openmodal(cid)
{
  $("#appending_id").empty()
  $("#appending_id").append("<b id='bid' name='"+cid+"'></b>")
  $("#modal2").modal("open")
}




$('#kindlybtn').hide();
$('#selectedrow').hide();


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

var id;

function xyz(x)
{

  $('#kindlybtn').show();
  $('#selectedrow').show();
  $("#ordiv").show();
  $(document.getElementById(x)).attr("disabled","disabled")
  j=x
  // alert(j)
  var res = j.split("*");
  id='#'+res[0];
  // alert("Here - "+res[0])
  window.prf = res[0]
  window.position = res[1]
  window.zone = res[2]
  window.dept = res[3]
  window.pos =res[4]
  window.status = res[5]
 
  console.log("position  - ",window.position );

 
  // <td id="oniid">one</td>
  //   <td id="onpos">one</td>
  //   <td id="onzone">one</td>
  //   <td id="ondept">one</td>
  //   <td id="onnpos">one</td>
  //   <td id="onsts">one</td>

    $("#oniid").html(res[0])
    $("#onpos").html(res[1])
    $("#onzone").html(res[2])
    $("#ondept").html(res[3])
    $("#onnpos").html(res[4])
    $("#onsts").html(res[5])

  // data = {'prf':prf,'dept':dept,'pos':pos,'zone':zone,'posno':posno,'status':status}
  // alert(window.prf)
  $('#dumpdiv').fadeIn();
  $('#submitmaildump').fadeIn();
  $('#emailcollection').fadeIn();
  $('#submitmail').fadeIn();
  $(document).scrollTop($(document).height());
  positionapp = encodeURIComponent(window.position.trim())
  // document.getElementById('forms').action = 'uploademails.php?prf='+window.prf+'&'+'position='+window.position+'&'+'pos='+window.pos+"&"+'dept='+window.dept;

  }
</script>



  
</body>
<style>
  html{
    scroll-behaviour:smooth;
  }
  input[type="file"]{
    display:none;
  }
</style>
<script src="public/js/common.js"></script>

<script>

function mymodalopen()
{
  
  $("#modal3").modal('open');
}

function deleteUser(){

  //  console.log("id: "+id);  
  var id=event.toElement.id
  var name=event.toElement.name
 // console.log(id+" "+name)

  
$.ajax({
url:"http://localhost/hrms/api/users.php",
type:"POST",
data:{

  "action":2,
  "mail":id,
  "username":name
},
success:function(para){

  console.log(para.status)
  if(para.status=="true"){
    console.log('inside me')
    location.reload().delay(5000);
  }
  

} 

})


}


 
var arr=[]
var dept=[]
$(document).ready(function(){

 
 $.ajax({
    url:'http://localhost/hrms/api/getallusers.php',
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
        console.log(para)
        //para=JSON.parse(para)
        // window.data=para
        // para=['1001','Developer','North','Sales','5','ongoing']
        console.log("this is length : "+para.users.length)
        para=para.users
        for(let i=0;i<=para.length;i++)
        {
          arr[i]=para[i];
          
        }
       
        for(let j=0;j<arr.length-1;j++)
        {
            var btnid=""+arr[j].email+"";
            var x='<tr id="rows" style=""><td id="uid" value="'+arr[j].uid+' id="'+arr[j].name+'>'+arr[j].uid+'</b></td><td id="name">'+arr[j].name+'</td><td id="zone">'+arr[j].mail+'</td><td id="dept">'+arr[j].dept+'</td><td id="posno">'+arr[j].dsg+'</td><td id="status">'+arr[j].rg+'</td>'
            var btns='<td><button id="'+(arr[j].email)+'"  class="btn green darken-1">Update</button></td>'+'<td ><button id="'+arr[j].mail+'" name="'+arr[j].name+'"  class="btn red darken-1" onclick="deleteUser()">DELETE</button></td></tr>'
            //var x="hi"
        $('#rawdata').append(x+btns);
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
       