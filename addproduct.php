<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Add Product</title>
</head>
<body>
    <nav class="NavBar">
        <ul>
            <?php
                if(isset($_SESSION["useruid"])){
                    echo '<li><a href="logout.php">LOG OUT</a></li>';
                    echo '<li><a href="profile.php">'.strtoupper($_SESSION["useruid"]).'</a></li>';
                    echo '<li><a href="shopingcart.php">CART</a></li>';
                }
                else{
                    echo '<li><a href="signin.php">SIGN IN</a></li>';
                    echo '<li><a href="login.php">LOGIN</a></li>';
                }
            ?>
            <li><a href="index.php">HOME</a></li>
        </ul>
    </nav>


    <div class="form">

        <h2>ADD PRODUCT</h2>
        <form action="includes/product-inc.php">
            <input type="text" name="imagePth" placeholder="Image Path"><br>
            <input type="text" name="productName" placeholder="Product Name"><br>
            <input type="number" name="price" placeholder="Price" step=".01"><br>
            <input type="text" name="productDesc" placeholder="Product Description" ><br>
            <input type="text" name="productType" placeholder="Product Type"><br>
            <input type="text" name="category" placeholder="Category"><br>
            <button type="submit" name="submit">Add Poduct</button>
        </form> 

        <!--Alerts the user about the errors-->
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p class='warn'>Fill in all the fields!</p>";
                }
                elseif($_GET["error"] == "stmtfaild"){
                    echo "<p class='warn'>Something went wrong please try again!</p>";
                }
                elseif($_GET["error"] == "none"){
                    echo "<p class='warn'>Product successfully added!</p>";
                }
            }
        ?>
    </div> 
    
</body>
</html>