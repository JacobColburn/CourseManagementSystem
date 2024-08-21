<?php
//handles input from the user in concjustion with model files to do something with the databse
//declaring strict types to prevent any extra data or typo errors
declare(strict_types=1);
//check if inputs are empty
function is_input_empty($firstName, $lastName, $address, $city, $state, $zip, $phone, $email, $password, $passwordRepeat){
    if(empty($firstName) || empty($lastName)||empty($address) || empty($city) || empty($state) ||empty($zip) || empty($phone) || empty($email) || empty($password) || empty($passwordRepeat) ){

        return true;
    }else{
        return false;
    }
}
function invalid_email($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
function email_is_taken( $pdo, $email){
    if(get_email($pdo, $email)){
        return true;
    }else{
        return false;
    }
}
function create_user(object $pdo, string $firstName, string $lastName, string $gender, string $address, string $address2, string $city, string $state, int $zip, string $phone, string $email, string $password, string $passwordRepeat){
    set_user($pdo, $firstName, $lastName, $gender, $address, $address2, $city, $state, $zip, $phone, $email, $password, $passwordRepeat);
    
    var_dump(headers_list());
}

