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
    <title>Log In</title>
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
        <form action="includes/order-inc.php">
            <label>Name Surname:</label><br>
            <input name="name" type="text" placeholder="Name Surname"><br>
            <label>Address:</label><br>
            <input name="address" type="text" placeholder="Neighborhood, Street (Avenue) No, Apt. Name, etc."><br>
            <label>Country:</label><br>
            <input name="country" type="text" placeholder="Country"><br>
            <label>City:</label><br>
            <input name="city" type="text" placeholder="City"><br>
            <label>Payment Method:</label><br>
            <select name="payment">
                <option value="transfer">Wire Transfer</option>
                <option value="card">Credit Card</option>
            </select><br>
            <button type="submit" name="submit">Complete Payment</button>
        </form>
        
        <!--Alerts the user about the errors-->
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyinput"){
                    echo "<p class='warn'>Fill in all the fields!</p>";
                }if($_GET["error"]=="none"){
                    echo "<p class='warn'>Order successfull!</p>";
                }
            }
        ?>
    </div>
    
</body>
</html>