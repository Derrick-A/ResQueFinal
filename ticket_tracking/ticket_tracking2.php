<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
    <?php
        // include database details from config.php file
        require_once("../config.php");

        // attempt to make database connection
        $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
        }

        //Storing the userID value
        $userID = isset($_POST['userID'])? $_POST['userID'] : '';

        // Query to fetch tickets for the given userID
        $sql = "SELECT * FROM tickets WHERE userName = $userID";
        $result = $connection -> query($sql); //execute query

        // Check if query successfull
        if ($result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }

        // Fetch tickets and generate HTML output
        $tickets_html = '';
        while ($ticket = $result->fetch_assoc()) {
            $tickets_html .= '<tr class="ticket-card">
                        <td class="ticket-number"><img src="pictures/clipboard-tick.png" alt="clipboard-tick" style="margin-right: 10px;">' . htmlspecialchars($ticket['ticket_number']) . '</td>
                        <td><span class="status ' . htmlspecialchars($ticket['status']) . '"><span class="circle"></span>&nbsp;&nbsp;' . htmlspecialchars($ticket['status']) . '</span></td>
                        <td><button class="details-button" onclick="showDetails(\'' . htmlspecialchars($ticket['ticket_number']) . '\')">View Details</button></td>
                      </tr>';
        }

        // Close connection
        $connection->close();
    ?>

    <h3>Your Tickets</h3>
    <table class="ticket-table">
        <?php echo $tickets_html; ?>
    </table>


</body>
</html>