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
    <title>Search and Edit Product</title>
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
        <h2>Search Product</h2>
        <form action="includes/editSearchP-inc.php">
            <input type="text" name="search" placeholder="Search (Product name)"><br>
            <button type="submit" name="submit1">Search</button>
            <h2>Edit Product</h2>
            <input type="text" name="productsId" placeholder="Product Id"><br>
            <input type="text" name="imagePth" placeholder="Image Path"><br>
            <input type="text" name="productName" placeholder="Product Name"><br>
            <input type="number" name="price" placeholder="Price" step=".01"><br>
            <input type="text" name="productDesc" placeholder="Product Description" ><br>
            <input type="text" name="productType" placeholder="Product Type"><br>
            <input type="text" name="category" placeholder="Category"><br>
            <button type="submit" name="submit2">Edit</button>

            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p class='warn'>Fill in all the fields!</p>";
                    }
                    elseif($_GET["error"] == "stmtfaild"){
                        echo "<p class='warn'>Something went wrong please try again!</p>";
                    }
                }
            ?>
        </form>    
    </div>

    <?php if(isset($_SESSION["p_productsId"])){?>
    <div class="table">
        <table>
            <tr>
                <th>Product Id</th>
                <th>Image Path</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Product Description</th>
                <th>Product Type</th>
                <th>Category</th>
            </tr>
            <tr>
                <td><?php echo $_SESSION["p_productsId"]; ?></td>
                <td><?php echo $_SESSION["p_imagePth"]; ?></td>
                <td><?php echo $_SESSION["p_productName"]; ?></td>
                <td><?php echo $_SESSION["p_price"]; ?></td>
                <td><?php echo $_SESSION["p_productDesc"]; ?></td>
                <td><?php echo $_SESSION["p_productType"]; ?></td>
                <td><?php echo $_SESSION["p_category"]; ?></td>
            </tr>
        </table>
    </div>
    <?php }?>
    
    
</body>
</html>