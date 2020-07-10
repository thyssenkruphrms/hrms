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
input[type="file"]
{
    display: none;
}
input[id="uan"]
{
    text-transform: uppercase;
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
                    <b>Upload Appointment Letter</b>
                    <div class="row">
                            <div class="input-field col s12" id="appoint">
                                    <label class="custom-file-upload">
                                            <a class="btn blue darken-1"> <input id="appletter" name="appletter" type="file" accept=".pdf" class="validate" required="" aria-required="true"/> <p id='letter1'>Appointment Letter</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>

                    <b>Upload Relieving Letter</b>
                    <div class="row">
                            <div class="input-field col s12" id="relieving">
                                    <label class="custom-file-upload">
                                            <a class="btn blue darken-1"> <input id="relletter" name="relletter" type="file" accept=".pdf" required="" aria-required="true"> <p id='letter2'>Relieving Letter</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>  
                    
                    <b>Current Company's Latest Letter Indicating Salary Breakup</b>
                    <div class="row">
                            <div class="input-field col s12">
                                    <label class="custom-file-upload" id="salrybreak">
                                            <a class="btn blue darken-1"> <input id="salarybreak" name="salarybreak" type="file" accept=".pdf" > <p id='letter3'>Salary Breakup Letter</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>
                                      
                    
                    <b>Past Three Months Pay Slip</b>
                    <div class="row">
                            <div class="input-field col s12">
                                    <label class="custom-file-upload" id="pastslip">
                                            <a class="btn blue darken-1"> <input id="pastpayslip" name="pastpayslip" type="file" accept=".pdf" > <p id='letter4'>Pay Slip</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>
                    
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="uan" name="uan" type="text" class="validate" required="" aria-required="true" onchange=this.value.toLocaleUpperCase();>
                                    <label for="uan">UAN</label>
                                  </div>            
                    </div><br>


                    <b>Cancelled Cheque</b>
                    <div class="row">
                            <div class="input-field col s12">
                                    <label class="custom-file-upload">
                                            <a class="btn blue darken-1"> <input id="cancelcheck" name="cancelcheck" type="file" accept=".pdf" > <p id='letter5'>Cancelled Cheque</p></a>
                                    </label>
                            </div>                        
                    </div><br><br>


                    <b>Name of Nominnes</b>
                    <div class="row">
                            <div class="input-field col s6">
                                    <input id="nom1" name="nom1" type="text" required="" aria-required="true">
                                    <label for="nom1">Nominne 1</label>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom2" name="nom2" type="text" required="" aria-required="true">
                                    <label for="nom2">Nominne 2</label>
                            </div>

                            <div class="input-field col s6">
                                    <input id="nom3" name="nom3" type="text" required="" aria-required="true">
                                    <label for="nom3">Nominne 3</label>
                            </div>  

                            <div class="input-field col s6">
                                    <input id="nom4" name="nom4" type="text" required="" aria-required="true">
                                    <label for="nom4">Nominne 4</label>
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
                        alert(para)
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
$('#appletter').change(function(){
      
        var x = $('#appletter').val().split('.')
        var fileex=x[1]
        if(fileex=='pdf' || fileex=='jpeg'|| fileex=='jpg'|| fileex=='png')
        {
           
                var f = $('#appletter').val()
                $('#letter1').text(f)     
        }
        else
        {
                alert("Invalid File")
        }
        // if($.inArray(ext,['gif','jpeg','pdf'])==-1)
        // {
        //         alert("Invalid")
        // }
})

$('#relletter').change(function(){
        var x = $('#relletter').val().split('.')
        var fileex=x[1]
        if(fileex=='pdf' || fileex=='jpeg'|| fileex=='jpg'|| fileex=='png')
        {
           
                var f = $('#relletter').val()
                $('#letter2').text(f)     
        }
        else
        {
                alert("Invalid File")
        }        
     
})


$('#salarybreak').change(function(){
        var x = $('#salarybreak').val().split('.')
        var fileex=x[1]
        if(fileex=='pdf' || fileex=='jpeg'|| fileex=='jpg'|| fileex=='png')
        {
           
                var f = $('#salarybreak').val()
                $('#letter3').text(f)     
        }
        else
        {
                alert("Invalid File")
        }

   
})


$('#pastpayslip').change(function(){
        var x = $('#pastpayslip').val().split('.')
        var fileex=x[1]
        if(fileex=='pdf' || fileex=='jpeg'|| fileex=='jpg'|| fileex=='png')
        {
           
                var f = $('#pastpayslip').val()
                $('#letter4').text(f)     
        }
        else
        {
                alert("Invalid File")
        }        

})

$('#cancelcheck').change(function(){
        var x = $('#cancelcheck').val().split('.')
        var fileex=x[1]
        if(fileex=='pdf' || fileex=='jpeg'|| fileex=='jpg'|| fileex=='png')
        {
           
                var f = $('#cancelcheck').val()
                $('#letter5').text(f)     
        }
        else
        {
                alert("Invalid File")
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