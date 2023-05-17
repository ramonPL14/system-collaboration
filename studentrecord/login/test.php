<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>
<body>
    <form action="test.php" method="POST">

        <label for="">Enter your grade 69-100</label>
        <input type="number" name="number">
        <input type="submit" name="submit">

    </form>
</body>
</html>
<br>


<?php

    $grade = $_POST['number'];
    if($grade >= 69 && $grade <= 100) {

        echo "your grade is $grade congrats!";
    }
    else if($grade == null) {
        
        echo "please enter something";
    }
    else {

        echo "$grade is invalid!";
    }



?>