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
    <ul class="categoryCard">
        <li>
            <div class="categories">
                <p>ALL BOOKS</p>
                <a href="allBooks-category.php"><img src="image/allbooks.jpg"></a>
            </div>
        </li>
        <li>
            <div class="categories">
                <p>HORROR BOOKS</p>
                <a href="horror-category.php"><img src="image/horror.jpg"></a>
            </div>
        </li>
        <li>
            <div class="categories">
                <p>ADVENTURE BOOKS</p>
                <a href="adventure-category.php"><img src="image/adventure.jpg"></a>
            </div>
        </li>
    </ul>

    
</body>
</html>