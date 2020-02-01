<?php
session_start();
if(!isset($_SESSION['username'])){
    header('LOCATION: error.php');
}
    include "./config.php";
    include "./php_static_code/create-db-table.php";
    $post_name = $_GET['d'];
    $SpecificBlog_ = "SELECT * FROM ".$username." WHERE post_name = '$post_name'";
    $SpecificBlogQuery = mysqli_query($userDBConnect,$SpecificBlog_); 
    $SpecificBlog = mysqli_fetch_assoc($SpecificBlogQuery);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./scss/view.css">
    <title>View</title>
</head>
<body>
    <?php
    
        if(isset($_SESSION['username'])){
            include "./php_static_elements/nav-logged.php";
        }else{
            include "./php_static_elements/nav-unlogged.php";
        }

        if($SpecificBlog['image'] == ''){
            echo "<img class='view-img' src='images/default-image.jpg' class='no-blog-image'>";
        }else{
            echo "<img class='view-img' src='blogs/".$username."/".$post_name."/images\/".$SpecificBlog['image']."'>";
        }
    ?>
    <div class="container">
        <div class="title-author">
            <h1 class="title"><?php echo $SpecificBlog['title']?></h1>
            <p class="written-by">Written by <a target="_blank" href="profile.php"><?php echo ucwords($username)?></a></p>
        </div>
        <p><?php echo $SpecificBlog['text']?></p>
        <div class="view-btn-wrapper">
        <a class="edit-btn" href="edit.php?d=<?php echo $post_name?>">Edit</a>
        <a class="edit-btn" href="profile.php">Back</a>
        </div> 
    </div>
</body>
</html>