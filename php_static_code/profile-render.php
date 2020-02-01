<?php 
include '../../config.php';
session_start();

    $url_link = ucwords("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
   
    $url_Username = basename($url_link);
    $url_Username = str_replace('.php','',$url_Username);

    $capitalUsername = ucwords($url_Username);

    $getUserBlog_ = "SELECT * FROM ".$url_Username;
    $getUserInfo_ = "SELECT * FROM usertable WHERE username = '$capitalUsername'";

    $result = mysqli_query($db,$getUserInfo_);
    $userInfo = mysqli_fetch_assoc($result); 
    //Selecting & Pasting data
    $userDBConnect = mysqli_connect("localhost","root","Tchami&Malaa", $url_Username."_blog");
    $selectResult = mysqli_query($userDBConnect,$getUserBlog_);
    $blogArray = mysqli_fetch_all($selectResult,MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../scss/bloglist.css">
    <link rel="stylesheet" href="../../scss/profile.css">

    <title>Profile</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['username'])){
            include "../../php_static_elements/nav-logged.php";
        }else{
            include "../../php_static_elements/nav-unlogged.php";
        }
    ?>

    <div class="container info-wrapper">
        <img src="<?php 
            if($userInfo['profileImage'] == ''){
                echo('../../images/default-image.jpg');
            }else{
                echo("../../users/".$userInfo['username']."/profileImage\/".$userInfo['profileImage']);
            }
        ?>" class="profile-image"></img>
        <div class="bio">
            <h2><?php echo($userInfo['username'])?></h2>
            <p><?php echo($userInfo['status'])?></p>
        </div>
    </div>

    <div class="container bloglist-wrapper">
       

        <div class="bloglist">
            <h1>Bloglist</h1>
            <?php foreach($blogArray as $row) : ?>
                <div class="blog-item">
                <div class="blog-text">
                    <div class="blog-text-text">
                        <h2><?php echo($row['title'])?></h2>

                        <p><?php echo mb_substr($row['text'], 0, 400)."..."?></p>


                        <div class="buttons-wrapper">
                            <a class="post-view" href="../../blogs/<?php echo $userInfo['username']?>/<?php echo $row['post_name']?>/<?php echo $row['title']?>.php">View</a>
                        </div>
                    </div>
                    <div class="blog-posted">
                        <small>Posted on <?php echo($row['date'])?></small>
                        <?php 
                            if($row['edit_date'] == ""){
                                echo '';
                            }else{
                                echo "<small>Edited ".$row['edit_date']."</small>";
                            }
                        ?>
                    </div>
                </div>
                <div class="blog-image-wrapper">
                    <?php 
                        if($row['image'] == ''){
                            echo "<img src='../../images/default-image.jpg' class='no-blog-image'>";
                        }else{
                            echo "<img src='../../blogs/".$url_Username."/".$row['post_name']."/images\/".$row['image']."' class='no-blog-image'>";
                        }
                    ?>
                </div>
            </div>
            <?php endforeach?>
        </div> 
    </div>
    
</body>
</html>