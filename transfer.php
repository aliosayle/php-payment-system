<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayOne</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        
.welcome-container {
            display: flex;
            justify-content: center;
        }

        body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    margin: 0;
    background: #f6f6f6;
}

.container {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card {
    margin-top: 50px;
    margin: auto;
}

        header {
            background-color: #1a237e; 
            padding: 2px;
            text-align: center;
            color: #ffffff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: center;
            background: #1a237e; 
            padding: 10px 0; /* Adjust top and bottom padding */
            margin: 0; /* Remove default margin */
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }


        nav a {
            color: #ffffff;
            position: relative;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: 2px solid transparent;
            width: 120px;
            align-items: center;
        }


        nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
            text-decoration: none;  /* Remove underline */
            color: #ffffff;
        }

        .profile-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #ffffff;
            font-size: 24px;
        }
        .welcome{
            font-size: 40px;
            margin: 12px;
            justify-content: center;
            display: flex;
        }

        .balance-amount{
            font-size: 50px;
            margin: 50px;
            color: black;
        }

        .card-title{
            align-items: left;
            align: left;
            display: flex;
            font-size: 20px;
            color: grey;
        }
            nav {
                flex-direction: column;
                align-items: center;
            }

            nav a {
                margin: 5px 0;
            }

            .transaction-button,
            .request-button {
                width: 100%; /* Make buttons full width on small screens */
            }
            .navbar{
                margin-bottom: 8px;
            }
        
    </style>
</head>
<body>
        <?php include "navbar.php"; ?>
        
        <table>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
            <tr>
                <td><label for="uname"><b>Username:</b></label></td>
                <td><input type="text" placeholder="Enter Username" name="uname" required></td>
            </tr>
            <tr>
                <td><label for="amount"><b>Amount:</b></label></td>
                <td><input type="number" placeholder="Enter amount" name="amount" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" value="Send" name='submit'>
                </td>
            </tr>
        </form>
    </table>
    <?php
    session_start();
    if (isset($_POST["submit"])) {
        include "con.php";
        


        $sending_user = $_SESSION["username"];
        $recieving_user = $_POST["uname"];
        $amount = $_POST["amount"];
        
        $getnames = "SELECT * FROM users WHERE username='$recieving_user'";
        $names = mysqli_query($con, $getnames);

        if ($names->num_rows == 0) {
            echo "User not found!";
            $con->close();
        }

        $query = "SELECT balance FROM users WHERE username = '$sending_user'";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $balance0 = $row["balance"];
        
        } else {
            echo "Error: " . mysqli_error($con);
        }
        

        if($balance0 >= $amount){

            $stmt = $con->prepare("UPDATE users SET balance = balance + ? WHERE username = ?");
            $stmt->bind_param("ds", $amount, $recieving_user);

            $stmt2 = $con->prepare("UPDATE users SET balance = balance - ? WHERE username = ?");
            $stmt2->bind_param("ds", $amount, $sending_user);
            
            $result = $stmt->execute();
            $result2 = $stmt2->execute();

            if ($result && $result2) {
                echo "\$$amount has been sent succesfully to $recieving_user.";
            } else {
                echo "An error has occured: " . $stmt->error;
            }
            
            $stmt->close();
            $con->close();
        }else{
            echo "Not enough money in balance!";
        }
    }


    

    ?>
</body>
</html>