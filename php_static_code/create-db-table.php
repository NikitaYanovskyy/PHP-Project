<?php
    $username = strtolower($_SESSION['username']);

    //Making and inserting database
    $createDB_ =  "CREATE DATABASE IF NOT EXISTS blogs";
    $generalConnect = mysqli_connect("localhost","root","Tchami&Malaa");
    mysqli_query($generalConnect,$createDB_);

    //Inserting table
    $insertTable_ = "CREATE TABLE IF NOT EXISTS ".$username." (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(40) NOT NULL,
        text VARCHAR(3400) NOT NULL,
        image VARCHAR(100) NOT NULL,
        post_name VARCHAR(500) NOT NULL,
        date VARCHAR(30) NOT NULL,
        edit_date VARCHAR(30) NOT NULL
    )";

    $userDBConnect = mysqli_connect("localhost","root","Tchami&Malaa", "blogs");
    mysqli_query($userDBConnect, $insertTable_);
?>