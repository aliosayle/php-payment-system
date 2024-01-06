<?php
include 'con.php';
session_start();
$paying_user = $_SESSION['username']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept_request'])) {
        $receiving_user = $_POST['request_id'];
        $amount = $_POST['amount'];
        $query_balance = "SELECT balance FROM users WHERE username = '$paying_user'";
        $result_balance = mysqli_query($con, $query_balance);
        
        if ($result_balance) {
            $row = mysqli_fetch_assoc($result_balance);
            $balance0 = $row["balance"];
            if ($row) {
                $balance0 = $row["balance"];
            } else {
                echo "No balance found for the username: $sending_user";
            }
        
        } else {
            echo "Error: " . mysqli_error($con);
        }
        

        if($balance0 >= $amount){

            $stmt = $con->prepare("UPDATE users SET balance = balance + ? WHERE username = ?");
            $stmt->bind_param("ds", $amount, $recieving_user);
            $stmt2 = $con->prepare("UPDATE users SET balance = balance - ? WHERE username = ?");
            $stmt2->bind_param("ds", $amount, $sending_user);
            $date = date("Y-m-d H:i:s");
            $stmt3 = "INSERT INTO transactions (sending_user, recieving_user, amount, date) VALUES ('$sending_user', '$recieving_user', '$amount', '$date');";
            $result = $stmt->execute();
            $result2 = $stmt2->execute();
            mysqli_query($con, $stmt3);

            if ($result && $result2) {
                echo "\$$amount has been sent succesfully to $recieving_user.";
            } else {
                echo "An error has occured: " . $stmt->error;
            }
        $sql_accept = "UPDATE payment_requests SET status = 'approved' WHERE request_id = '$request_id'";
        mysqli_query($con, $sql_accept);
        }
    } elseif (isset($_POST['decline_request'])) {
        $request_id = $_POST['request_id'];
        // Perform logic to handle declined request (update status to 'rejected', notify user, etc.)
        // Example: $sql = "UPDATE payment_requests SET status = 'rejected' WHERE request_id = '$request_id'";
    }
}




// Fetch money requests for the logged-in user
$sql = "SELECT * FROM payment_requests WHERE payee_id = '$requester_id' AND status = 'pending'";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        



        
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
                    .accept-btn, .decline-btn {
                        padding: 8px;
                        cursor: pointer;
                    }

                    .accept-btn {
                        background-color: #4caf50;
                        color: #fff;
                    }

                    .decline-btn {
                        background-color: #f44336;
                        color: #fff;
                    }
                    </style>
                
</head>
<body>
<?php include "navbar.php"; ?>

<h2>Money Requests</h2>

<?php
if ($result->num_rows > 0) {
    echo '<table>';
    echo '<tr><th>From</th><th>Amount</th><th>Actions</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['requester_id'] . '</td>';
        echo '<td>' . $row['amount'] . '</td>';
        echo '<td class="actions">';
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">';
        echo '<input type="hidden" name="request_id" value="' . $row['request_id'] . '">';
        echo '<button class="accept-btn" type="submit" name="accept_request">Accept</button>';
        echo '<button class="decline-btn" type="submit" name="decline_request">Decline</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No pending money requests.';
}
?>

</body>
</html>
