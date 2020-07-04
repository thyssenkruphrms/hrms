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
    <script src="public/css/view/csvupload.css"></script>

</head>

<body>
    <div id="sidenn" class="w3-sidebar blue w3-bar-block sidemenu" style="z-index: 1000;overflow-y:hidden">

        <h3 class="w3-bar-item white">
            <center>
                <a href="/hrms/">Home</a><i id="remin" class="material-icons" style="float: right;cursor: pointer;">close</i></center>
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

        <!-- card stars -->
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card white">
                    <div class="card-content blue-text">
                        <a class="btn red modal-trigger" href="#modal1" style="float:right;" id="mymodal">CSV FILE FORMAT</a>
                        <span class="card-title">Upload Dump</span>
                        <p>Upload csv dump here consisting of all the previous data.<br> Once the file is uploaded cannot be changed.
                        </p>

                        <form method="POST" id="myform" action="importExcel.php" enctype="multipart/form-data">


                            <div class="input-field col s12 offset-m4" id="uphoto">

                                <label class="custom-file-upload" id="prof">
<a class="btn blue darken-1">
<input id="uploadcsv" required type="file" accept=".csv" name="uploadcsv" onchange="readURL(this)"><p id='myfile0'> Select file<i class="material-icons right">open_in_browser</i> </p></a>
</label>
                                <br><br><br> &nbsp;&nbsp;&nbsp;
                                <button type="submit" class="btn blue darken-1" name="submit" id="submit" value="Upload"><i class="material-icons right">send</i>Upload</button>

                            </div>
                        </form>
                        <br><br><br><br><br>
                    </div>

                </div>
            </div>
        </div>
        <!-- card ends -->
    </div>

    <div id="loader">
        <div id="txt">
            <b>Please wait while we add entries to the system</b>
        </div>
    </div>


    <div id="modal1" class="modal" style="width:90%;">
        <div class="modal-content">

            <table style="border-radius:5px solid black;" class="white-text teal">
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

            </table>

        </div>
        <div class="modal-footer">
            <b class="red-text">Please ensure that the CSV file to be uploaded must have above columns only</b>
        </div>
    </div>

    <script src="public/js/common.js"></script>
    <!-- view Scripts -->
    <script src="public/js/view/csvupload.js"></script>

</body>

</html>
