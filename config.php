<?php 
    $db = mysqli_connect("localhost","root","Tchami&Malaa","registration");


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
?>
