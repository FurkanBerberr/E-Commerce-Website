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
    <title>Profile</title>
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

    <?php if($_SESSION["usertype"] == "admin"){ ?>

    <div class="adminProfile">
        <ul>
            <li><a href="signin.php">ADD USER</a></li>
            <li><a href="addproduct.php">ADD PRODUCT</a></li>
            <li><a href="deleteproduct.php">DELETE PRODUCT</a></li>
            <li><a href="editproduct.php">SEARCH AND EDIT PRODUCT</a></li>
        </ul>
    </div>

    <?php }else{ ?>
        <div class="form">
            <h2>Edit Profile</h2>
            <form action="includes/editProfile-inc.php">
                <input type="text" name="oldUserName" placeholder="Old Username"><br>
                <input type="text" name="userName" placeholder="Username"><br>
                <input type="text" name="email" placeholder="Email"><br>
                <input type="password" name="pswd" placeholder="Password"><br>
                <button type="submit" name="submit">Edit</button>
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
                }
            ?>
        </div>

    <?php } ?>
    
</body>
</html>