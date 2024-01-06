<?php

include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payee_id = $_POST['payee_id'];
    $amount = $_POST['amount'];


    session_start();
    $requester_id = $_SESSION['username'];

    // Insert data into payment_requests table
    $sql = "INSERT INTO payment_requests (requester_id, payee_id, amount) VALUES ('$requester_id', '$payee_id', '$amount')";

    if ($con->query($sql) === TRUE) {
        echo "Payment request submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        width: 100%;
                    }
                    .navbar{
                        margin-bottom: 8px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    th, td {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
   

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: blue;
            color: #fff;
            cursor: pointer;
        }
                
            </style>
    <title>Money Request Form</title>
</head>
<body>
<?php include "navbar.php"; ?>


<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <h2>Money Request Form</h2>

    <label for="payee_id">Request From: </label>
    <input type="text" name="payee_id" required>

    <label for="amount">Amount: </label>
    <input type="number" name="amount" step="0.01" required>

    <input type="submit" value="Request Money">

</body>
</html>
