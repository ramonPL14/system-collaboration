<?php

    include('database.php');

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $subject = $_POST['subject'];
    $file = $_POST['file'];

    $sql = "INSERT INTO student (first_name, last_name, subject, file_name) VALUES ('$fname', '$lname', '$subject', '$file')";

    try {
        mysqli_query($connect, $sql);
    } catch(mysqli_sql_exception) {
        echo 'for some reason couldn\'t connect!';
    }

?>
