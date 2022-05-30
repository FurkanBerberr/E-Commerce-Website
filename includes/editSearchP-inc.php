<?php

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["submit1"])){

    // Getting the users data
    $search = $_REQUEST["search"];
    
    include "../classes/db-classes.php";
    include "../classes/product-classes.php";
    

    // Error handlers and seraching product
    Product::searchProduct($search);

    // Send back to the edit product page
    header("location: ../editproduct.php?error=none");
    exit();
}

elseif (isset($_REQUEST["submit2"])){

    // Getting the users data
    $productsId = $_REQUEST["productsId"];
    $imagePth = $_REQUEST["imagePth"];
    $productName = $_REQUEST["productName"];
    $price = $_REQUEST["price"];
    $productDesc = $_REQUEST["productDesc"];
    $productType = $_REQUEST["productType"];
    $category = $_REQUEST["category"];
    
    include "../classes/db-classes.php";
    include "../classes/product-classes.php";
    

    // Error handlers and updating product
    Product::updateProduct($productsId, $imagePth, $productName, $price, $productDesc, $productType, $category);

    // Send back to the edit product page
    header("location: ../editproduct.php?error=none");
    exit();

}