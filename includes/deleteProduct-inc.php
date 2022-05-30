<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit"])){

    // Getting the users data
    $productsId = $_REQUEST["productsId"];

    
    include "../classes/db-classes.php";
    include "../classes/product-classes.php";
    

    // Error handlers and seraching product
    Product::deleteProduct($productsId);

    // Send back to the edit product page
    header("location: ../deleteproduct.php?error=none");
    exit();


}