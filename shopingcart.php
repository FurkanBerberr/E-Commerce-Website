<?php
session_start();
if(isset($_GET["action"])){
    if($_GET["action"]=="clear"){
        unset($_SESSION["shopping_cart1"]);
    }
    if($_GET["action"]=="delete"){
        foreach($_SESSION["shopping_cart1"] as $keys => $values){
            if($values['item_id'] == $_GET["id"]){
                unset($_SESSION["shopping_cart1"][$keys]);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/style.css">
    <title>Shoping Cart</title>
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

    <div class="table">
        <table>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
                if(isset($_SESSION["shopping_cart1"])){
                    $total = 0;
                    $session_array = $_SESSION["shopping_cart1"];
                    foreach($session_array as $keys => $values){
            ?>

            <tr>
                <td><?php echo $values['item_name'];?></td>
                <td><?php echo $values['item_quantity'];?></td>
                <td>₺ <?php echo $values['item_price'];?></td>
                <td>₺ <?php echo number_format($values['item_quantity'] * $values['item_price'], 2) ;?></td>
                <td><a href="shopingcart.php?action=delete&id=<?php echo $values['item_id'];?>">Remove</a></td>
            </tr>

            <?php
                $total = $total + ($values['item_quantity'] * $values['item_price']);
                    }
            ?>
            <tr>
                <td colspan='3'>Total</td>
                <td >₺ <?php echo number_format($total, 2); ?></td>
                <td><a href="shopingcart.php?action=clear">Clear Chart</a></td>
            </tr>
            <tr>
                <td colspan='5'><a href="payment.php">Go to pay</a></td>
            </tr>
            <?php
                }else{
                    echo "<tr>
                    <td colspan='5'>No product in cart!</td>
                    </tr>";
                }
            ?>
        </table>
    </div>

    
</body>
</html>