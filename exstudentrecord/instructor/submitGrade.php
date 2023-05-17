<?php

session_start();
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$submission_grade = "";
$grade_err = "";
$title_err = "";

$activity_id = $_SESSION["submissionsActivityId"];
 
// Processing form data when form is submitted
if(isset($_POST["submission_id"]) && !empty($_POST["submission_id"])){
    // Get hidden input value
    $submission_id = $_POST["submission_id"];

    // Validate name
    $input_grade = trim($_POST["grade"]);
    if(empty($input_grade)){
        $grade_err = "Please enter a grade for student.";
    } elseif(!filter_var($input_grade, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^\d+$/")))){
        $grade_err = "Please enter a valid grade for student.";
    } elseif($input_grade < 69 || $input_grade > 100) {
        $grade_err = "Please enter only 69-100 for the grade.";
    } else {
        $submission_grade = $input_grade;
    }
    
    
    // Check input errors before inserting in database
    if(empty($grade_err)){
        // Prepare an update statement
        $sql = "UPDATE submission SET grade=? WHERE submission_id=?";
         

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_grade, $param_id);
            
            // Set parameters
            $param_grade = $submission_grade;
            $param_id = $submission_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: viewStudentSubmissions.php?id=" . $activity_id);
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} 
else
{
    // Check existence of id parameter before processing further
    if(isset($_GET["submission_id"]) && !empty(trim($_GET["submission_id"])))
    {
        // Get URL parameter
        $submission_id =  trim($_GET["submission_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM submission WHERE submission_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $submission_id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1)
                {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $submission_id = $row["submission_id"];
                    $student_id = $row["student_id"];
                    $submission_grade = $row["grade"];
                } 
                else
                {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    } 
    else
    {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Submit Grade for Student</h2>
                    <p>Please submit grade for student</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Grade</label>
                            <input type="text" name="grade" class="form-control <?php echo (!empty($grade_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $submission_grade; ?>">
                            <span class="invalid-feedback"><?php echo $grade_err;?></span>
                        </div>                  
                        <input type="hidden" name="submission_id" value="<?php echo $submission_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewStudentSubmissions.php?id='. $activity_id .'" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>