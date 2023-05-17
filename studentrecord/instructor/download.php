<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//calls data from these two attributes
$studentId = $_SESSION["id"] ;

    require_once "config.php";

    $sql = "SELECT * FROM `submission` WHERE `activity_id` = " . $_GET["id"] . "AND `student_id` = " . $StudentId;
    
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) == 0)
    {
        die("File does not exists.");
    }
    
    $row = mysqli_fetch_object($result);
    //open to new tab
    header("Content-type: " . $row->submission_filetype);
    
    echo $row->submission_file;
?>