$(document).ready(function() {

    // functionality for notifications start here
    $('#badge_ongoing').hide();
    $('#badge_rescheduling').hide();
    $('#badge_letter').hide();
    // ajax call for getting notification details
    $.ajax({
            url: 'http://localhost/hrms/demo.txt',
            type: 'GET',
            success: function(para) {
                // dummy data : give notification count, if no new notification please give 0 ex offerletter:0
                para = {
                    'ongoing': 10,
                    'rescheduling': 5,
                    "offerletter": 0
                }
                if (para.ongoing > 0) {
                    $('#badge_ongoing').text(para.ongoing);
                    $('#badge_ongoing').show();
                }
                if (para.rescheduling > 0) {
                    $('#badge_rescheduling').text(para.rescheduling);
                    $('#badge_rescheduling').show();
                }
                if (para.offerletter > 0) {
                    $('#badge_letter').text(para.offerletter);
                    $('#badge_letter').show();
                }
            }
        })
        // functionality for notification ends here
    $(".modal").modal();

    console.log("Hello document");
    $("#loader").hide();
})

$("#myform").submit(function() {
    console.log("Hello")
    $('#loader').show()
})

function readURL(input) {
    var f = $('#uploadcsv').val().split('.')
    var x = f[1]
    if (x == 'csv') {
        var f = $('#uploadcsv').val()

        $('#myfile0').text(f)
    } else {
        alert('Invalid File\n Only CSV Files Accepted')
        $('#uploadcsv').val(" ")
    }
}
$('#logoutuser').click(function() {

    $.ajax({
        url: "http://localhost/hrms/api/logout.php",
        type: "POST",
        success: function(para) {

            if (para == "success") {
                $("#row").hide()
                $("#logout").show()
                document.location.replace("http://localhost/hrms/index.php")
            } else {
                $("#notlogout").show()
                document.location.replace("/hrms/")
            }
        }

    })

});