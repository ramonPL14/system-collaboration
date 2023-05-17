<?php
    require_once "config.php";

    $sql = "SELECT * FROM `submission` WHERE `activity_id` = " . $_GET["id"];
    
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