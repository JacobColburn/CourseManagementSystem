<?php

declare(strict_types = 1);

function output_username(){
    if(isset($_SESSION["id"])){
        echo "Hello " . $_SESSION["firstName"];
} else{
    echo "Dont forget to login!";
    }
}
function check_login_errors() {
    if(isset($_SESSION["errors_login"])){
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach($errors as $error){
            echo '<p>' . $error . '</p>';
        }
        unset($_SESSION["errors"]);
    }else if(isset($_GET['login']) && $_GET['login'] === "success"){

    }
}