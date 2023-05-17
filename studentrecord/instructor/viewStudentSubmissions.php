<?php
  require_once "../config.php";
  session_start();

  $selectedActivityId = "";

  if(isset($_GET["id"]) && !empty(trim($_GET["id"])))
  { //id=activityId
    $selectedActivityId = trim($_GET["id"]);
    $_SESSION["submissionsActivityId"] = $selectedActivityId;
  } 
  else
  {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
  }
?>

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

<!-- Custom CSS -->
<link rel="stylesheet" href="../css/styles.css">

<style>
  * {
      box-sizing: border-box;
    }
    #submit-btn {
      display: block;
      background-color: #9668CA;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
    }

    #grade-btn {
      display: block;
      background-color: #9668CA;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
    }

    #back-btn {
      display: block;
      background-color: #9668CA;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding:2%;
      margin-top: 15px;
      margin-bottom: 5px;
    }

    #download-btn {
      display: block;
      background-color: #9668CA;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
      text-decoration: none;
    }
  table, td{
    border: 2px solid #c9cad1;
    padding: 12px;
    background-color: #c9cad1;
  }

  table{
    width: 100%;
  }

  td,th{
    background-color: white;
  }

body{
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
    <a href="#default" class="logo"><img src= "../img/buksuLogo.png" width = "90" height = "90"></a> BukSU
    </div>
    <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
  </div>

  <ul class="sidebar-list">
    <li class="sidebar-list-item">
      <a href="../instructor/activityTable.php">
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
      <h2>Students Who Submitted For Activity <?php echo $selectedActivityId ?></h2>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-7">
                        <?php
                        echo $selectedActivityId;
                        // Attempt select query execution
                        $sql = "SELECT * FROM submission where activity_id=" . $selectedActivityId .
                        " AND student_id IS NOT NULL";

                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-bordered table-striped" id="activityTable">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th style='display: none;'>#</th>";
                                            echo "<th style='display: none;'>Student ID</th>";
                                            echo "<th>Student STUDENT ID</th>";
                                            echo "<th>File</th>";
                                            echo "<th>Grade</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td style='display:none;'>" . $row['submission_id'] . "</td>";
                                            echo "<td style='display:none;'>" . $row['student_id'] . "</td>";
                                            echo "<td>" . $row['student_id'] . "</td>";
                                            echo "<td><a href='../download.php?id=" .  $row['activity_id'] . "' target='_blank' id='download-btn'"
                                                        . "Download". "</a>Download File</td>";                                       
                                            echo "<td>" . $row['grade'] . "</td>";  
                                            echo "<td>";
                                              echo '<a href="submitGrade.php?submission_id='. $row['submission_id'] .'" 
                                                  class="mr-3" title="Submit Grade" data-toggle="tooltip" id="submit-btn">
                                                  <span class="fa fa-eye" >Submit Grade</span>
                                                </a>';
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
                    <a href="activityTable.php" class="btn btn-secondary ml-2" id="back-btn">Back</a>
                </div>        
            </div>
        </div>
    </div>
</body>

<script src="../js/scripts.js"></script>
</html>