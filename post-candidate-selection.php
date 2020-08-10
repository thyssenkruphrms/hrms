<?php
session_start();
$_SESSION['mailid'] = $_GET['token'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>thyssenkrupp</title>
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="public/jquery-3.2.1.min.js"></script>

    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    
    
</head>
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
  font-size:25px;
  color:lightskyblue;
  margin-left:33% !important;
  margin-top:18% !important; 
}

input[id="uan"]
{
    text-transform: uppercase;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}       

</style>
<body>
    <nav id="namethy">
        <div class="nav-wrapper blue darken-1">
            <a href="#!" class="brand-logo center">thyssenkrupp Elevators</a>
        </div>
    </nav>

    <!-- details submitted warning starts here -->
        <div class="row" id="details">
                <div class="col s12 m6 offset-m3">
                        <div class="card white">
                                <div class="card-content ">
                                        <center><i class="material-icons large" style="color: green;">check_circle</i></center>
                                        <center><h1><p  style="color:green">Details Submitted Successfully.</p></h5></center>
                                </div>
                        </div>
                </div>
        </div>
    <!-- details submitted warning ends here -->
    
    <form id="myForm" method="POST" action="http://localhost/hrms/api/submitevalform.php" enctype="multipart/form-data">
    
    <div class="row">
        <div class="col s12 m6 offset-m3">
            <div class="card white">
                <div class="card-content blue-text darken-1" id="main">
                    <form action="#">
                    <b>Upload Latest Company Appointment Letter</b>
                    <div class="row">
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Appointment Letter</span>
                                                <input id="appletter" name="appletter" type="file"  required accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>                             
                    </div>

                    <!-- <b>Upload Relieving Letter</b>
                    <div class="row">
                            <div class="input-field col s12" id="relieving">
                                    <label class="custom-file-upload">
                                            <a class="btn blue darken-1"> <input id="relletter" name="relletter" type="file" accept=".pdf" required="true" aria-required="true"> <p id='letter2'>Relieving Letter</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>   -->
                    
                    <b>Current Company's Latest Letter Indicating Salary Breakup</b>
                    <div class="row">  
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Salary Breakup Letter</span>
                                                <input id="salarybreak" name="salarybreak" type="file"  required accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>                                                   
                    </div>
                                      
                    
                    <b>Past Three Months Pay Slip</b>
                    <div class="row">
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                        <span>Past Pay Slip</span>
                                                <input id="pastpayslip" name="pastpayslip" type="file"  required accept=".pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div> 
                     </div>
                    
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="uan" name="uan" type="text" class="validate" maxlength="12" required="" aria-required="true" onkeypress="return validuan(event)" onchange=this.value.toLocaleUpperCase();>
                                    <label for="uan">UAN</label>
                                  </div>            
                    </div>


                    <b>Cancelled Cheque</b>
                    <div class="row">
                            <div class="file-field input-field">
                                                <div class="btn blue darken-1">
                                                        <span>Cancelled Cheque</span>
                                                        <input id="cancelcheck" name="cancelcheck" type="file"  required accept=".pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                </div>
                                </div>                       
                    </div>


                    <b>Name of Nominnees</b>
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="nom1" name="nom1" type="text" required="" aria-required="true" onkeypress="return mytextvalid(event)">
                                    <label for="nom1">Nominnee 1</label>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom2" name="nom2" type="text" required="" aria-required="true" onkeypress="return mytextvalid(event)">
                                    <label for="nom2">Nominnee 2</label>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom3" name="nom3" type="text" required="" aria-required="true" onkeypress="return mytextvalid(event)">
                                    <label for="nom3">Nominnee 3</label>
                            </div>  

                            <div class="input-field col s6">
                                    <input id="nom4" name="nom4" type="text" required="" aria-required="true" onkeypress="return mytextvalid(event)">
                                    <label for="nom4">Nominnee 4</label>
                            </div>                      
                    </div>

                        <div class="row">
                                <div class="col s12">
                                <b style="font-size:15px;color:red">Please Upload all Documents until Highest Qualification</b>
                                        <div class="file-field input-field">
                                                <div class="btn blue darken-1">
                                                        <span>Upload Documents</span>
                                                        <input id="alldocs" name="alldocs" type="file"  required accept=".pdf">
                                                </div>
                                                <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text">
                                                </div>
                                        </div>
                                </div>
                        </div>


                        <b style="font-size:15px;">Upload your Aadhar Card as Proof Of Identity</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="proof_identity_addhar" name="proof_identity_addhar" type="file" accept=".png, .jpg, .jpeg, .pdf" required>
                                        </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>


                        <div id="uploadotherdoc">
                        <b style="font-size:15px;">Proof Of Identity(PAN/Voter ID/Driving Licence/Passport)</b>
                                <div class="file-field input-field">
                                        <div class="btn blue darken-1">
                                        <span>Upload File</span>
                                                <input id="proof_otherthanadhar" name="proof_otherthanadhar" type="file" accept=".png, .jpg, .jpeg, .pdf">
                                        </div>
                                        <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text">
                                        </div>
                                </div>
                        </div>


                        <b style="font-size:15px;">Proof Of Address(Rent Agreement/Voter ID/Driving Licence/Passport)</b>
                        <div class="file-field input-field">
                                <div class="btn blue darken-1">
                                <span>Upload File</span>
                                        <input id="proof_address" name="proof_address" required type="file" accept=".png, .jpg, .jpeg, .pdf">
                                </div>
                                <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                </div>
                        </div>
                     

                        <div class="row">
                                        <div class=" col s6 offset-s3 center" id="submitform">
                                        <!-- id="submitformdata" -->
                                              <button class="btn blue darken-2" id="submitbtn" type="submit" name="action" >Submit
                                                <i class="material-icons right">send</i>
                                              </button>
                                        </div>                                    
                                </div>        
                        </form>           
                </div>
                <div id="postsubmit">

                </div>


            </div>
        </div>

