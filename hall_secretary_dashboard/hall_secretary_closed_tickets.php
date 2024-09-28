<?php
    require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Secretary Dashboard | ResQue</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="hall_secretary_dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Link to the FontAwesome library for icons -->
    <script src="https://kit.fontawesome.com/ddbf4d6190.js" crossorigin="anonymous"></script>
    <style>
        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <?php
        // if (isset(($_REQUEST['submit']))) {
            // get hall_sec username from login page/pop-up
            $hall_sec_userName = $_SESSION['username'];
    
            // include database details from config.php file
            require_once("config.php");

            // attempt to make database connection
            $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

            // Check if connection was successful
            if ($connection->connect_error) {
                die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
            }



            // Get res names of hall overseen by the hall secretary
            $residences = 
            "SELECT DISTINCT concat(hall_secretary.f_Name, ' ', hall_secretary.l_name) AS 'hall_secretary_name', resName AS 'residences'
            FROM residence JOIN hall_secretary ON hall_secretary.hall_name = residence.hall_name
            WHERE hall_secretary.HS_userName = '$hall_sec_userName';";

            $residences_result = $connection->query($residences);


            // COMMENTED OUT PENDING on CLOSED TICKETS PAGE

            // $pending_query = 
            //     "SELECT concat(f_Name, ' ', l_Name) AS 'full_name', t.resName, room_number, priority
            //     FROM student s JOIN ticket t ON s.userName = t.userName;";
            // $pending_result = $connection->query($pending_query);

            // Check if query successful
            if ($residences_result === FALSE) { // || $pending_result === FALSE) {
                die("<p class=\"error\">Query was Unsuccessful!</p>");
            }
            

        // }
    ?>
    <div class="container">
        <!-- Sidebar section for navigation -->
        <?php require_once("sidebarHallSec.php"); ?>

        <!-- Main content area -->
        <main class="content">
            <header class="page-header">
                <!-- Welcome message -->
                <h1>Welcome, 
                    <span class="username"><?php //echo $_SESSION['first_name']; ?></span>
                </h1>
                <p>Access & Manage maintenance requisitions efficiently.</p>
            </header>

            <!-- House selection links -->
            <nav class="houses">
                <?php
                    $defaulthouse = '';
                    $active = 0;
                    while ($residence = $residences_result->fetch_assoc()) {
                        
                        if ($active == 0) {
                            $active++;
                            $defaulthouse = $residence['residences'];
                        }

                        $activeHouse = isset($_REQUEST['house_name']) ? $_REQUEST['house_name'] : $defaulthouse;
                        $isActive = ($residence['residences'] === $activeHouse) ? 'active' : '';
                        echo "<a href='hall_secretary_closed_tickets.php?house_name={$residence['residences']}' class='house-link {$isActive}'>{$residence['residences']}</a>";
                    }
                ?>
            </nav>

            <!-- Ticket table section -->
            <section class="ticket-table"> <!--scrollbar">-->
                <table>
                    <thead>
                        <!-- Table headers -->
                        <tr>
                            <th>Ticket Number</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- populate dashboard board with tickets from database -->
                        <?php
                            if(isset($_REQUEST['house_name'])){
                                $housename = $_REQUEST['house_name'];
                                // get information of Reject and Completed
                                $ticket_sql = "SELECT * FROM ticket WHERE ticket_status = 'Closed' AND resName = '$housename' ORDER BY ticketID DESC;";
                                $ticket_result = $connection->query($ticket_sql);
                            }
                            else{
                                $ticket_sql = "SELECT * FROM ticket WHERE ticket_status = 'Closed' AND resName = '$defaulthouse' ORDER BY ticketID DESC;";
                                $ticket_result = $connection->query($ticket_sql);
                            }

                            if ($ticket_result === FALSE) {
                                die("<p class=\"error\">Query was Unsuccessful!</p>");
                            }

                            if ($ticket_result->num_rows > 0) {
                                while ($row = $ticket_result->fetch_assoc())
                                {
                                    echo "<tr><td>#{$row['ticketID']}</td>";
                                    echo "<td>{$row['ticket_description']}</td>";
                                    if (strtolower($row['ticket_status']) == "completed") {
                                        echo "<td><span id='completed'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                                    }
                                    else {
                                        echo "<td><span id='rejected'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                                    }
                                    echo "<td>" . date("D h:ia", strtotime($row['ticketDate'])) . "</td>";
                                    echo "<td>{$row['category']}</td>";
                                    switch (strtolower($row['priority'])) {
                                        case "high":
                                            echo "<td><span class='priority high-risk'><span class='circle'></span>&nbsp;&nbsp;High</span></td></tr>";
                                            break;
                                        case "medium":
                                            echo "<td><span class='priority medium-risk'><span class='circle'></span>&nbsp;&nbsp;Medium</span></td></tr>";
                                            break;
                                        default:
                                            echo "<td><span class='priority low-risk'><span class='circle'></span>&nbsp;&nbsp;Low</span></td></tr>";
                                    }
                                }
                            }
                            else {
                                echo "<tr><td> <p> No Tickets Available </p></td></tr>";
                            }
                            // close connection
                            $connection->close();
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Maintenance requests section
            <section class="maintenance-requests maintenance-scrollbar">
                <header id="maintenance-requests-header"> -->
                    <!-- Header with title and view all button -->
                    <!-- <h2 id="h2">Maintenance Requests</h2> -->
                    <!-- <button class="view-all">View all</button> -->
                <!-- </header> -->

                <!-- populate maintenance faults pending approval -->
                <!-- <div class="requests"> -->
                    <?php 
                        // while ($row = $pending_result->fetch_assoc())
                        // {
                        //     echo "<article class='request'>
                        //             <div class='request-top-btns request-btns'>
                        //                 <!-- Buttons for commenting and deleting a request -->
                        //                 <button class='comment-btn'><i class='fa-solid fa-pen'></i>&nbsp;&nbsp;&nbsp;Comment</button>
                        //                 <button class='delete-btn'><i class='fa-solid fa-trash' style='color: #e53e3e;'></i>&nbsp;&nbsp;&nbsp;Delete</button>
                        //             </div>
                        //             <!-- Request information -->
                        //             <div class='request-info'>";
                        //     echo    "<p><strong>{$row['full_name']}<strong></p>";
                        //     echo       "<p>Residence: <strong>{$row['resName']}<strong></p>";
                        //     echo       "<p>Room Number: <strong>{$row['room_number']}<strong></p>";
                        //     echo       "<p>Priority: <strong>{$row['priority']}<strong>";
                        //     echo       "<button class='approve-btn request-btns'><i class='fa-solid fa-plus' style='color: #a020f0;'></i>&nbsp;&nbsp;&nbsp;Approve Request</button></p>";
                        //     echo    "</div></article>";
                        // }
                    ?>
                <!-- </div>
            </section> -->
        </main>
    </div>
    <!-- Link to external JavaScript file -->
    <script src="hall_secretary_dashboard.js"></script>

</body>
</html>