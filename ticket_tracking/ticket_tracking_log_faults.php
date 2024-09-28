<?php
// Start the session
session_start();

// Include database details from config.php file
require_once("../config.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store the userID in the session
    $_SESSION['userID'] = $_POST['userID'];
}

// Get userID from session or set default value
$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';
                    
// attempt to make database connection
$connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

// Check if connection was successful
if ($connection->connect_error) {
    die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Tracking</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
    <link rel="stylesheet" href="ticket_tracking.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ddbf4d6190.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">

        <!--Sidebar section for navigation-->
        <?php require_once("sidebarStudent.php"); ?>

        <!-- Main Ticket Tracking section -->
        <main class="content">
            <header>
                <div>
                    <h1>Ticket Tracking<br></h1>
                    <p class="fade-out">View and make comments on all your logged tickets. View all your residence's tickets.</p>
                </div>
                <!-- Fix the logo size -->
                 <div class="logo-container">
                    <img src="pictures/resque-logo.png" alt="Logo" width="150" height="110">
                </div>
            </header>

            <!--  TEMPORARY Form for userID input  -->
            <section class="user-id-input">
                <h3>Enter User ID to View Tickets</h3>
                <form action="ticket_tracking_all.php" method="POST">
                    <label for="userID">User ID:</label>
                    <input type="text" id="userID" name="userID" required>
                    <button type="submit">Submit</button>
                </form>
            </section>
            <br><br>

            <!-- Flex container for the ticket list and ticket detail -->
            <div class="content-wrapper">
                <!-- Section for the list of tickets -->
                <section class="ticket-list">
                    <!-- <a href="../ticket_creation/ticketCreation.html"><button class="add-ticket">+ Add New Ticket</button></a>
                    <br> -->
                    <h3>Your Tickets</h3>
                    <?php

                        //query instructions for the student's tickets
                        $sql = "SELECT ticketID, resName, ticket_status FROM systemsurgeons.ticket where userName = '$userID'";
                        $result = $connection -> query($sql); //execute query

                        // Check if query successfull
                        if ($result === FALSE) {
                            die("<p class=\"error\">Your Tickets Query was Unsuccessful!</p>");
                        }
                    
                        //display the student's tickets
                        echo "<table class='ticket-table'>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='ticket-card'>";
                            echo "<td class='ticket-number'><img src='pictures/clipboard-tick.png' alt='clipboard-tick' style='margin-right: 10px;'>#{$row['ticketID']}</td>";
                                
                                // Determine the CSS class based on the ticket_status so the correct color is produced
                                if ($row['ticket_status'] == "Pending") {
                                    $statusClass = "status pending";
                                } elseif ($row['ticket_status'] == "Processing") {
                                    $statusClass = "status processing";
                                } elseif ($row['ticket_status'] == "Completed") {
                                    $statusClass = "status completed";
                                } elseif ($row['ticket_status'] == "Rejected") {
                                    $statusClass = "status rejected";
                                } else {
                                    $statusClass = "status"; // Default class if needed
                                }
                                
                            //store residence name to use in Residence Tickets section
                            $residence = $row['resName'];

                            echo "<td><span class='{$statusClass}'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                            echo "<td><a href='ticket_tracking_all.php?ticketID={$row['ticketID']}' class='details-button'>View Details</button></a></td>";
                            echo "</tr>";
                        } //end table
                        echo "</table>";
                    ?>

                    <?php
                    echo "<h3>$residence Tickets</h3>";

                        //query instructions for all tickets within the same residence
                        $sql = "SELECT ticketID, resName, ticket_status FROM systemsurgeons.ticket where resName = '$residence'";
                        $result = $connection -> query($sql); //execute query

                        // Check if query successfull
                        if ($result === FALSE) {
                            die("<p class=\"error\">Residence Tickets Query was Unsuccessful!</p>");
                        }

                        //dynamically display all tickets within that residence
                        echo "<table class='ticket-table'>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='ticket-card'>";
                            echo "<td class='ticket-number'><img src='pictures/clipboard-tick.png' alt='clipboard-tick' style='margin-right: 10px;'>#{$row['ticketID']}</td>";
                                
                                // Determine the CSS class based on the ticket_status so the correct color is produced
                                if ($row['ticket_status'] == "Pending") {
                                    $statusClass = "status pending";
                                } elseif ($row['ticket_status'] == "Processing") {
                                    $statusClass = "status processing";
                                } elseif ($row['ticket_status'] == "Completed") {
                                    $statusClass = "status completed";
                                } elseif ($row['ticket_status'] == "Rejected") {
                                    $statusClass = "status rejected";
                                } else {
                                    $statusClass = "status"; // Default class if needed
                                }

                            echo "<td><span class='{$statusClass}'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                            echo "<td><a href='ticket_tracking_all.php?ticketID={$row['ticketID']}' class='details-button'>View Details</button></a></td>";
                            echo "</tr>";
                        } //end table
                        echo "</table>";
                    ?>

                </section>
                

                <!-- Section for the detailed view of a single ticket -->
                <section class="ticket-detail">
                    <article class="ticket-info">
                        <img src="pictures/leak.jpg" alt="Ticket Image">
                        <h3>Ticket Details</h3>
                        <?php

                            // Check if a ticketID is provided via GET request
                            if (isset($_GET['ticketID'])) {
                                $ticketID = $_GET['ticketID'];

                            //query instructions for the student's tickets
                            $sql = "SELECT ticketID, resName, ticket_status, ticketDate, ticket_description, category, priority  FROM systemsurgeons.ticket where ticketID = '$ticketID'";
                            $result = $connection -> query($sql); //execute query

                            // Check if query successfull
                            if ($result === FALSE) {
                                die("<p class=\"error\">Could not connect to database to get ticket details!</p>");
                            }

                            if($result -> num_rows > 0) {
                                $ticket = $result->fetch_assoc(); //get related ticket details

                            //display the ticket details for the specific ticket
                            echo "<table class='ticket-table'>";

                            echo "<table class='info-table'>";
                            echo "<tr>";
                            echo "<td class='info-cell' colspan='3'>";
                                echo "<span class='info-label'>Description:</span>";
                                echo "<span class='info-data'>{$ticket['ticket_description']}</span>";
                            echo "</td>";
                        echo "</tr>";
                            echo "<tr>";
                            echo "<td class='info-cell'>";
                                echo "<span class='info-label'>Ticket Number:</span>";
                                echo "<span class='info-data'>#{$ticket['ticketID']}</span>";
                            echo "</td>";
                            echo "<td class='info-cell'>";
                                echo "<span class='info-label'>Residence:</span>";
                                echo "<span class='info-data'>{$ticket['resName']}</span>";
                            echo "</td>";
                            echo "<td class='info-cell'>";
                                echo "<span class='info-label'>Category:</span>";
                                echo "<span class='info-data'>{$ticket['category']}</span>";
                            echo "</td>";
                            echo "<tr>";
                            echo "<td class='info-cell'>";
                                echo "<span class='info-label'>Date Logged:</span>";
                                echo "<span class='info-data'>{$ticket['ticketDate']}</span>";
                            echo "</td>";
                            echo "<td class='info-cell'>";
                                echo "<span class='info-label'>Priority:</span>";
                                echo "<span class='info-data'>{$ticket['priority']}</span>";
                            echo "</td>";
                        echo "</tr>";
                        echo "</table>";
                            }
                            else {
                                echo "<p>No details found for this ticket.</p>";
                            }
                        }
                        else {
                            echo "<p>Please select a ticket to view its details.</p>";
                        }
                        ?>
                    </article>
                </section>
            </div>
        </main>


    </div>
    <!-- Link to external JavaScript file -->
    <script src="ticket_tracking.js"></script>
</body>
</html>

<?php $connection->close(); ?>
