<?php 
include 'config.php';

session_start();
if(!isset($_SESSION['username'])){
    header('LOCATION: error.php');
}
include "./php_static_code/create-db-table.php";
//CreateFolder
$numHash = md5(rand(0,10000)."");

function ShortHash($hash){
    $hashString = '';
    $hash = str_split($hash);
    for ($i=0; $i < 5; $i++) { 
        $hashString.= $hash[$i];
    }
    return $hashString;
}

$blogHash = ShortHash($numHash);

if(isset($_POST['delete'])){
    $post_name = $_POST['post_name'];
    $deleteQuery_ = "DELETE FROM ".$username." WHERE post_name = '$post_name'";
    mysqli_query($userDBConnect,$deleteQuery_);
    delete_files('blogs/'.strtolower($username)."/".$post_name);
}

if(isset($_POST['createPost'])){

    //Create folder for blog 
    if(!file_exists('blogs/'.strtolower($username)."/".$blogHash."/images")){
        mkdir('blogs/'.strtolower($username)."/".$blogHash."/images", 0777,true);
    };    

    //Collecting & Submiting data
    $title = $_POST['createTitle'];
    $text = $_POST['createText'];
    $image = $_FILES['createImage']['name'];
    $date = Current_Date();


    //Creating blog php page
    $phpPage = "blogs/$username/$blogHash/$title.php";
    $blogContent = file_get_contents("php_static_code/blog-render.php");
    $putBlogContent = file_put_contents($phpPage, $blogContent);


    $insertData_ = "INSERT INTO ".$username." (title,text,image,post_name,date) VALUES ('$title','$text','$image','$blogHash','$date')";
    mysqli_query($userDBConnect,$insertData_);
    $imagePath = "blogs/".$username."/".$blogHash."\/images\/".basename($_FILES['createImage']['name']);
    move_uploaded_file($_FILES['createImage']['tmp_name'], $imagePath);
}

if(isset($_POST['save-bio'])){
    $newStatus = $_POST['bio-input'];
    $newImage = $_FILES['newProfileImage']['name'];
    $getStatus = "UPDATE usertable SET status = '$newStatus' WHERE username = '$username'";
    $getImage = "UPDATE usertable SET profileImage = '$newImage' WHERE username = '$username'";

    $newImagePath = "users/".$username."/profileImage\/".basename($newImage);
    $SessionImagesPath = "images/".basename($newImage);
    copy($_FILES['newProfileImage']['tmp_name'], $SessionImagesPath);
    copy($_FILES['newProfileImage']['tmp_name'], $newImagePath);
    mysqli_query($db,$getStatus);
    mysqli_query($db,$getImage);
}


    //Selecting & Pasting data
    $selectData_ = "SELECT * FROM ".$username."";
    $selectResult = mysqli_query($userDBConnect,$selectData_);
    $blogArray = mysqli_fetch_all($selectResult,MYSQLI_ASSOC);

    //Getting 
    $getUserInfo_ = "SELECT * FROM usertable WHERE username = '$username'";

    $result = mysqli_query($db,$getUserInfo_);
    $userInfo = mysqli_fetch_assoc($result); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./scss/bloglist.css">
    <link rel="stylesheet" href="scss/profile.css">

    <title>Profile</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['username'])){
            include "./php_static_elements/nav-logged.php";
        }else{
            include "./php_static_elements/nav-unlogged.php";
        }
    ?>

    <form method="post" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" class="container info-wrapper">
        <div class="profile-image-wrapper">
                <img src="<?php 
                    if($row['profileImage'] == ''){
                        echo('images/default-image.jpg');
                    }else{
                        echo('users/'.$username.'/profileImage\/'.$userInfo['profileImage']);
                    }
                ?>" class="profile-image main-profile-image upload-image-profile"></img>
                <div class="profileImageBlack"></div>
                <h3 class="profileImageText">Update image</h3>
                <label class="profileLabel" for="newProfileImage"></label>
                <input type="file" name="newProfileImage" id="newProfileImage" onchange="handlePreviewProfile(this)">
        </div>  
        <div class="bio">
            <h2><?php echo($userInfo['username'])?></h2>
            <p class="status"><?php echo($userInfo['status'])?></p>
            <textarea type="text" class="bio-input" name="bio-input"><?php echo $userInfo['status']?></textarea>
            <div class="bio-btn-wrapper">
                <a class="bio-edit">Edit</a>
                <a class="bio-back">Back</a>
                <input type="submit" name="save-bio" class="bio-save" value="Save">
            </div>
        </div>
        </form>

    <div class="container bloglist-wrapper">
        <div class="create-blog-wrapper">
            <h1>Create a post</h1>
            <form method="POST" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" class="create-blog">
                <div class="blog-text">
                    <div class="blog-text-text">
                        <input type="text" name="createTitle" placeholder="Title">
                        <textarea name="createText" placeholder="Your blog's text"></textarea>
                        <div class="buttons-wrapper">
                            <input type="submit" name="createPost" value="Post" class="post-view">
                        </div>
                    </div>
                </div>
                <div class="blog-image-wrapper">
                    <h3>Upload image</h3>
                    <img class="upload-image" src="images/default-image.jpg">
                    <label for="createImage"></label>
                    <input type="file" name="createImage" id="createImage" onchange="handlePreview(this)">
                </div>
            </form>
        </div>

        <div class="bloglist">
            <h1>Bloglist</h1>
            <?php foreach(array_reverse($blogArray) as $row) : ?>
            <form method="post" class="blog-item">
                <div class="blog-text">
                    <div class="blog-text-text">
                        <h2><?php echo($row['title'])?></h2>

                        <p><?php 
                        $cutText = mb_substr($row['text'], 0, 400);
                        echo $cutText."..."?></p>


                        <div class="buttons-wrapper">
                            <input type="submit" name="delete" value="Delete" class="post-delete">
                            <input type="hidden" name="post_name" value="<?php echo $row['post_name']?>">
                            <a href="http://localhost:8080/sandbox/PHP-project/view.php?d=<?php echo($row['post_name'])?>" class="post-view">View</a>
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
                            echo "<img src='images/default-image.jpg' class='no-blog-image'>";
                        }else{
                            echo "<img src='blogs/".$username."/".$row['post_name']."/images\/".$row['image']."' class='no-blog-image'>";
                        }
                    ?>
                </div>
            </form>
            <?php endforeach?>
        </div> 
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</body>
</html>