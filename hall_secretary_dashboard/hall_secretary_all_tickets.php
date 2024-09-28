<?php
    require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Secretary Dashboard | ResQue</title>
    <link rel="icon" type="image/x-icon" href="ResQue/hall_secretary_dashboard/pictures/finalLogo.png">
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
<body><!--<bo accesskey=""dy>-->

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
            
            $all_tickets_query = 
                "SELECT concat(f_Name, ' ', l_Name) AS 'full_name', t.resName, room_number, priority
                FROM student s JOIN ticket t ON s.userName = t.userName;";
            $all_tickets_query_results = $connection->query($all_tickets_query);

            // Check if query successful
            if ($residences_result === FALSE || !$all_tickets_query_results) {
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
                    
                    $active = 0;
                    while ($residence = $residences_result->fetch_assoc()) {
                        
                        if ($active == 0) {
                            $active++;
                            $defaulthouse = $residence['residences'];
                        }

                        $activeHouse = isset($_REQUEST['house_name']) ? $_REQUEST['house_name'] : $defaulthouse;
                        $isActive = ($residence['residences'] === $activeHouse) ? 'active' : '';
                        echo "<a href='hall_secretary_all_tickets.php?house_name={$residence['residences']}' class='house-link {$isActive}'>{$residence['residences']}</a>";
                    }
                ?>
            </nav>

            <!-- Ticket table section -->
            <section class="ticket-table"> <!--scrollbar"> -->
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
                                // get ticket information
                                $ticket_sql = "SELECT * FROM ticket  WHERE resName = '$housename' ORDER BY ticketID DESC;";
                                $ticket_result = $connection->query($ticket_sql);
                            }
                            else{
                                // get ticket information
                                $ticket_sql = "SELECT * FROM ticket  WHERE resName = '$defaulthouse' ORDER BY ticketID DESC;";
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
                                    // display ticket status
                                    switch (strtolower($row['ticket_status'])) {
                                        case "completed":
                                            echo "<td><span id='completed'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                                            break;
                                        case "rejected":
                                            echo "<td><span id='rejected'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                                            break;
                                        default:
                                            echo "<td><span class='status processing'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                                    }
                                    echo "<td>" . date("D h:ia", strtotime($row['ticketDate'])) . "</td>";
                                    echo "<td>{$row['category']}</td>";
                                    // display ticket priority
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
        </main>
    </div>
    <!-- Link to external JavaScript file -->
    <script src="hall_secretary_dashboard.js"></script>

</body>
</html>