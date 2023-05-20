
<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/index.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, name, role, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $name, $role, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            $_SESSION["name"] = $name;      
                            $_SESSION["role"] = $role;   
                                           
                            if($role == "Instructor"){
                            // Redirect user to welcome page
                            header("location: ../instructor/activityTable.php");
                            }else{
                                header("location: ../student/studentActivitySubmission.php");
                            }
                        }else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link rel="stylesheet" href="loginDesign.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<style>
    body {
    margin: 0;
    padding: 0;
    background-color: #ffffff;
    height: 100vh;

    background-image: url('../img/buksu1.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
  }

  #login .container #login-row #login-column #login-box {
    margin-top: 30px;
    max-width: 600px;
    height: 320px;
    border: 1px solid #9C9C9C;
    background-color: #EAEAEA;
  }
  #login .container #login-row #login-column #login-box #login-form {
    padding: 20px;

  }
  #login .container #login-row #login-column #login-box #login-form #register-link {
    margin-top: -65px;
  }

  .header {
    overflow: hidden;
    background-image: linear-gradient(blue,skyblue);
    padding: 10px 5px;
  }
  
  .header a {
    float: left;
    text-align: center;
    padding: 6px;
    text-decoration: none;
    font-size: 18px; 
    line-height: 25px;
    border-radius: 4px;
  }
  
  .header a.logo {
      margin-top: 5px;
      font-size: 30px;
      font-weight: 700;
      color: white;
  }

  .header > .material-icon-outlined{
    font-size: 10px;
  }
  
</style>
<body>
    <!-- Header -->
<header class="header">
<a href="#default" class="logo"><img src= "../img/buksuLogo.png" width = "50" height = "50">  Bukidnon State University</a>
</header>
<!-- End Header -->

    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="login.php" method="post">
                            <h3 class="text-center" style ="color: rgb(29, 38, 154);">Login</h3>
                            <?php 
                                if(!empty($login_err)){
                                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                                }        
                            ?>
                            <div class="form-group">
                                <label for="username" style="color: gray;">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password" style="color: gray;">Password:</label><br>
                                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="invalid-feedback"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group" style=" margin-top: 12px;">
                                <center><input type="submit" name="submit" class="btn btn-primary" value="log in" id="button">
                            </div>
                            <center><p style ="margin-top: 12px;">Don't have an account? <a href="register.php">Sign up now</a>.</p><center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        
    </div>
</body>

<footer>

</footer>
</html>