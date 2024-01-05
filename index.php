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
        
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center p-2">
        <h1>PayOne</h1>
    </header>
    <?php
                include "con.php"; 
                session_start();
                $name = $_SESSION['username'];
                $name = ucfirst($name);
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-center">
                    <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Balance</a></li>
                    <li class="nav-item"><a class="nav-link" href="transfer.php">Transfer</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

        echo '<div class="welcome text-center">Welcome ' . $name . '!</div>';
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
                <button class="btn btn-primary mb-2 transaction-button">View Transactions</button>
                <div class="btn-group" role="group">
                    <a href="transfer.php"><button class="btn btn-light request-button">Transfer</button></a>
                    <button class="btn btn-light request-button">Request</button>
                </div>
            </div>
        </div>
        <div class="welcome-container"></div>
    </div>

    <!-- Bootstrap JS and Popper.js are required for some Bootstrap features -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body> 
</html>

