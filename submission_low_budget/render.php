<?php

    include("database.php");

    $sql = "SELECT * FROM student";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            echo $row['id'] . "<br />";
            echo $row['last_name'] . "<br />";
            echo $row['first_name'] . "<br />";
            echo $row['subject'] . "<br />";
            echo $row['file_name'] . "<br />";
            echo $row['submission_date'] . "<br /><br />";
        };

    }
    else {
        echo "No user found!";
    }

    

?>