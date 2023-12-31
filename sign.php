<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>sign up</title>
</head>
<body>

<div class="container">
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">    
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <label for="gender"><b>Gender</b></label>
            <select id="gender" name="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="dob"><b>Date of Birth</b></label>
            <input type="date" name="dob" required>
            <div class="alt"><h4>Already have an account? <a href="log.php">Log in</a></h4></div>
            <input type="submit" value="Sign Up" name='submit'>
        </form>
        <div class="message-container">
        <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
                $user = $_POST["uname"];
                $password = $_POST["psw"];
                $gender = $_POST["gender"];
                $dob = $_POST["dob"];

                if($gender=='male'){
                    $gender = 'M';
                }
                else{
                    $gender = "F";
                }
                include 'con.php';

                $query1 = "SELECT * FROM users WHERE username='$user'";
                $result = mysqli_query($con, $query1);
                
                if ($result->num_rows == 0) {
                    $query = "INSERT INTO users (username, password, dob, gender) VALUES ('$user', '$password', '$dob', '$gender')";

                    if(mysqli_query($con, $query)){
                        echo "Records added successfully.";
                        header("Location: log.php");
                    } else{
                        echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
                    }
                }else{
                    echo '<p class="error-message">Username already taken</p>';
                }
                    
                mysqli_close($con);

            }  
            ?>
        </div>
    </div>
</body>
</html>