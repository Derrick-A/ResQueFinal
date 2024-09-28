<?php

    require_once("secure.php");

    if (isset($_SESSION['username'])) {
        // echo 'Session Username: ' . $_SESSION['username'];
        $MaintenanceID = $_SESSION['username'];
    }else {
        die("User is not logged in.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Staff</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
    <!-- Link to the external CSS files -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />    
    <link rel="stylesheet" href="maintenance.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

               
        // include database details from config.php file
        require_once("config.php");

        // attempt to make database connection
        $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
        }

        // query instructions
        $sql = "SELECT * FROM ticket;-- WHERE ticket_status = 'Processing'";
        $result = $connection->query($sql);

        // Check if query successfull
        if ($result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }
        
        // close connection
        $connection->close();
    ?>
<!-- <div class="container"> -->
    <!-- Sidebar section for navigation -->
    <aside class="sidebar">
        <!-- Logo section at the top of the sidebar -->
        <div class="logo">
            <h2>ResQue</h2>
        </div>
        
        <!-- Search bar in the sidebar -->
        <form action="maintenance_all_tickets.php" method="post" class="search">
            <span id="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
            <input class="search-input" type="search" name="search-field" id="search-field" placeholder="Search">
        </form>
        
        <!-- Navigation menu in the sidebar -->
        <nav>
            <ul id="sidebar-nav">
                <!-- Navigation links with icons -->
                <li id="all-tickets"><a class="sidebar-links active" href="maintenance_all_tickets.php"><img src="pictures/receipt-icon.png" alt="receipt icon">All Tickets</a></li>
                <li id="open-tickets"><a class="sidebar-links" href="maintenance_opened_tickets.php"><img src="pictures/layer.png" alt="layer">Opened Tickets</a></li>
                <li id="closed-tickets"><a class="sidebar-links" href="maintenance_closed_tickets.php"><img src="pictures/clipboard-tick.png" alt="clipboard-tick">Closed Tickets</a></li>
                <!-- <li id="statistics"><a class="sidebar-links" href="#"><img src="pictures/bar-chart-icon.png" alt="bar chart icon">Statistics</a></li> -->
            </ul>
        </nav>

        <!-- <hr id="sidebar-hr"> -->

        <!-- Profile section at the bottom of the sidebar -->
        <div class="profile">
            <!-- Profile picture area -->
            <div class="profile-pic">
                <?php echo "Staff";?>
            </div>
            <!-- Profile information area -->
            <div class="profile-info">
                <span id="user-name" class="username"><?php echo "Staff Member"?></span><br>
                <span class="role"><?php echo "Maintenance"?></span>
            </div>
            <!-- Logout button with icon -->
            <div id="sidebar-log-out">
                <a href="#"><i class="fa-solid fa-arrow-right-from-bracket fa-xl" style="color: #B197FC;"></i></a>
            </div>
        </div>
    </aside>

    <!-- Main content area -->
    <main class="content">
        <header class="page-header">
            <!-- Welcome message -->
            <h1>Welcome, <span class="username"><?php echo "Staff Member"?></span></h1>
            <p>Access & Manage maintenance requisitions efficiently.</p>
        </header>

        <!-- House selection links -->
        <nav class="houses">
            <a href="#" class="house-link active">Cory House</a>
            <a href="#" class="house-link">Botha House</a>
            <a href="#" class="house-link">Matthews House</a>
            <a href="#" class="house-link">College House</a>
        </nav>

        <!-- Ticket table section -->
        <section class="ticket-table scrollbar">
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
                        while ($row = $result->fetch_assoc())
                        {
                            echo "<tr><td>#{$row['ticketID']}</td>";
                            echo "<td>{$row['ticket_description']}</td>";
                            // if ($row['ticket_status'] == "Processing") {
                            echo "<td><span class='status processing'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
                            // }
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
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <!-- </div> -->
</body>
</html>