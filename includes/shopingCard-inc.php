<?php
session_start();

/* Checking the user reach the page 
proper way which is clicking the submit 
button not chancing the link. */
if (isset($_REQUEST["addCard"])){
    if(!isset($_SESSION["shopping_cart1"])){
        $_SESSION["shopping_cart1"] = array();
    }

    $item_id_list = array_column($_SESSION["shopping_cart1"], 'item_id');

    if(in_array($_REQUEST["hidden_id"], $item_id_list)){
        foreach($_SESSION["shopping_cart1"] as $keys => $values){
            if($_SESSION["shopping_cart1"][$keys]["item_id"] == $_REQUEST["hidden_id"]){
                $_SESSION["shopping_cart1"][$keys]["item_quantity"] = $_SESSION["shopping_cart1"][$keys]["item_quantity"] + $_REQUEST["quantity"];
            }
        }
    }else{
        $item_array = array(
            'item_id' => $_REQUEST["hidden_id"],
            'item_name' => $_REQUEST["hidden_name"],
            'item_price' => $_REQUEST["hidden_price"],
            'item_quantity' => $_REQUEST["quantity"]
        );
        $_SESSION["shopping_cart1"][] = $item_array;
    }

    // Send back to the sign in page
    if($_REQUEST["hidden_category"] == "horror"){
        header("location: ../horror-category.php?success=1");
    }elseif($_REQUEST["hidden_category"] == "adventure"){
        header("location: ../adventure-category.php?success=1");
    }

}