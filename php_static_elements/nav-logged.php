<?php
        if(isset($_POST['log-out'])){
                session_destroy();
                header('LOCATION: http://localhost:8080/sandbox/PHP-project/login.php');
        }
            if(isset($_SESSION['username'])){
                $userName = $_SESSION['username'];
                $sql = "SELECT * FROM usertable WHERE username = '$userName' LIMIT 1";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_assoc($result);
            }
?>
<nav>
        <a style="color: #fff" href="bloglist.php"><h1>Php practise</h1></a>
        <div class="mini-profile-login">
                <form class="log-out-wrapper" method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                        <input type="submit" name="log-out" class="log-out" value="Log-out">
                </form>
                <a href="http://localhost:8080/sandbox/PHP-project/profile.php" class="mini-profile">
                        <img src="
                        <?php if($row['profileImage'] == ''){
                        echo('http://localhost:8080/sandbox/PHP-project/images/default-image.jpg');
                        }else{
                                echo('http://localhost:8080/sandbox/PHP-project/users/'.$userName."/profileImage\/".$row['profileImage']);
                        }?>
                        "
                        >
                        <p class="mini-nickname"><?php echo $_SESSION['username']?></p>
                </a>
        </div>  
</nav>