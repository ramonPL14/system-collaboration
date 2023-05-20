<?php
// Include config file
require_once "../config.php";
// Initialize the session
session_start();
// Identify User is Student with id
$student_id = $_SESSION["id"] ;

//working js code in file
function console_log($output, $with_script_tags = true) {
  $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
  if ($with_script_tags) {
      $js_code = '<script>' . $js_code . '</script>';
  }
  echo $js_code;
}

//identify activity_id if student has file to send
if($_SERVER["REQUEST_METHOD"] == "POST"){
  if (count($_FILES) > 0) {
      if (is_uploaded_file($_FILES['studentFile']['tmp_name'])) {
          //associate file with name
          $name = $_FILES["studentFile"]['name'];
          $type = $_FILES["studentFile"]['type'];

          $fileData = file_get_contents($_FILES['studentFile']['tmp_name']);  

          console_log("test" . $fileData);
          //insert file and filetype in database with activity_id and student_id
          $activity_id = $_POST["activityId"] ;
          $sql = "INSERT INTO submission(submission_file, submission_filetype, submission_filename, activity_id, student_id) VALUES(?,?,?,?,?) ";
          $statement = $link->prepare($sql);
          $statement->bind_param('sssss', $fileData, $type, $name, $activity_id,  $student_id);
          $current_id = $statement->execute() or die("<b>Error:</b> Problem on File Insert<br/>" . mysqli_connect_error());
      }
  }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
   <!-- Open Sans Font -->
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../css/styles.css">

<style>
  * {
      box-sizing: border-box;
    }

  table{
    border: transparent;
    padding: 12px;
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
  }

  td,th{
    background-color: white;
  }

  th{
    text-align: center;
    background-color: #595eeb;
    border: 2px solid white;
  }

  tr, td{
    border: 2px solid #595eeb;
    border-radius: 5px;
  }

  input[type=submit]{
    background-color: #04AA6D;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
  }

  input[type=text]{
    display: none;
  }

  #download-btn{
    display: none;
  }

  h2 {display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
  }

  body {
    background-image: url('../img/buksu.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
  }

</style>
</head>

<body>
<div class="grid-container">

<!-- Header -->
<header class="header">
  <div class="menu-icon" onclick="openSidebar()">
    <span class="material-icons-outlined">menu</span>
  </div>
  
  <div class="header-right" style="position:relative; left: 90%;">
    <span class="material-icons-outlined"><a href="../profile/Profile.php" style="background-color: transparent; text-decoration: none;">account_circle</a></span>
  </div>
</header>
<!-- End Header -->

<!-- Sidebar -->
<aside id="sidebar">
  <div class="sidebar-title">
    <div class="sidebar-brand">
    <a href="#default" class="logo"><img src= "../img/buksuLogo.png" width = "90" height = "90"></a><br>BukSU
    </div>
    <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
  </div>

  <ul class="sidebar-list">
    <li class="sidebar-list-item">
      <a href="../student/studentActivitySubmission.php">
        <span class="material-icons-outlined">home</span> Home
      </a>
    </li>

    <li class="sidebar-list-item">
    <a href="../profile/Profile.php">
      <span class="material-icons-outlined">account_box</span> Profile
    </a>
  </li>

    <li class="sidebar-list-item">
      <a href="../login/logout.php">
        <span class="material-icons-outlined">logout</span> Logout
      </a>
    </li>
  </ul>
</aside>
<!-- End Sidebar -->

<!-- Main -->
<main class="main-container">
    <div>
    <h2>ACTIVITY</h2>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // Attempt select query execution
                        $sql = "SELECT * FROM activity";
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                //table of Student Activity Submission
                                echo '<table class="table table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            //echo "<th>#</th>";
                                            echo "<th>Activity Title</th>";
                                            echo "<th>Description</th>";
                                            echo "<th>File</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            //echo "<td>" . $row['activity_id'] . "</td>";
                                            echo "<td style='text-align:center; '>" . $row['activity_title'] . "</td>";
                                            echo "<td>" . $row['activity_description'] . "</td>";
                                            //para maguwas ang table for submission 
                                            //gets submission related to student
                                            //readies activity_id and submission_id for the submission table
                                            $sqlGetStudentSubmission = "SELECT * FROM submission where activity_id=" .  $row['activity_id'] . " 
                                              AND student_id =" . $student_id ;

                                            //link database
                                            if($studentSubmissionResult = mysqli_query($link, $sqlGetStudentSubmission))
                                            {
                                              //checks if submission file exists
                                              $studentSubmissionFileRows = mysqli_fetch_array($studentSubmissionResult);
                                              if($studentSubmissionFileRows == null)
                                              {
                                                echo "<td>" . "No submission" . "</td>";
                                              }
                                              else
                                              {
                                                //prepares to take file
                                                echo "<td>" . $studentSubmissionFileRows['submission_filename'] . "</td>";
                                              }
                                            }
                                            else
                                            {
                                              //if no file exists
                                              echo "<td>" . "No submission" . "</td>";
                                            }    
                                            echo "<td>";

                                            if($studentSubmissionFileRows == null && $row['activity_is_disabled'] == false){
                                                echo "<form action= '' method='POST' enctype='multipart/form-data'>";
                                                echo "<input type='text' name='activityId' value='" . $row['activity_id'] . "'/>";
                                                echo "<input type='file' name='studentFile' />";
                                                echo "<input type='submit'/>";
                                                echo "</form>";
                                              }

                                              echo "</td>";                                        
                                          echo "</tr>";
                                      }
                                    echo "</tbody>";                            
                                echo "</table>";
                                //Free result set
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                            }
                        } else{
                            echo "Oops! Something went wrong. Please try again later.";
                        }
    
                        // Close connection
                        mysqli_close($link);
                        ?>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</body>

<script src="../js/scripts.js"></script>
</html>