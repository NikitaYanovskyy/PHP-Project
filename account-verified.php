<?php
    if(isset($_GET['hash'])){
        include "./config.php";
        $hash = $_GET['hash'];
        $row = "SELECT * FROM usertable WHERE verified = 0 AND hash='$hash'";
        $result = mysqli_query($db, $row);
        if(mysqli_num_rows($result) == 1){
            $newRow = "UPDATE usertable SET verified = 1 WHERE hash ='$hash' LIMIT 1";
            if($newRow){
                mysqli_query($db, $newRow);
            }else{
                header("LOCATION: error.php");
            }
        }else{
            header("LOCATION: error.php");
        }
    }else{
        header("LOCATION: error.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="scss/success.css">
    <title>Success</title>
</head>
<body>
    <?php include "./php_static_elements/nav.php"?>
    <div class="container success-message">
        <h2>Your account was successfully registrated. Now you can <a href="login.php">log in</a></h2>
    </div>
</body>
</html>