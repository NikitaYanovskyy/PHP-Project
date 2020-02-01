<?php
    include "./config.php";
    session_start();
    
    if(isset($_POST['log-out'])){
        session_destroy();
        header('LOCATION: login.php');
    }


    //Latest blogs
    $selectAllBlogs_ = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME REGEXP '\w*[_]blog' ";
    $mainDb = mysqli_connect('localhost','root','Tchami&Malaa','information_schema');
    $result =  mysqli_query($mainDb, $selectAllBlogs_);
    $row = mysqli_fetch_assoc($result);
    var_dump($row);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bloglist</title>
    <link rel="stylesheet" href="./scss/profile.css">
    <link rel="stylesheet" href="./scss/bloglist.css">
</head>
<body>
    <?php 
    if(isset($_SESSION['username'])){
        include "./php_static_elements/nav-logged.php";
    }else{
        include "./php_static_elements/nav-unlogged.php";
    }
    ?>
    <div class="main-blog-list container">
        <h1>Latest Blogs</h1>

        <div class="blog-item-wrapper">
            <a href="profile.php" class="blog-profile">
                <img src="">
                <p class="blog-nickname">Nickname</p>
            </a>

            <div class="blog-item">
                <div class="blog-text">
                    <div class="blog-text-text">
                        <h2>Title</h2>
                        <p>“Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                        sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.”</p>
                        <input type="submit" name="view" value="View" class="post-view">
                    </div>
                    <div class="blog-posted">
                        <small>Posted on (date)</small>
                    </div>
                </div>

                <div class="blog-image-wrapper">
                    <!--<div class="no-blog-image"></div>-->
                    <img src="" alt="">
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>