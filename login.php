<?php 
 include "./config.php";
 include "./errors.php";

$loginError = 'Error';
$loginErrorClass = 'login-error-space';
if(isset($_POST['loginSubmit'])){
    session_start();

    //Login fields
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];
    $sql = "SELECT * FROM usertable WHERE username = '$loginUsername'";
    $result = mysqli_query($db,$sql);
    //Error message
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) == 1 && password_verify($loginPassword , $row['password'])){
        if($row['verified'] == '1'){
            $_SESSION['username'] = $loginUsername;
            include 'php_static_code/create-db-table.php';

            //Create file
            mkdir('users/'.strtolower($loginUsername).'/profileImage', 0777,true);
            $fileProfile = 'users/'.strtolower($loginUsername).'/'.strtolower($loginUsername).'.php';
            $codeProfile = file_get_contents('php_static_code/profile-render.php');
            $current = file_put_contents($fileProfile, $codeProfile);
            
            header('LOCATION: bloglist.php');
        }else{
            $loginError = '*Activate your account to log in';
        }     
    }else{
        $loginError = '*Password or username is not valid';
    }
    
}  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./scss/index.css">
    <link rel="stylesheet" href="./scss/login.css">
    <title>Landing</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['username'])){
            include "./php_static_elements/nav-logged.php";
        }else{
            include "./php_static_elements/nav-unlogged.php";
        }
    ?>

    <div class="container form-wrapper">

        <!--Switchers-->
        <div class="form-switchers">
            <div class="login-switch switch active-switch">
                <p>Login</p>
            </div>
        </div>

        <!--Form-->

        <div class="login-wrapper">
            <h1 class="login-header">Login</h1>
            <?php 
                if(isset($_POST['loginSubmit'])){ 
                    $loginErrorClass = 'login-error';   
                    echo '<p class="'.$loginErrorClass.'">'.$loginError.'</p>';
                }else{
                    echo '<p class="'.$loginErrorClass.'">'.$loginError.'</p>';
                }
            ?>
            <form class="login-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                <div class="input-wrapper">
                    <label for="loginUsername">Username</label>
                    <input type="text" name="loginUsername" id="loginUsername">
                </div>

                <div class="input-wrapper">
                    <label for="loginPassword">Password</label>
                    <input type="password" name="loginPassword" id="loginPassword">
                </div>

                <input type="submit" value="Submit" name="loginSubmit">
            </form>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</body>
</html>