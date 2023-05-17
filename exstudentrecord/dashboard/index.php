<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$role = $_SESSION["role"];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Home</title>

    <!-- Open Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">

    <style>
        .class-button{
        cursor: pointer;
        background-color: transparent;
        color: #ffffff;
        font-size: 1.0em;
        text-decoration: none;
      }
      .class-button:hover{
        background-color: transparent;
        color:rgb(196, 196, 196);
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
            <span class="material-icons-outlined">send</span> SENT
          </div>
          <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
        </div>

        <ul class="sidebar-list">
          <li class="sidebar-list-item">
            <a href="#">
              <span class="material-icons-outlined">home</span> Home
            </a>
          </li>

          <li class="sidebar-list-item">
          <a href="../profile/Profile.php">
            <span class="material-icons-outlined">account_box</span> Profile
          </a>
        </li>

          <li class="sidebar-list-item">
            <a href="../login/logout.php" class="btn btn-danger ml-3">
              <span class="material-icons-outlined">logout</span> Logout
            </a>
          </li>
        </ul>
      </aside>
      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <!--Classes Student Point of View-->
        <div class="main-cards">

          <div class="card" style="position: absolute; box-shadow: 0 6px 7px -4px rgba(0, 0, 1, 1); padding-left: 35%; padding-right: 35%;">
            <div class="card-inner">
              <?php 
                if($role == "Student"){
                  echo "<a href='../student/studentActivitySubmission.php' class='class-button'>";
                }
                else if ($role == "Instructor"){
                  echo "<a href='../instructor/activityTable.php' class='class-button'>";
                }
              ?>
            </div>
            <h2> ACTIVITIES </h2>
            </a>
          </div>
        </div>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="../js/scripts.js"></script>
  </body>
</html>