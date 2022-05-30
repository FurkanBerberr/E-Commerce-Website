<?php
session_start();

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $name = $_REQUEST["name"];
    $address = $_REQUEST["address"];
    $country = $_REQUEST["country"];
    $city = $_REQUEST["city"];
    $payment = $_REQUEST["payment"];

    // Checks the admin fill all the spaces
    if(empty($name) || empty($address) || empty($country) || empty($city) || empty($payment)){
        header("location: ../payment.php?error=emptyinput");
        exit();
    }

    unset($_SESSION["shopping_cart1"]);

    // Send back to the add product page
    header("location: ../payment.php?error=none");
    exit();


}