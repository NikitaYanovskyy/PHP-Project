<?php 

if(isset($_POST['registerSubmit'])){
    include "./config.php";

    //Error messages
    function NameError(){
        if(NameCheck() == 'empty'){
            echo '<small class="error-message">Name is required</small>';
        }else if(NameCheck() == 'more then allowed'){
            echo '<small class="error-message">Name has to be below 15 symbols</small>';
        } else{
            echo '';
        }
    }


    //Register fields
  
    if(NameCheck() == 'pass'){
        $name = $_POST['name'];
    }
    $familyName = $_POST['familyName'];
    $registerUsername = $_POST['registerUsername'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $registerEmail = $_POST['registerEmail'];
    $registerPassword = $_POST['registerPassword'];
    $registerSubmit = $_POST['registerSubmit'];

    if(isset($name)){
        $sql = "INSERT INTO usertable(name)  VALUES ('$name')";
        mysqli_query($db,$sql);
    }
}
    
if(isset($_POST['loginSubmit'])){
    //Login fields
    $loginUsername = $_POST['loginUsername'];
    $loginPassword = $_POST['loginPassword'];
    $loginSubmit = $_POST['loginSubmit'];
}

    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./scss/index.css">
    <title>Landing</title>
</head>
<body>
    <?php include "./php_static_elements/nav.php"?>

    <div class="container form-wrapper">

        <!--Switchers-->
        <div class="form-switchers">
            <div class="registration-switch switch active-switch">
                <p>Register</p>
            </div>
            <div class="login-switch switch">
                <p>Login</p>
            </div>
        </div>

        <!--Form-->
        <div class="registration-wrapper">
            <h1>Registration</h1> 
            <form class="registration-form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <div class="input-wrapper">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?php echo (isset($_POST['name']) && isset($name)) ? $name : ''?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        NameError();
                    } ?>
                    <!--<small class="error-message">This is an error</small>-->
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="familyName">Family name</label>
                    <input type="text" name="familyName" id="familyName" value="<?php echo (isset($_POST['familyName'])) ? $familyName : ""?>">
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="registerUsername">Username</label>
                    <input type="text" name="registerUsername" id="registerUserName" value="<?php echo (isset($_POST['registerUsername'])) ? $registerUsername : ""?>">
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" value="<?php echo (isset($_POST['country'])) ? $country : ""?>">
                </div>

                <div class="input-wrapper">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="<?php echo (isset($_POST['city'])) ? $city : ""?>">
                </div>

                <div class="input-wrapper">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo (isset($_POST['address'])) ? $address : ""?>">
                </div>  

                <div class="input-wrapper">     
                    <label for="registerEmail">Email</label>
                    <input type="email" name="registerEmail" id="registerEmail" value="<?php echo (isset($_POST['registerEmail'])) ? $registerEmail : ""?>">
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="registerPassword">Password</label>
                    <input type="password" name="registerPassword" id="registerPassword" value="<?php echo (isset($_POST['registerPassword'])) ? $registerPassword : ""?>">
                    <small class="required-message">*required</small>
                </div>

                <input type="submit" value="Submit" name="registerSubmit">
            </form>
        </div>

        <div class="login-wrapper">
            <h1>Login</h1>
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