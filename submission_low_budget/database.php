<?php

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "submission";
    $connect = "";

    try{
        $connect = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    }
    catch(mysqli_sql_exception) {
        echo "could not connect!";
    }

    if($connect) {
        echo "Submission is successful!";
    }

?>
<br>
<br>
<a href="render.php" style="font-size: 25px">see other submissions</a>
<br>
<br>