<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="public/css/materialize.css">
    <link rel="stylesheet" href="public/css/materialize.min.css">


    <!-- Compiled and minified JavaScript -->
    <script src="public/js/materialize.js"></script>
    <script src="public/js/materialize.min.js"></script>
    <script src="public/jquery-3.2.1.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!-- for sidenav -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/common.css">
            
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    input[type="file"] {
    display: none;
    }
    </style>
</head>
<body>

<?PHP
// error_reporting(0);
function readCSV($csvFile){
    $file_handle = fopen($csvFile, 'r');
    while (!feof($file_handle) ) {
        $line_of_text[] = fgetcsv($file_handle,2024);
    }
    fclose($file_handle);
    return $line_of_text;
}

if(isset($_FILES))
{
    include 'db.php';
    $ctr = 0;
    // Set path to CSV file
    // $csvFile = 'test.csv';
    $csvFile = $_FILES['uploadcsv']['name'];
    $ctemp = $_FILES["uploadcsv"]['tmp_name'];
    move_uploaded_file($ctemp,"../users/".$csvFile);
    $csvFile = "../users/".$csvFile;

    $cursor = $db->session->findOne(array("sid" => $_COOKIE['sid']));
 
    $csv = readCSV($csvFile);
    // echo count($csv);
    $new = 0;
    for($i = 1; $i < count($csv); $i++)
    {
         
                        $val = array(              
                            "uid"=> $csv[$i][0]  ? $csv[$i][0]  :"null",
                            "name"=> $csv[$i][1]  ? $csv[$i][1]  :"null",
                            "password"=> $csv[$i][2]  ? $csv[$i][2]  :"null",
                            "mail" => $csv[$i][3]  ? $csv[$i][3]  :"null",
                            "dsg" => $csv[$i][4]  ? $csv[$i][4]  :"null",
                            "rg"=> $csv[$i][5]  ? $csv[$i][5]  :"null",
                            "dept"=> $csv[$i][6]  ? $csv[$i][6]  :"null",
                    );
                    
                    $result = $db->user->insertOne($val);
                    if($result)
                    {
                        $new = $new+1;
                    }
        
   
    }
 
  ?>
          <br><br><br><br><br>

<div class="row">
  <div class="col s12 m6 offset-m3">
      <div class="card white">
          <div class="card-content blue-text">
          <span class="card-title">Upload Dump Status : </span>
          <p>
          
          <br><br><br>

          <?php
    if($result)
    {
        echo "<center id='bwaiting'><h1>CSV Uploaded Successfully<br>".$new." New Entries Added</h1></center>";
        header("refresh:2;url=csvupload.php");
    }
    else
    {
        echo "<script>alert('Data Not Submitted. Please Reupload')</script>";
        // header("refresh:0;url=http://localhost/hrms/createusers.php");
    }
}
else
{
    echo "error";
}
?>

          </p>

          <br><br><br><br>
          </div>

      </div>
  </div>
</div>



</body>
</html>