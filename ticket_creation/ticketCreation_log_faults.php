<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Requisition Form</title>
    <link rel="icon" type="image/x-icon" href="pictures/resque-logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />    
    <link rel="stylesheet" href="ticketCreationStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="scriptTC.js "></script>
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
<?php
    // include database details from config.php file
    require_once("config.php");

    //for fault category
    if (isset($_REQUEST['submit'])) {
            //for the res name on top
        $resName = $_REQUEST['residence'];
        $studentID =$_REQUEST['username'];
        $fault = $_REQUEST['fault-category'];
        $description = $_REQUEST['description']; 

    // attempt to make database connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    // Check if connection was successful
    if ($conn -> connect_error) {
        die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
    }

    // query instructions
    // Prepare and execute the query
    //for the res name on top
    $sql1 = "SELECT resName FROM student WHERE studentID = $studentID ";
    $stmt1 = $conn->prepare($sql2);
    $stmt1-> bind_param("i", $studentID); // Bind the student ID as an integer
    $stmt1-> execute();
    $result = $stmt->get_result();

    // Check if query successfull
    if ($result === FALSE) {
        die("<p class=\"error\">Query was Unsuccessful!</p>");
    }

    $sql3 = "INSERT INTO ticket (category) VALUES (?)";
    $stmt2 = $conn -> prepare($sql3);
    $stmt2 ->bind_param("s", $fault);

    //echo $category;


    //design an error pop up
    if ($stmt->execute()) {
        echo "<p class=\"success\">Fault category successfully inserted into the database!</p>";
    } else {
        echo "<p class=\"error\">Failed to insert fault category!</p>";
    }
    
    $sql3 = "INSERT INTO ticket (description) VALUES (?)";
    $stmt3 = $connection->prepare($sql);
    $stmt3 -> bind_param("s", $description);
    
    // Execute and check success
    if ($stmt3->execute()) {
        echo "<p class=\"success\">Description successfully inserted into the database!</p>";
    } else {
        echo "<p class=\"error\">Failed to insert description!</p>";
    }

    // Close statements and connection
    $stmt1->close();
    $stmt2->close();
    $stmt3->close();
    $conn->close();
}
?>
    
<body>
    <div class="container">
        <!-- the white left side of the page -->
        <aside class="sidebar">
            <div class="logo">ResQue</div>
            
            <!-- search bar -->
            <form action="ticketCreation_log_faults.php" class="search">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="search-input" type="search" name="search-field" id="search-field" placeholder="Search">
            </form>
            
            <nav>
                <ul>
                    <li id="logFaults"><a class="sidebar-links active" href="ticketCreation_log_faults.php"><img src="pictures/receipt-add.png" alt="receipt-add">Log Faults</a></li> <!--style="background-color: #A020F0;" -->
                    <li id="allTickets"><a class="sidebar-links" href="ticket_tracking.php"><img src="pictures/receipt-icon.png" alt="receipt-icon">All Tickets</a></li>
                    <li id="openTickets"><a class="sidebar-links" href="ticketCreation_opened_tickets.php"><img src="pictures/layer.png" alt="layer">Opened Tickets</a></li>
                    <li id="closedTickets"><a class="sidebar-links" href="ticketCreation_closed_tickets.php"><img src="pictures/clipboard-tick.png" alt="clipboard-tick">Closed Tickets</a></li>
                    <!-- <li id="statistics"><a class="sidebar-links" href="#"><img src="images/bar-chart-icon.png" alt="bar chart icon">Statistics</a></li>height="18px" -->
                </ul>
            </nav>

            <!-- the user information at the bottom -->
            <div class="profile">
               <!-- Profile picture area -->
               <div class="profile-pic">AM</div>
               <!-- Profile information area -->
               <div class="profile-info">
                   <span id="user-name" class="username">Jesus Christ</span><br>
                   <span class="role">Student</span>
               </div>
               <!-- Logout button with icon -->
               <div id="sidebar-log-out">
                   <a href="#"><i class="fa-solid fa-arrow-right-from-bracket fa-xl" style="color: #B197FC;"></i></a>
               </div>
            </div>
        </aside>

        <main class="content">
            <header class="page-header">
                <!-- div is to ensure that the title page and res name are beneath each other -->
                <div>
                    <h1>Maintenance requisition form</h1>
                        
                    <h1>SORT OUT THE PHP for the houses' links below</h1>

                    <!-- <p class="fade-out" id="residence"><?php echo ""//htmlspecialchars($resName); ?></p> -->
                </div>
                <!-- Fix the logo size -->
                <img src="pictures/resque-logo.png" alt="Logo" width="150" height="110">
            </header>
            <section>
                <section>
                    <!-- The actual form for fault -->
                    <form action="ticketCreation.php" method="post" enctype="multipart/form-data" class="requisition-form">
                        <div class="form-header">
                            <h3>Requisition Details</h3>
                            <p class="fade-out">Please fill in the form below</p>
                        </div>

                        <!-- Dropdown for fault category -->
                        <div class="form-group">
                            <label id="fault-cat" for="fault-category">Fault Category <span style="color: red;">*</span></label>
                            <div class="form-input">
                                <select id="fault-category" required>
                                    <option value="" disabled selected>Please enter fault category</option>
                                    <option value="Electrical">Electrical</option>  
                                    <option value="Plumbing">Plumbing</option>
                                    <option value="Furniture">Furniture</option>
                                    <option value="Heater">Heater</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <!-- Description textarea -->
                        <div class="form-group">
                            <div class="form-extra-info">
                                <label for="description">Description</label><br>
                                <small class="wrap-around">Please provide any additional information or instructions related to the requisition</small>
                            </div>
                            <div class="form-input">
                                <textarea id="description" name="description" placeholder="Provide description here..."></textarea>
                            </div>
                        </div>

                        <!-- Dropdown for severity -->
                        <div class="form-group">
                            <label id="severity" for="severity">Severity <span style="color: red;">*</span></label>
                            <div class="form-input">
                                <select id="" required>
                                    <option value=" disabled selected">Please indicate severity of fault</option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload an image -->
                        <div class="form-group">
                            <div class="form-extra-info">
                                <label for="upload">Upload an Image</label><br>
                                <small class="wrap-around">Upload an image to provide context for the maintenance requisition</small>
                            </div>
                            <div class="form-input">
                                <input type="file" id="upload" name="upload">
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="form-actions">
                            <button type="reset" class="cancel-btn">Cancel</button>
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </form>

            </section>
            
        </main>
    </div>
</body>
</html>