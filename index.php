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

            .notification-dot {
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
            position: absolute;
            top: 0;
            right: 0;
            display: none; /* initially hidden */
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            position: relative;
        }
        
    </style>
</head>
<body>
    <?php
                include "con.php"; 
                session_start();
                $name = $_SESSION['username'];
                $name = ucfirst($name);
                $sql_get_requests = "SELECT * FROM payment_requests WHERE payee_id = '$name' AND status = 'pending'";
                $result_get_requests = $con->query($sql_get_requests);
    ?>
    <?php include "navbar.php"; ?>

    <?php
        if (!isset($_SESSION['username'])) {
            header('Location: login.php'); // Redirect to login page if not logged in
            exit();
        }
        $currentHour = date('H');

        // Define the greetings
        $greeting = '';
        
        if ($currentHour >= 5 && $currentHour < 12) {
            $greeting = 'Good morning';
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $greeting = 'Good afternoon';
        } else {
            $greeting = 'Good evening';
        }
        echo '<div class="welcome text-center">'. $greeting . " " . $name . '!</div>';
?>
    

    <div class="container mt-5 mb-5">
        <div class="card text-center">
            <div class="card-body">
                <h2 class="card-title">Your Balance:</h2><hr>
                <p class="balance-amount">  <?php
                include "con.php";
                $username = $_SESSION['username'];
                $sql3 = "SELECT balance FROM users WHERE username='$username'";
                
                // Execute the query
                $result = $con->query($sql3);
                
                // Check if a balance was found
                if ($result->num_rows > 0) {
                    // Fetch the balance
                    $row = $result->fetch_assoc();
                    $balance = $row["balance"];
                    
                    echo "\$$balance";
                } else {
                    echo "Error";
                }
            ?></p>
                <a href="transactions.php"><button class="btn btn-primary mb-2 transaction-button">View Transactions</button></a>
                <div class="btn-group" role="group">
                    <div class="actions"><a href="transfer.php"><button class="btn btn-light request-button">Transfer</button></a></div>
                    <div class="actions"><a href="request.php"><span class="notification-dot"></span><button class="btn btn-light request-button">Request</button></a></div>
                </div>
            </div>
        </div>
        <div class="welcome-container"></div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var notificationDot = document.querySelector('.notification-dot');
        <?php
            if ($result_get_requests->num_rows > 0) {
                echo 'notificationDot.style.display = "block";';
            }
        ?>
    });
</script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body> 
</html>

