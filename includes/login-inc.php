<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $userName = $_REQUEST["userName"];
    $pswd = $_REQUEST["pswd"];

    
    include "../classes/db-classes.php";
    include "../classes/login-classes.php";
    $login = new Login($userName, $pswd);

    // Error handlers and log in
    $login->logInUsers();

    // Send back to the main in page
    header("location: ../index.php?error=none");
    exit();


}