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
    <title>Sign In</title>
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

        <!--Checks for user user type which reach the sign in page.If user 
        is admin it will show add user. If it is user will show sign in-->
        <?php
            if(isset($_SESSION["useruid"])){
                echo "<h2>ADD USER</h2>";
            }else{
                echo "<h2>SIGN IN</h2>";
            }
        ?>
        <form action="includes/signin-inc.php">
            <input type="text" name="userName" placeholder="Username"><br>
            <input type="text" name="email" placeholder="Email"><br>
            <input type="password" name="pswd" placeholder="Password"><br>
            <input type="password" name="pswdRepeat" placeholder="Repeat the password"><br>

            <!--Checks for user user type which reach the sign in page.If user 
            is admin it will show add user. If it is user will show sign in-->
            <?php
                if(isset($_SESSION["useruid"])){
                    echo '<button type="submit" name="submit">Add user</button>';
                }else{
                    echo '<button type="submit" name="submit">Sign in</button>';
                }
            ?>

        </form>  

        <!--Alerts the user about the errors-->
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "emptyinput"){
                    echo "<p class='warn'>Fill in all the fields!</p>";
                }
                elseif($_GET["error"] == "invalidemail"){
                    echo "<p class='warn'>Invalid email please enter proper email!</p>";
                }
                elseif($_GET["error"] == "pswdnotmatch"){
                    echo "<p class='warn'>Password is not matching!</p>";
                }
                elseif($_GET["error"] == "userExist"){
                    echo "<p class='warn'>You already signed in!</p>";
                }
                elseif($_GET["error"] == "stmtfaild"){
                    echo "<p class='warn'>Something went wrong please try again!</p>";
                }
                elseif($_GET["error"] == "none"){
                    echo "<p class='warn'>Successfully signed in!</p>";
                }
            }
        ?>
    </div>

    
</body>
</html>