<?php
    session_start();
    $username = $_SESSION['username'];
    include "con.php";
    $sql = "SELECT * FROM transactions WHERE sending_user = '$username' ORDER BY 'date' ASC";
    $result = mysqli_query($con, $sql);
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
                    /* table {
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
                    } */
                
            </style>
    <title>Past Transactions</title>
</head>
<body>
        
    <?php include "navbar.php"; ?>

    <h2>Past transactions of <?php echo $username; ?></h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Transaction ID</th><th>Sent to</th><th>Amount</th><th>Date</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['transaction_id'] . "</td>";
            echo "<td>" . $row['recieving_user'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
       echo "No past transactions found.";
   }

    $con->close();
    ?>

</body>
</html>
