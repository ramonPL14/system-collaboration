<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//calls data from these two attributes
$name = $_SESSION["name"] ;
$role = $_SESSION["role"] ;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Profile</title>

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
          margin: 0;
          padding: 0
      }

      .card_profile {
          width: 350px;
          background-color: #c9cad1;
          border: none;
          cursor: pointer;
          transition: all 0.5s;
          padding: 2%;
      }

      .name {
          font-size: 23px;
          font-weight: bold
      }

      .idd {
          font-size: 14px;
          font-weight: 600
      }

      .idd1 {
          font-size: 20px
      }

      .info {
          font-size: 22px;
          font-weight: bold
      }
      .info_basic{
        font-size: 13px;

      }

      .text span {
          font-size: 13px;
          color: #545454;
          font-weight: 500
      }

      .icons i {
          font-size: 19px
      }

      hr .new1 {
          border: 1px solid
      }

      .join {
        position: relative;
        left: 35%;
          font-size: 14px;
          color: #6e2222;
          font-weight: bold
      }

      .date {
          background-color: #ffffff
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
          <span class="material-icons-outlined" ><a href="../profile/Profile.php" style="background-color: transparent; text-decoration: none;">account_circle</a></span>
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
            <a href="../dashboard/index.php">
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
        <div class="main-title">
            <h2>PROFILE</h2>
        </div>
        <!--Profile- Student-->
        <div class="container mt-4 mb-4 p-3 d-flex justify-content-center" style="position: relative; left: 30%;"> 
          <div class="card_profile p-4"> <div class=" image d-flex flex-column justify-content-center align-items-center"> 
            <button class="btn btn-secondary"> 
              <img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" /></button> 
              <!--changes name assigned from the username logged in-->
              <span class="name mt-3"><?php echo $name; ?></span> 
          <div class="d-flex flex-row justify-content-center align-items-center gap-2">
            <!--changes names of role to the username who logged in--> 
            <span class="idd1"><?php echo $role; ?></span> 
            <span><i class="fa fa-copy"></i></span> 
          </div> 
         
          <div class=" px-2 rounded mt-4 date "> 
            <span class="join">Class 2022-2023</span> 
          </div> 
        </div> 
      </div>
      </div>
      <!-- End Main -->

    </div>

    <!-- Scripts -->
    <!-- Custom JS -->
    <script src="../js/scripts.js"></script>
  </body>
</html>