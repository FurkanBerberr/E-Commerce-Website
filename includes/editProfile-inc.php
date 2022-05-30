<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $oldUserName = $_REQUEST["oldUserName"];
    $userName = $_REQUEST["userName"];
    $email = $_REQUEST["email"];
    $pswd = $_REQUEST["pswd"];

    
    include "../classes/db-classes.php";
    include "../classes/signin-classes.php";

    // Error handlers and sign in
    Signin::editProfile($oldUserName, $userName ,$email ,$pswd);

    // Send back to the sign in page
    header("location: ../profile.php?error=none");
    exit();


}