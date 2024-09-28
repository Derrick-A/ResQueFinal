<?php
require_once("secure.php");

if (isset($_SESSION['username'])) {
    $userID = $_SESSION['username']; //get userID for this 
}else {
    die("User is not logged in.");
}

// Include database details from config.php file
require_once("../config.php");
                    
// attempt to make database connection
$connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

// Check if connection was successful
if ($connection->connect_error) {
    die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
}

//get the student information to use on the page
$sql = "SELECT * FROM systemsurgeons.student where userName = '$userID'";
$result = $connection -> query($sql); //execute query

if ($result && $result->num_rows > 0) {
    // Fetch the student information from the result set
    $row = $result->fetch_assoc();
    $fname = $row['f_Name'];
    $lname = $row['l_Name'];
    $residence = $row['resName'];
    $room = $row['room_number'];
} else {
    // Handle case where no student data was found
    echo "<p class='error'>No student data found for the user.</p>";
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
                    <h1>Ticket Tracking: <span class="ticket_type">Closed Tickets</span></h1>
                    <p class="fade-out">View tickets that have been closed or rejected</p>
                </div>
                <!-- Fix the logo size -->
                 <div class="logo-container">
                    <img src="pictures/resque-logo.png" alt="Logo" width="150" height="110">
                </div>
            </header>

            <!-- Flex container for the ticket list and ticket detail -->
            <div class="content-wrapper">
                <!-- Section for the list of tickets -->
                <section class="ticket-list">
                    <!-- <a href="../ticket_creation/ticketCreation.html"><button class="add-ticket">+ Add New Ticket</button></a>
                    <br> -->

                    <h3>Your Tickets</h3>
                    <?php
                        //query instructions for the student's tickets
                        $sql = "SELECT ticketID, resName, ticket_status FROM systemsurgeons.ticket where userName = '$userID' and ( (ticket_status = 'Completed') or (ticket_status = 'Rejected'))";
                        $result = $connection -> query($sql); //execute query

                        // Check if query successfull
                        if ($result === FALSE) {
                            die("<p class=\"error\">Your Tickets Query was Unsuccessful!</p>");
                        }
                    
                        //display the student's tickets or display a message if none are found
                        echo "<section class='scrollbar'>";
                        if ($result -> num_rows > 0) {
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
                                echo "<td><a href='ticket_tracking_closed.php?ticketID={$row['ticketID']}' class='details-button'>View Details</button></a></td>";
                                echo "</tr>";
                            } //end table
                            echo "</table>";
                        }
                    else {
                        echo "<p class='info-label'>No closed tickets were found for you.</p>";
                    }
                    echo "</section";
                    ?>
                    <br>

                    <?php
                    echo "<h3>$residence Tickets</h3>";

                        //query instructions for all tickets within the same residence
                        $sql = "SELECT ticketID, resName, ticket_status FROM systemsurgeons.ticket where resName = '$residence' and ( (ticket_status = 'Completed') or (ticket_status = 'Rejected'))";
                        $result = $connection -> query($sql); //execute query

                        // Check if query successfull
                        if ($result === FALSE) {
                            die("<p class=\"error\">Residence Tickets Query was Unsuccessful!</p>");
                        }

                        //dynamically display all tickets within that residence
                        //echo "<section class='scrollbar'>";
                        if ($result -> num_rows > 0) {
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
                                echo "<td><a href='ticket_tracking_closed.php?ticketID={$row['ticketID']}' class='details-button'>View Details</button></a></td>";
                                echo "</tr>";
                            } //end table
                            echo "</table>";
                        }
                    else {
                        echo "<p class='info-label'>No closed tickets were found for your residence.</p>";
                    }
                    echo "</section";
                    ?>
                </section>
                

                <!-- Section for the detailed view of a single ticket -->
                <section class="ticket-detail">
                    <article class="ticket-info">
                        <?php

                            // Check if a ticketID is provided via GET request
                            if (isset($_GET['ticketID'])) {
                                $ticketID = $_GET['ticketID'];

                            //query instructions for the student's tickets
                            $sql = "SELECT ticketID, resName, ticket_status, ticketDate, ticket_description, category, priority  FROM systemsurgeons.ticket where ticketID = '$ticketID')";
                            $result = $connection -> query($sql); //execute query

                            // Check if query successfull
                            if ($result === FALSE) {
                                die("<p class=\"error\">Could not connect to database to get ticket details!</p>");
                            }

                            $ticketowner = ''; //will be used to authorise user to make comments on their ticket, and to allow them to delete comments under their ticket

                            // Fetch and display photos from the 'photos' table for the ticketID
                            $sql_photos = "SELECT photo FROM systemsurgeons.photos WHERE ticketID = '$ticketID'";
                            $photos_result = $connection->query($sql_photos);

                            if ($photos_result->num_rows > 0) {
                                echo "<div class='carousel'>";
                                //echo "<h3>Ticket Photos</h3>";
                                echo "<div class='carousel-images'>";
                                
                                while ($photo = $photos_result->fetch_assoc()) {
                                    $photo_src = "../landing_page/pictures/" . $photo['photo'];
                                    echo "<div class='carousel-slide'>";
                                    echo "<img src='$photo_src' alt='Ticket Image' class='carousel-image'>";
                                    echo "</div>";
                                }

                                echo "</div>";
                                echo "<button class='carousel-prev'>Prev</button>";
                                echo "<button class='carousel-next'>Next</button>";
                                echo "</div>";
                            } else {
                                // echo "<p>No photos have been uploaded for this ticket.</p>";
                                echo "<img src='pictures/leak.jpg' alt='Ticket Image'>";
                            }
                            //image carousel ends here

                            if($result -> num_rows > 0) {
                                $ticket = $result->fetch_assoc(); //get related ticket details
                                $ticketowner = $ticket['userName'];

                            //display the ticket details for the specific ticket
                            echo "<table class='info-table'>";
                                echo "<tr><td><span class='info-data'>Details for Ticket #$ticketID</span></td></tr>";
                            echo "</table>";
                            echo "<table class='info-table'>";
                                echo "<tr>";
                                    echo "<td class='info-cell'>";
                                        echo "<span class='info-label'>Date Logged:</span>";
                                        // Convert the date from the database to the desired format
                                        $date = date_create($ticket['ticketDate']); // Create a DateTime object
                                        echo "<span class='info-data'>" . date_format($date, 'j F Y') . "</span>"; // Format the date
                                    echo "</td>";
                                    echo "<td class='info-cell'>";
                                        echo "<span class='info-label'>Priority:</span>";
                                        echo "<span class='info-data'>{$ticket['priority']}</span>";
                                    echo "</td>";
                                    echo "<td class='info-cell'>";
                                        echo "<span class='info-label'>Category:</span>";
                                        echo "<span class='info-data'>{$ticket['category']}</span>";
                                    echo "</td>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td class='info-cell' colspan='3'>";
                                        echo "<span class='info-label'>Description:</span>";
                                        echo "<span class='info-data'>{$ticket['ticket_description']}</span>";
                                    echo "</td>";
                                echo "</tr>";
                            echo "</table>";
                            }
                            else {
                                echo "<p>No details found for this ticket.</p>";
                            }

                            //COMMENTS SECTION
                            // Query to get the comments related to this ticket
                            $sql_comments = "SELECT commentID, userName, comment_description, comment_date FROM systemsurgeons.comment WHERE ticketID = '$ticketID' and soft_delete_comment = false";
                            $comments_result = $connection->query($sql_comments); // Execute query for comments

                            if ($comments_result->num_rows > 0) {
                                echo "<h3>Comments</h3>";
                                echo "<dl class='comment-list'>";
                                while ($comment = $comments_result->fetch_assoc()) {

                                    //calculate how long ago a comment was made
                                    $comment_time = new DateTime($comment['comment_date']); //date comment was made
                                    $current_time = new DateTime(); //today's date
                                    $interval = $comment_time->diff($current_time); //difference in the time

                                    // Create a readable time difference (e.g., '2 hours ago')
                                    if ($interval->y > 0) {
                                        $time_ago = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                                    } elseif ($interval->m > 0) {
                                        $time_ago = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                                    } elseif ($interval->d > 0) {
                                        $time_ago = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                                    } elseif ($interval->h > 0) {
                                        $time_ago = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                                    } elseif ($interval->i > 0) {
                                        $time_ago = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                                    } else {
                                        $time_ago = 'Just now';
                                    }

                                    //display the comment info
                                    echo "<div class='comment-bubble'>";
                                    echo "<dt class='commentor'>" . htmlspecialchars($comment['userName']) . ":</dt>";
                                    echo "<dd class='comment-msg'> " . htmlspecialchars($comment['comment_description']) . "</dd>";
                                    echo "<span class='comment_time'>" . htmlspecialchars($time_ago) . "</span>"; // Display time ago
                                    // For each comment, show delete button BUT ONLY for the comment owner
                                    if ($comment['userName'] == $userID) {
                                        echo "<form action='soft_delete_comment.php' method='POST' style='display:inline;'>
                                                <input type='hidden' name='commentID' value='{$comment['commentID']}'>
                                                <input type='hidden' name='userID' value={$comment['userName']}>
                                                <input type='hidden' name='page' value='closed'>"; //tells the form handler which page to return to
                                        echo   "<button type='submit' class='delete-button'>Delete</button>
                                            </form>";
                                    }
                                    echo "</div>";
                                    echo "<br>";
                                }
                                echo "</dl>";
                            } else {
                                echo "<h3>Comments</h3>";
                                echo "<span class='info-label'>No comments have been made under this ticket yet.</span><br>";
                            }

                            // Form to submit a new comment - only if they are the ticket creator
                            if ($userID == $ticketowner){
                                echo "<form action='submit_comment.php' method='POST'>
                                    <input type='hidden' name='ticketID' value='$ticketID'>
                                    <input type='hidden' name='userID' value='$userID'>
                                    <input type='hidden' name='page' value='closed'>
                                    <textarea name='comment_description' id='comment' rows='2' cols='50' placeholder='Leave a Comment' required></textarea><br>
                                    <button type='submit' class='comment-button'>Submit Comment</button>
                                </form>";
                            }
                        }
                        else {
                            echo "<img src='pictures/leak.jpg' alt='Ticket Image'>";
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
