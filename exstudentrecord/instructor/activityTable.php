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

    #add-btn{
      display: block;
      cursor: pointer;
      background-color: var(--light);
      border-radius: 1px;
      font-size: 1.0rem;
      font-weight: 600;
      background-size: 80% 80%;
      box-shadow: 0 0 0 7px var(--light) inset;
      margin-bottom: 5px;
      color: aliceblue;
      padding:2%;
      background-color: skyblue;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 30px;
      color: white;
      }

    #add-btn:hover{
      display: block
      background-color: #1e81b0;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 30px;
      color:white;
      margin-bottom: 5px;
    }

    #view-btn {
      display: block;
      width: 100%;
      background-color: #70D0D0;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
    }

    #edit-btn {
      display: block;
      background-color: #68CA70;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
    }

    #delete-btn {
      display: block;
      background-color: #CA6868;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-size: 14px;
      color: white;
      padding: 6%;
      margin-bottom: 5px;
    }

    #view-sub-btn {
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

    table, td{
    border: 2px solid #c9cad1;
    padding: 12px;
  }

  table{
    width:100%;
  }

  td,th{
    background-color: white;
  }
  #column{
    color: white;
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
<div>
    <h2>ACTIVITY</h2>
      <div class="wrapper">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Activities Management</h2>
                        <a href="create.php" class="btn btn-success pull-right" id="add-btn"><i class="fa fa-plus">
                        </i> Create New Activity</a>
                    </div>
                      <?php                      
                      // Attempt select query execution
                      require_once "../config.php";

                      $sql = "SELECT * FROM activity";
                      if($result = mysqli_query($link, $sql)){
                          if(mysqli_num_rows($result) > 0){
                            //Activity Management Table
                              echo '<table class="table table-bordered table-striped">';
                                  echo "<thead>";
                                      echo "<tr>";
                                          echo "<th id='column'>#</th>";
                                          echo "<th>Title</th>";
                                          echo "<th>Description</th>";
                                          echo "<th>Action</th>";
                                      echo "</tr>";
                                  echo "</thead>";
                                  echo "<tbody>";
                                  //fetches result from database
                                  while($row = mysqli_fetch_array($result)){
                                      echo "<tr>";
                                          echo "<td>" . $row['activity_id'] . "</td>";
                                          echo "<td>" . $row['activity_title'] . "</td>";
                                          echo "<td>" . $row['activity_description'] . "</td>";
                                          echo "<td>";
                                          //buttons toggle in all CRUD methods
                                              echo '<a href="viewActivity.php?id='. $row['activity_id'] .'" 
                                                  class="mr-3" title="View Activity" data-toggle="tooltip" id="view-btn">
                                                  <span class="fa fa-eye">View Activity</span>
                                                </a>';
                                              echo '<a href="update.php?id='. $row['activity_id'] .'" class="mr-3" 
                                                  title="Edit Activity" data-toggle="tooltip" id="edit-btn">
                                                  <span class="fa fa-pencil">Edit Activity</span>
                                                </a>';
                                              echo '<a href="delete.php?id='. $row['activity_id'] .'" 
                                                  title="Delete Activity" data-toggle="tooltip" id="delete-btn">
                                                  <span class="fa fa-trash">Delete Activity</span>
                                                </a>';
                                                echo '<a href="viewStudentSubmissions.php?id='. $row['activity_id'] .'" 
                                                  title="View Submission" data-toggle="tooltip" id="view-sub-btn">
                                                  <span class="fa fa-trash">View Submissions</span>
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
              </div>        
          </div>
      </div>
  </div>
</body>
<script src="../js/scripts.js"></script>
</html>