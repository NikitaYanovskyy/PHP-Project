<?php 
//Error messages
function NameError(){
    if(NameCheck() == 'empty'){
        echo '<small class="error-message">Name is required</small>';
    }else if(NameCheck() == 'more then allowed'){
        echo '<small class="error-message">Name has to contain below 15 symbols</small>';
    } else{
        echo '';
    }
}
function FamilyNameError(){
    if(FamilyNameCheck() == 'empty'){
        echo '<small class="error-message">Family name is required</small>';
    }else if(FamilyNameCheck() == 'more then allowed'){
        echo '<small class="error-message">Family name has to contain below 20 symbols</small>';
    } else{
        echo '';
    }
}
function UsernameError(){
    if(UserCheck() == 'empty'){
        echo '<small class="error-message">Username is required</small>';
    }else if(UserCheck() == 'more then allowed'){
        echo '<small class="error-message">Username has to contain below 20 symbols</small>';
    }else if(UserCheck() == 'exists'){
        echo '<small class="error-message">Username is already taken</small>';
    }else{
        echo '';
    }
}
function CountryError(){
    if(CountryCheck() == 'more then allowed'){
        echo '<small class="error-message">Country has to contain below 20 symbols</small>';
    }else{
        echo '';  
    }
}
function CityError(){
    if(CityCheck() == 'more then allowed'){
        echo '<small class="error-message">City has to contain below 20 symbols</small>';
    }else{
        echo '';  
    }
}
function AddressError(){
    if(AddressCheck() == 'more then allowed'){
        echo '<small class="error-message">Address has to contain below 30 symbols</small>';
    }else{
        echo '';  
    }
}
function EmailError(){
    if(EmailCheck() == 'empty'){
        echo '<small class="error-message">Email is required</small>';
    }else if(EmailCheck() == 'more then allowed'){
        echo '<small class="error-message">Email has to contain below 30 symbols</small>';
    }else if(EmailCheck() == 'not valid'){
        echo '<small class="error-message">Email is not valid</small>';
    }else if(EmailCheck() == 'exists'){
        echo '<small class="error-message">Email is already taken</small>';
    }else{
        echo '';
    }
}
function PasswordError(){
    if(PasswordCheck() == 'empty'){
        echo '<small class="error-message">Password is required</small>';
    }else if(PasswordCheck() == 'more then allowed'){
        echo '<small class="error-message">Password has to contain below 30 symbols</small>';
    }else if(PasswordCheck() == 'less then allowed'){
        echo '<small class="error-message">Password has to contain more then 6 symbols</small>';
    }else{
        echo '';
    }
}
function ConfirmError(){
    if(ConfirmCheck() == 'not valid'){
        echo '<small class="error-message">Password doesn\'t match</small>';
    }else{
        echo '';
    }
}
?>