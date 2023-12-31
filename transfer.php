<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
            <label for="uname"><b>Username: </b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="amount"><b>Amount:</b></label>
            <input type="text" placeholder="Enter amount" name="amount" required>

            <input type="submit" value="Send" name='submit'>
        </form>
    <?php
    if (isset($_POST["submit"])) {
        include "con.php";

        $recieving_user = $_POST["uname"];
        $amount = $_POST["amount"];


        
        $stmt = $con->prepare("UPDATE users SET balance = balance + ? WHERE username = ?");
        $stmt->bind_param("ds", $amount, $recieving_user);
        
        $result = $stmt->execute();
        
        if ($result) {
            echo "Balance updated successfully.";
        } else {
            echo "Error updating balance: " . $stmt->error;
        }
        
        $stmt->close();
        $con->close();
    }


    

    ?>
</body>
</html>