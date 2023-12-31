<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Log In</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <input type="submit" value="Log In" name='submit'>
            <div class="alt"><h4>Don't have an account yet? <a href="sign.php">Sign up</a></h4></div>
        </form>

        <div class="message-container">
            <?php
            if(isset($_POST["submit"])) {
                $user = $_POST["uname"];
                $pass = $_POST["psw"];
                
                include 'con.php';

                $query = "SELECT * FROM users WHERE username = '$user'";
                $result = mysqli_query($con, $query);
                
                $arr = mysqli_fetch_assoc($result);

                if ($result->num_rows > 0) {
                    if($pass === $arr["password"]){
                        echo '<p class="success-message">Log in success</p>';
                        header("Location: index.php");
                        session_start();
                        $_SESSION['username'] = $user;

                    } else {
                        echo '<p class="error-message">Wrong password</p>';
                    }
                } else {
                    echo '<p class="error-message">Username not found</p>';
                }
                
                mysqli_close($con);
            }
            ?>
        </div>
    </div>
</body>
</html>