</form>
<div id="loader">
        <div id="txt">
                <b>Please wait while we submit your form !!</b>
        </div>
</div>

<script>

$("#myform").submit(function(){
        
        $('#loader').show()
        window.location.href="documentsubmittedsuccesfully.html"

})

function validuan(e)
{
        //Written by Tanmay
        var charCode = event.keyCode;  
        //Gets ASCII code of character
        if ((charCode >= 48 && charCode <=57))
                return true;
        else
                return false;                        
}


function mytextvalid(e)
{
        //Written by Tanmay
        var charCode = event.keyCode;
        //Gets ASCII code of character
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)
                return true;
        else
                return false;

}

$(document).ready(function(){
        $("#details").hide();
        $("#loader").hide()
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
                vars[key] = value;
            });
            return vars;
        }
        var token = getUrlVars()["token"];
        var expiry = getUrlVars()["explink"];
        var data={"token":token, "expdate":expiry};
       // console.log(token);
        $.ajax({
                url : 'http://localhost/hrms/api/checkExpiry2.php',
                type : 'POST',
                data :(data),          
                success : function(para){
                       // alert(para)
                if(para == "expired")
                {
                console.log("Expired Page");
                $('#main').hide()   
                $("#details").show();             
                }
                else if(para=='success')
                {
                console.log("You are welcome");
                }
                else if(para == "submitted")
                {
                $("#details").show();
                $('#main').hide()
                }
                },
                error : function(err){        
                }
                 });
                });


$("#postsubmit").hide();   
$("#details").fadeIn();


$('#alldocs').change(function(){
      var f = $('#alldocs').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("alldocs").value=null
      }
        
})


$('#proof_address').change(function(){
      var f = $('#proof_address').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_address").value=null
      }
        
})


$('#proof_otherthanadhar').change(function(){
      var f = $('#proof_otherthanadhar').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_otherthanadhar").value=null
      }
        
})


$('#proof_identity_addhar').change(function(){
      var f = $('#proof_identity_addhar').val().split('.')
      var x=f[1]
      if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
      {
        alert('Invalid File\n Only PDF/IMAGES accepted')
        document.getElementById("proof_identity_addhar").value=null
      }
})

$('#appletter').change(function(){
      
        var f = $('#appletter').val().split('.');
        var x=f[1]
        
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("appletter").value=null
        }
 })


$('#salarybreak').change(function(){
        var f = $('#salarybreak').val().split('.');
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("salarybreak").value=null
        }

   
})


$('#pastpayslip').change(function(){
        var f = $('#pastpayslip').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("pastpayslip").value=null
        }
  

})

$('#cancelcheck').change(function(){
        var f = $('#cancelcheck').val().split('.')
        var x=f[1]
        if(!(x=='pdf'||x=='jpeg'||x=='png'||x=='jpg'))
        {
                alert('Invalid File\n Only PDF/IMAGES accepted')
                document.getElementById("cancelcheck").value=null
        }   
 
})

var appletter
var relletter 
var uan
var salarybreak
var pastpayslip
var cancelcheck
var nom1
var nom2
var nom3
var nom4


// $('#submitformdata').click(function(){
//         var filepath = document.getElementById('appletter').value;
//         // alert(filepath)  
// appletter=$("#appletter").val();
// relletter=$("#relletter").val();
// uan=$("#uan").val();
// console.log(uan)
// pastpayslip=$("#pastpayslip").val();
// nom1=$("#nom1").val();
// nom2=$("#nom2").val();
// nom3=$("#nom3").val();
// nom4=$("#nom4").val();

// $.ajax({


//     url:'http://localhost/hrms/api/submitevalform.php',
//     type:"POST",
//     data:
//     {
//         "appletter":appletter,
//         "relletter":relletter,
//         "uan":uan,
//         "pastpayslip":pastpayslip,
//         "nom1":nom1,
//         "nom2":nom2,
//         "nom3":nom3,
//         "nom4":nom4,
//         "mail":token
//     },
//     success:function(para)
//     {
//             console.log("hello this is me : ",para)
//             if(para == "success" )
//             {
//                     alert("data entered");
//                     console.log("data entered")
//             }
//         //alert('yes')
//         var formsuccess="<h3 style='color:green;'>Form Submitted Successfully</h3>"
//         $("#main").hide();
//         $('#postsubmit').append(formsuccess) 
//         $('#postsubmit').fadeIn(300);
      
        
//     }
// })


// })



</script>
</body>
</html>