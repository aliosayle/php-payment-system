<?php
include 'con.php';
if($_SESSION['username'] != "admin"){
    con.close();
}
$username = $_POST['username'];
$amount = $_POST['amount'];

// Update the user balance in the database
$query = "UPDATE `users` SET `balance` = balance + '$amount' WHERE `username` = '$username'";

if ($con->query($query) === TRUE) {
    echo "User balance updated successfully";
} else {
    echo "Error updating user balance: " . $con->error;
}

// Close the database connection
$con->close();
?>
