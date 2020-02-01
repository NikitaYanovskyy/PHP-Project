<?php
//Link
$url_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//Get post_name
$getPost_name = explode('/', $url_link);
$post_name = $getPost_name[sizeof($getPost_name) - 2];

//Get username
$url_items = explode('/', $url_link);
$blogOwner = $url_items[sizeof($url_items) - 3];
$capitalBlogOwner = ucwords($blogOwner);
session_start();

    include "../../../config.php";

    //Getting one specific blog row
    $userDBConnect = mysqli_connect("localhost","root","Tchami&Malaa", $blogOwner."_blog");
    $SpecificBlog_ = "SELECT * FROM ".$blogOwner." WHERE post_name = '$post_name'";
    $result = mysqli_query($userDBConnect, $SpecificBlog_);
    if($result){
        $blogRow = mysqli_fetch_assoc($result);
    }else{
        echo "NO";
    }

    //Selecting & Pasting data
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../scss/view.css">
    
    <title>View</title>
</head>
<body>
    <?php
    
        if(isset($_SESSION['username'])){
            include "../../../php_static_elements/nav-logged.php";
        }else{
            include "../../../php_static_elements/nav-unlogged.php";
        }

        if($blogRow['image'] == ''){
            echo "<img class='view-img' src='../../../images/default-image.jpg'>";
        }else{
            echo "<img class='view-img' src='./images/".$blogRow['image']."'>";
        }
    ?>
    <div class="container">
        <div class="title-author">
            <h1 class="title"><?php echo $blogRow['title']?></h1>
            <p class="written-by">Written by <a target="_blank" href="../../../users/<?php echo $blogOwner?>/<?php echo $blogOwner?>.php"><?php echo ucwords($blogOwner)?></a></p>
        </div>
        <p><?php echo $blogRow['text']?></p>
        <div class="view-btn-wrapper">
        <a class="edit-btn" href="../../../bloglist.php">Bloglist</a>
        </div> 
    </div>
</body>
</html>