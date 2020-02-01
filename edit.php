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

    //Update data
    if(isset($_POST['submit'])){
        $newTitle = $_POST['title'];
        $newText = $_POST['text'];
        if($_FILES['image']['name'] == ''){
            $newImage = $SpecificBlog['image'];
        }else{
            $newImage = $_FILES['image']['name'];
        }
        $editDate = Current_Date();
        $updateQuery_ = "UPDATE ".$username." SET title='$newTitle', text='$newText', image='$newImage', edit_date='$editDate' WHERE post_name = '$post_name'";
        mysqli_query($userDBConnect, $updateQuery_);
        rename("blogs/".$username."/".$post_name."/".$SpecificBlog['title'].".php","blogs/".$username."/".$post_name."/".$newTitle.".php");
        header("LOCATION: http://localhost:8080/sandbox/PHP-project/view.php?d=".$post_name);
        $imagePath = "blogs/".$username."/".$post_name."/images\/".basename($_FILES['image']['name']);
        copy($_FILES['image']['tmp_name'], $imagePath);
    }
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
    ?>
    <form class="update-form" action="<?php $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="POST">
    <div class="image-upload">
        <?php 
             if($SpecificBlog['image'] == ''){
                echo "<img class='view-img upload-image' src='images/default-image.jpg' class='no-blog-image'>";
            }else{
                echo "<img class='view-img upload-image' src='blogs/".$username."/".$post_name."/images\/".$SpecificBlog['image']."'>";
            }
        ?>
        <label for="image"></label>
        <input type="file" name="image" id="image" onchange="handlePreview(this)">
        <h1>Upload image</h1>
    </div>


    <div class="container">
        <input type="text" name="title" class="title" value="<?php echo $SpecificBlog['title']?>">
        <textarea name="text"><?php echo $SpecificBlog['text']?></textarea>
        <input type="submit" name="submit" value="Save" class="save-btn">
    </div>

    </form>

    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</body>
</html>