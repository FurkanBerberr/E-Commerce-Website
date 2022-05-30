<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $imagePth = $_REQUEST["imagePth"];
    $productName = $_REQUEST["productName"];
    $price = $_REQUEST["price"];
    $productDesc = $_REQUEST["productDesc"];
    $productType = $_REQUEST["productType"];
    $category = $_REQUEST["category"];

    
    include "../classes/db-classes.php";
    include "../classes/product-classes.php";
    $product = new Product($imagePth, $productName, $price, $productDesc, $productType, $category);

    // Error handlers and adding product
    $product->increasePrdct();

    // Send back to the add product page
    header("location: ../addproduct.php?error=none");
    exit();


}