<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $userName = $_REQUEST["userName"];
    $email = $_REQUEST["email"];
    $pswd = $_REQUEST["pswd"];
    $pswdRepeat = $_REQUEST["pswdRepeat"];

    
    include "../classes/db-classes.php";
    include "../classes/signin-classes.php";
    $signin = new Signin($userName, $email, $pswd, $pswdRepeat);

    // Error handlers and sign in
    $signin->signInUsers();

    // Send back to the sign in page
    header("location: ../signin.php?error=none");
    exit();


}