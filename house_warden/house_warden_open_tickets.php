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
        // if (isset(($_REQUEST['submit']))) {
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

        // Remove APPROVED/CONFIRMED requests from OPENED requests list
        // These requests are now CONFIRMED - they will go to hall secretary's OPENED page
        if (isset(($_REQUEST['approve_request']))) {
            $ticketID = $_REQUEST['ticketID'];
            $student_name = $_REQUEST['student_name'];
            $student_room_num = $_REQUEST['student_room_num'];
            $remove_request = "UPDATE ticket SET ticket_status = 'Confirmed' WHERE ticketID = $ticketID";
            $remove_request_result = $connection->query($remove_request);

            // Check if request removal was successful
            if ($remove_request_result === FALSE) {
                die("<p class=\"error\">Request removal was Unsuccessful!</p>");
            }
        }


        // get hall name from login page/pop-up
        $warden_userName = $_SESSION['username'];

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
        $sql = 
            "SELECT ticketID, concat(f_Name, ' ', l_Name) AS 'full_name', t.resName, room_number, priority 
            FROM student s JOIN ticket t ON s.userName = t.userName 
            WHERE ticket_status = 'Opened' and t.resName = '$resname';";
        $opened_tickets_result = $connection->query($sql);

        // Check if query successfull
        if ($opened_tickets_result === FALSE) {
            die("<p class=\"error\">Query was Unsuccessful!</p>");
        }

        // close connection
        $connection->close();
    ?>
    <div class="container">
        <!-- Sidebar section for navigation -->
        <?php require_once("sidebarWarden.php") ;?>

        <!-- Main content area --> 
        <main class="content">
            <header class="page-header">
                <!-- Welcome message -->
                <h1>Welcome, <span class="username"><?php echo $resnamel['firstName']; ?></span></h1>
                <p>Access & Manage maintenance requisitions efficiently.</p>
            </header>
            <!-- removed the Ticket table section -->

            <?php
                if (isset($ticketID) && !empty($ticketID)) {
                    echo "<div id='success-message' class='success-message'>
                            <h2>Request Approved!<i class='fas fa-times cancel-icon' onclick='remove_feedback()'></i></h2>
                            <p>The maintenance request for <strong>$student_name</strong> in <strong>room $student_room_num</strong> has been approved successfully. The hall secretary will be notified shortly.</p>
                        </div>";
                }
            ?>

            <!-- Maintenance requests section -->
            <section class="maintenance-requests">
                <header id="maintenance-requests-header">
                    <!-- Header with title and view all button -->
                    <h2 id="h2">Tickets Pending Approval</h2>
                    <!-- <button class="view-all">View all</button> -->
                </header>

                <!-- populate maintenance faults pending approval -->
                <div class="requests">
                    <?php
                        $count = 0;
                        if ($opened_tickets_result->num_rows > 0) {
                            while ($row = $opened_tickets_result->fetch_assoc())
                            {
                                echo "<article class='request'>
                                        <div class='request-top-btns request-btns'>
                                            <!-- Buttons for commenting and deleting a request -->
                                            <button class='comment-btn' onclick><i class='fa-solid fa-pen'></i>&nbsp;&nbsp;&nbsp;Comment</button>
                                            <button class='delete-btn'><i class='fa-solid fa-trash' style='color: #e53e3e;'></i>&nbsp;&nbsp;&nbsp;Delete</button>
                                        </div>
                                        <!-- Request information -->
                                        <div class='request-info'>
                                            <p><strong>{$row['full_name']}</strong></p>
                                            <p>Residence: <strong>{$row['resName']}</strong></p>
                                            <p>Room Number: <strong>{$row['room_number']}</strong></p>
                                            <form class='request-form' action='house_warden_open_tickets.php' method='get'>
                                                <input type='hidden' name='ticketID' value='{$row['ticketID']}'>
                                                <button type='submit' name='approve_request' class='approve-btn request-btns'>
                                                    <i class='fa-solid fa-plus' style='color: #a020f0;'></i>&nbsp;&nbsp;&nbsp;Approve Request
                                                </button>
                                                <input type='hidden' name='student_name' value='{$row['full_name']}'>
                                                <input type='hidden' name='student_room_num' value='{$row['room_number']}'>
                                            </form>
                                            <p>Priority: <strong>{$row['priority']}</strong></p>
                                            
                                        </div>
                                    </article>";
                                    
                                // echo "<article class='request'>
                                //         <div class='request-top-btns request-btns'>
                                //             <!-- Buttons for commenting and deleting a request -->
                                //             <button class='comment-btn'><i class='fa-solid fa-pen'></i>&nbsp;&nbsp;&nbsp;Comment</button>
                                //             <button class='delete-btn'><i class='fa-solid fa-trash' style='color: #e53e3e;'></i>&nbsp;&nbsp;&nbsp;Delete</button>
                                //         </div>
                                //         <!-- Request information -->
                                //         <div class='request-info'>
                                //             <p><strong>{$row['full_name']}<strong></p>
                                //             <p>Residence: <strong>{$row['resName']}<strong></p>
                                //             <p>Room Number: <strong>{$row['room_number']}<strong></p>
                                //             <p>Priority: <strong>{$row['priority']}<strong>
                                //             <button class='approve-btn request-btns'><i class='fa-solid fa-plus' style='color: #a020f0;'></i>&nbsp;&nbsp;&nbsp;Approve Request</button></p>
                                        
                                //           </div>
                                //     </article>";
                                $count++;
                            }
                        }
                        else {
                            echo "<tr><td> <p> No Tickets Available </p></td></tr>";
                        }
                        echo "COUNT = $count";
                        echo "";
                    ?>
                </div>
                
            </section>
        </main>
    </div>
    <!-- Link to external JavaScript file -->
    <script src="house_warden.js"></script>
</body>
</html>