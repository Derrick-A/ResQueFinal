<?php
    require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>House Warden</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="house_warden.css">
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
        // get house_warden username from login page/pop-up
        $warden_userName = $_SESSION['username'];
        // $resName = "Adamson House";// $_REQUEST['resName'];

        // include database details from config.php file
        require_once("config.php");

        // attempt to make database connection
        $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

        // Check if connection was successful
        if ($connection->connect_error) {
            die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
        }

        $warden_res_query = 
        "SELECT resName, concat(f_Name, ' ', l_Name) as 'Name', f_Name as 'firstName', CONCAT(LEFT(house_warden.f_Name, 1), LEFT(house_warden.l_Name, 1)) AS initials
         FROM house_warden WHERE userName = '$warden_userName';";
        $warden_res_query_result = $connection->query($warden_res_query);
        
        if ($warden_res_query_result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }
    
        $resnamel = $warden_res_query_result->fetch_assoc();
        $resname = $resnamel['resName'];
        $wardeName = $resnamel['Name'];
        $initials = $resnamel['initials'];
    
        // query instructions for tickets pending and processing
        $sql = "SELECT * FROM ticket WHERE resName = '$resname' and ticket_status = 'Closed' ;";
        $result = $connection->query($sql);
    
        // Check if query successfull
        if ($result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }
        // close connection
        $connection->close();
    ?>
    <div class="container">
        <!-- Sidebar section for navigation -->
        <?php require_once("sidebarWarden.php"); ?>

        <!-- Main content area -->
        <main class="content">
            <header class="page-header">
                <!-- Welcome message -->
                <h1>Welcome, <span class="username"><?php echo $resnamel['firstName']; ?></span></h1>
                <p>Access & Manage maintenance requisitions efficiently.</p>
            </header>

        

            <!-- Ticket table section -->
            <section class="ticket-table">
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
                            if($result -> num_rows > 0){
                                while ($row = $result->fetch_assoc())
                                {
                                    if ($row['ticket_status'] != "Pending") {
                                        echo "<tr><td>#{$row['ticketID']}</td>";
                                        echo "<td>{$row['ticket_description']}</td>";
                                        echo "<td><span class='status processing'><span class='circle'></span>&nbsp;&nbsp;{$row['ticket_status']}</span></td>";
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
                            }
                            else{
                                echo "<tr><td> <p> No Tickets Available </p></td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </section>

        </main>
    <!-- Link to external JavaScript file -->
    <script src="house_warden.js"></script>
</body>
</html>