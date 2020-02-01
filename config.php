<?php 
    $db = mysqli_connect("localhost","root","Tchami&Malaa","registration");
    date_default_timezone_set('Europe/Uzhgorod');

    //Date function
    function Current_Date(){
        $dateArray = array(date('d'),date('l'),date('Y'),date('h:i:sa'));
        $date = '';
        for($i = 0; $i < count($dateArray); $i++){
            if($dateArray[$i] == date('h:i:sa')){
                $date = $date." ".$dateArray[$i];
            }else{
                $date = $date." ".$dateArray[$i];
            }
        }
        return $date;
    }

    //Delete directory function
    function delete_files($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK );
    
            foreach( $files as $file ){
                delete_files( $file );      
            }
            error_reporting(0);
            rmdir($target);
            error_reporting(E_ALL);

        } elseif(is_file($target)) {
            unlink( $target );  
        }
    }


    //Check functions
    function NameCheck(){
        if(strlen($_POST['name']) <= 0){
            return 'empty';
        }else if(strlen($_POST['name']) > 15){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
    function FamilyNameCheck(){
        if(strlen($_POST['familyName']) <= 0){
            return 'empty';
        }else if(strlen($_POST['familyName']) > 20){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
    function UserCheck(){
        $registerUsername = $_POST['registerUsername'];
        $query = "SELECT * FROM usertable WHERE username = '$registerUsername'";
        $result = mysqli_query(mysqli_connect("localhost","root","Tchami&Malaa","registration"), $query);
        if(mysqli_num_rows($result) >= 1){
            return 'exists';
        }else if(strlen($_POST['registerUsername']) <= 0){
            return 'empty';
        }else if(strlen($_POST['registerUsername']) > 20){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
    function CountryCheck(){
        if(strlen($_POST['country']) > 15){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
    function CityCheck(){
        if(strlen($_POST['city']) > 15){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }function AddressCheck(){
        if(strlen($_POST['address']) > 30){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
    function EmailCheck(){
        $registerEmail = $_POST['registerEmail'];
        $query = "SELECT * FROM usertable WHERE email = '$registerEmail'";
        $result = mysqli_query(mysqli_connect("localhost","root","Tchami&Malaa","registration"), $query);
        if(mysqli_num_rows($result) >= 1){
            return 'exists';
        }else if(strlen($_POST['registerEmail']) <= 0){
            return 'empty';
        }else if(strlen($_POST['registerEmail']) > 30){
            return 'more then allowed';
        }else if(filter_var($_POST['registerEmail'], FILTER_VALIDATE_EMAIL) == false){
            return 'not valid'; 
        }else{
            return 'pass';
        }
    }
    function PasswordCheck(){
        if(strlen($_POST['registerPassword']) <= 0){
            return 'empty';
        }else if(strlen($_POST['registerPassword']) > 20){
            return 'more then allowed';
        }else if(strlen($_POST['registerPassword']) < 6){
            return 'less then allowed';
        }else{
            return 'pass';
        }
    }
    function ConfirmCheck(){
        if(strcmp($_POST['registerPassword'], $_POST['confirmPassword']) != 0){
            return 'not valid';
        }else{
            return 'pass';
        }
    }
?>
