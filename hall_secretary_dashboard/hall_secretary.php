<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hall Secretary Dashboard</title>
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
            // get hall name from login page/pop-up
            $hall_sec_userName = "h01b5432";
            $hall_name = "Solomon Kalushi Mahlangu Hall";// $_REQUEST['hall_name'];

            // include database details from config.php file
            require_once("config.php");

            // attempt to make database connection
            $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

            // Check if connection was successful
            if ($connection->connect_error) {
                die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
            }

            // query instructions
            $sql = "SELECT * FROM ticket ORDER BY ticketID DESC;";
            $result = $connection->query($sql);

            // Get res names of hall overseen by the hall secretary
            $residences = 
                "SELECT DISTINCT concat(hall_secretary.f_Name, ' ', hall_secretary.l_name) AS 'hall_secretary_name', house_warden.resName AS 'residences'
                FROM house_warden JOIN hall_secretary ON hall_secretary.HS_userName = house_warden.HS_userName
                WHERE hall_secretary.HS_userName = '$hall_sec_userName';";
            $residences_result = $connection->query($residences);

            $pending_query = 
                "SELECT concat(f_Name, ' ', l_Name) AS 'full_name', t.resName, room_number, priority
                FROM student s JOIN ticket t ON s.userName = t.userName;";
            $pending_result = $connection->query($pending_query);

            // Check if query successful
            if ($result === FALSE || $pending_result === FALSE) {
                die("<p class=\"error\">Query was Unsuccessful!</p>");
            }
            
            // close connection
            $connection->close();
        // }
    ?>
    <div class="container">
        <!-- Sidebar section for navigation -->
        <aside class="sidebar">
            <!-- Logo section at the top of the sidebar -->
            <div class="logo">
                <h2>ResQue</h2>
            </div>
            
            <!-- Search bar in the sidebar -->
            <form action="hall_secretary_all_tickets.php" method="post" class="search">
                <span id="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input class="search-input" type="search" name="search-field" id="search-field" placeholder="Search">
            </form>
            
            <!-- Navigation menu in the sidebar -->
            <nav>
                <ul id="sidebar-nav">
                    <!-- Navigation links with icons -->

                    <?php
                        $sidebar_links = array("All Tickets", "Opened Tickets", "Closed Tickets", "Statistics");
                        $side_id = array("all-tickets", "open-tickets", "closed-tickets", "statistics" );
                        $side_image =  array("pictures/receipt-icon.png", "pictures/layer.png", "pictures/clipboard-tick.png","pictures/bar-chart-icon.png" );
                        $index = 0;

                        foreach ($sidebar_links as $link) {
                            
                            if ($index == 0) {
                                $default_link = $link;
                            }

                            $active_link = isset($_REQUEST['link_name']) ? $_REQUEST['link_name'] : $default_link;
                            $isActive = ($link === $active_link) ? 'active' : '';
                            echo "<li id={$side_id[$index]}><a class= 'sidebar-links {$isActive}' href='hall_secretary.php?link_name={$sidebar_links[$index]}'><img src={$side_image[$index]} alt='icon'>{$sidebar_links[$index]}</a></li>";
                            $index++;
                        }
                    ?>

                </ul>
            </nav>
    
            <!-- <hr id="sidebar-hr"> -->
    
            <!-- Profile section at the bottom of the sidebar -->
            <div class="profile">
                <!-- Profile picture area -->
                <div class="profile-pic">
                    <?php echo "AM";?>
                </div>
                <!-- Profile information area -->
                <div class="profile-info">
                    <span id="user-name" class="username"><?php echo "Derrick Aboagye"?></span><br>
                    <span class="role"><?php echo "Hall Secretary"?></span>
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
                <h1>Welcome, <span class="username"><?php echo '$hall_sec_name'?></span></h1>
                <p>Access & Manage maintenance requisitions efficiently.</p>
            </header>

            <!-- House selection links -->
            <nav class="houses">
                <?php
                    $active = 0;
                    while ($residence = $residences_result->fetch_assoc()) {
                        if ($active == 0) {
                            echo "<a href='#' class='house-link active'>{$residence['residences']}</a>";
                            $active++;
                            continue;
                        }
                        echo "<a href='#' class='house-link'>{$residence['residences']}</a>";
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
                            while ($row = $result->fetch_assoc())
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
                        ?>
                    </tbody>
                </table>
            </section>

            <!-- Maintenance requests section -->
            <!-- <section class="maintenance-requests maintenance-scrollbar">
                <header id="maintenance-requests-header">-->
                    <!-- Header with title and view all button -->
                    <!-- <h2 id="h2">Maintenance Requests</h2> -->
                    <!-- <button class="view-all">View all</button> -->
                <!-- </header> -->

                <!-- populate maintenance faults pending approval
                <div class="requests"> -->
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