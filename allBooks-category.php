<?php
session_start();
include "classes/db-classes.php";
$db = new Db();
$db = $db->create_db();
$stmt = $db->prepare("SELECT * FROM product WHERE products_type = 'book';");

// Checks is there any statement or sql error
if(!$stmt->execute()){
    $stmt = null;
    header("location: ../addproduct.php?error=stmtfaild");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Books for sale</title>
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

    <div class="products">
        <?php 
            $products = $stmt->fetchAll();
            foreach ($products as $row){
        ?>
            <form action="includes/shopingCard-inc.php" method="post">
                <div class="productCard">
                    <img src="<?php echo $row['products_image_pth'];?>">
                    <h3><?php echo $row['products_name'];?></h3>
                    <p>₺<?php echo $row['products_price'];?></p>
                    <p><?php echo $row['products_desc'];?></p>
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="hidden_id" value="<?php echo $row['products_id'];?>">
                    <input type="hidden" name="hidden_name" value="<?php echo $row['products_name'];?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['products_price'];?>">
                    <input type="hidden" name="hidden_category" value="<?php echo $row['products_category'];?>">
                    <?php
                        if(isset($_SESSION["useruid"])){
                            echo '<button type="submit" name="addCard">Add to Card</button>';}?>
                </div>
            </form>
        <!--Alerts the user about the errors-->
        <?php }
            if(isset($_GET["success"])){
                if($_GET["success"] == "1"){
                    echo "<p class='warn'>Added to the card!</p>";
                }
            }
        ?>
    </div>

    
</body>
</html>