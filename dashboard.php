<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Balance</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<script>
$(document).ready(function(){
    // Function to handle the form submission
    $("#updateBalanceForm").submit(function(event){
        // Prevent the default form submission
        event.preventDefault();

        // Get the values entered by the user
        var username = $("#username").val();
        var amount = $("#amount").val();

        // AJAX request to update the user balance
        $.ajax({
            type: "POST",
            url: "update_balance.php", // Change this to the actual path of your PHP file
            data: { 
                username: username,
                amount: amount
            },
            success: function(response){
                // Handle the response from the server (if needed)
                console.log(response);
            },
            error: function(error){
                // Handle any errors that occur during the AJAX request
                console.log(error);
            }
        });
    });
});
</script>

<form id="updateBalanceForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="amount">Amount:</label>
    <input type="text" id="amount" name="amount" required>

    <button type="submit">Update Balance</button>
</form>

</body>
</html>
