<?php 
 include "./config.php";
 include "./errors.php";

if(isset($_POST['registerSubmit'])){
    //Register fields
    if(NameCheck() == 'pass'){
        $name = htmlentities($_POST['name']);
    }
    if(FamilyNameCheck() == 'pass'){
        $familyName = htmlentities($_POST['familyName']);
    }
    if(UserCheck() == 'pass'){
        $registerUsername = htmlentities($_POST['registerUsername']);
    }
    if(CountryCheck() == 'pass'){
        $country = htmlentities($_POST['country']);
    }
    if(CityCheck() == 'pass'){
        $city = htmlentities($_POST['city']);
    }
    if(AddressCheck() == 'pass'){
        $address = htmlentities($_POST['address']);
    }
    if(EmailCheck() == 'pass'){
        $registerEmail = filter_var(htmlentities($_POST['registerEmail']), FILTER_SANITIZE_EMAIL);
    }
    if(PasswordCheck() == 'pass'){
        $registerPassword = password_hash(htmlentities($_POST['registerPassword']), PASSWORD_DEFAULT);
    }
    if(ConfirmCheck() == 'pass'){
        $passwordMatch = true;
    }else{
        $passwordMatch = false;
    }
    $status = "Status is empty";

    //Date
    $date = Current_Date();

    //Submit button
    $registerSubmit = $_POST['registerSubmit'];
    $mailRowArray = '';
    if(isset($name) && isset($familyName) && isset($registerUsername) && isset($country) && isset($city) && isset($address) && isset($registerEmail) && isset($registerPassword) && ($passwordMatch == true)){
        $hash = md5(rand(0,1000));
        $sql = "INSERT INTO usertable(name, familyName, username, status,country,city,address,email,password,hash,verified,registrationDate)  VALUES ('$name', '$familyName', '$registerUsername', '$status','$country','$city', '$address','$registerEmail','$registerPassword','$hash',0,'$date')";
        if(mysqli_query($db,$sql)){
            $to = "To:   ".$registerEmail.PHP_EOL.PHP_EOL;
            $subject = "Subject:   Account verification".PHP_EOL.PHP_EOL;
            $body = "Message:   Hello ".$registerUsername."! To finish your registration, click the following link: ".PHP_EOL.PHP_EOL;
            $link = "Link:   account-verified.php?hash=".$hash.PHP_EOL.PHP_EOL;
            $headers = "From:   PHP-project.com".PHP_EOL.PHP_EOL;
            
            $mailRowArray .= $to;
            $mailRowArray .= $subject;
            $mailRowArray .= $body;
            $mailRowArray .= $link;
            $mailRowArray .= $headers;
            file_put_contents("verify.txt", $mailRowArray);
            header('LOCATION: success.php');
        }
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
            <div class="registration-switch switch active-switch">
                <p>Register</p>
            </div>
        </div>

        <!--Form-->
        <div class="registration-wrapper">
            <h1 class="register-header">Registration</h1> 
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
                    <input type="text" name="familyName" id="familyName" value="<?php echo (isset($_POST['familyName']) && isset($familyName)) ? $familyName : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        FamilyNameError();
                    } ?>
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="registerUsername">Username</label>
                    <input type="text" name="registerUsername" id="registerUserName" value="<?php echo (isset($_POST['registerUsername']) && isset($registerUsername)) ? $registerUsername : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        UsernameError();
                    } ?>
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" value="<?php echo (isset($_POST['country']) && isset($country)) ? $country : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        CountryError();
                    } ?>
                </div>

                <div class="input-wrapper">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" value="<?php echo (isset($_POST['city']) && isset($city)) ? $city : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        CityError();
                    } ?>
                </div>

                <div class="input-wrapper">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo (isset($_POST['address']) && isset($address)) ? $address : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        AddressError();
                    } ?>
                </div>  

                <div class="input-wrapper">
                    <label for="registerPassword">Password</label>
                    <input type="password" name="registerPassword" id="registerPassword" value="">
                    <?php if(isset($_POST['registerSubmit'])) {
                        PasswordError();
                    } ?>
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">     
                    <label for="registerEmail">Email</label>
                    <input type="email" name="registerEmail" id="registerEmail" value="<?php echo (isset($_POST['registerEmail']) && isset($registerEmail)) ? $registerEmail : ""?>">
                    <?php if(isset($_POST['registerSubmit'])) {
                        EmailError();
                    } ?>
                    <small class="required-message">*required</small>
                </div>

                <div class="input-wrapper">
                    <label for="confirmPassword">Confirm password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword" value="">
                    <?php if(isset($_POST['registerSubmit'])) {
                        ConfirmError();
                    } ?>
                    <small class="required-message">*required</small>
                </div>

                <input type="submit" value="Submit" name="registerSubmit">
            </form>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/index.js"></script>
</body>
</html>