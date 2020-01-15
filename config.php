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
        if(strlen($_POST['registerUsername']) <= 0){
            return 'empty';
        }else if(strlen($_POST['registerUsername']) > 20){
            return 'more then allowed';
        }else{
            return 'pass';
        }
    }
?>
