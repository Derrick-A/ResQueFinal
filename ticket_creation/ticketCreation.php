<<<<<<< HEAD
<?php
require_once("secure.php");
?>
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
<body>
<?php
    session_start();

    if (isset($_SESSION['username'])) {
        $studentID = $_SESSION['username'];
    }else {
        die("User is not logged in.");
    }
    
    // include database details from config.php file
    require_once("config.php");

    //for fault category
    // if (isset($_REQUEST['submit'])) {
    //         //for the res name on top
    //     $resName = $_REQUEST['residence'];
    //     $studentID =$_REQUEST['username'];
    //     $fault = $_REQUEST['fault-category'];
    //     $description = $_REQUEST['description']; 

    // attempt to make database connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    // Check if connection was successful
    if ($conn -> connect_error) {
        die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
    }

    //for the res name on top
    $sql1 = "SELECT resName FROM student WHERE userName = $studentID ";
    $result = $conn->query($sql1);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resName = $row['resName'];
    } else {
        $resName = "Residence not found";
    }

    // Check if query successfull
    // if ($result === FALSE) {
    //     die("<p class=\"error\">Query was Unsuccessful!</p>");
    // }

    // $sql3 = "INSERT INTO ticket (category) VALUES (?)";
    // $stmt2 = $conn -> prepare($sql3);
    // $stmt2 ->bind_param("s", $fault);

    // //echo $category;


    // //design an error pop up
    // if ($stmt->execute()) {
    //     echo "<p class=\"success\">Fault category successfully inserted into the database!</p>";
    // } else {
    //     echo "<p class=\"error\">Failed to insert fault category!</p>";
    // }
    
    // $sql3 = "INSERT INTO ticket (description) VALUES (?)";
    // $stmt3 = $connection->prepare($sql);
    // $stmt3 -> bind_param("s", $description);
    
    // // Execute and check success
    // if ($stmt3->execute()) {
    //     echo "<p class=\"success\">Description successfully inserted into the database!</p>";
    // } else {
    //     echo "<p class=\"error\">Failed to insert description!</p>";
    // }

    // // Close statements and connection
    // $stmt1->close();
    // $stmt2->close();
    // $stmt3->close();
    $conn->close();
// }
?>
</body>
=======
<?php
require_once("secure.php");
?>
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
<body>
<?php
    session_start();

    if (isset($_SESSION['username'])) {
        $studentID = $_SESSION['username'];
    }else {
        die("User is not logged in.");
    }
    
    // include database details from config.php file
    require_once("config.php");

    //for fault category
    // if (isset($_REQUEST['submit'])) {
    //         //for the res name on top
    //     $resName = $_REQUEST['residence'];
    //     $studentID =$_REQUEST['username'];
    //     $fault = $_REQUEST['fault-category'];
    //     $description = $_REQUEST['description']; 

    // attempt to make database connection
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    // Check if connection was successful
    if ($conn -> connect_error) {
        die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
    }

    //for the res name on top
    $sql1 = "SELECT resName FROM student WHERE userName = $studentID ";
    $result = $conn->query($sql1);

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $resName = $row['resName'];
    } else {
        $resName = "Residence not found";
    }

    $conn->close();
// }
?>
</body>
>>>>>>> 1c9f5f447eac07b9894be219ee0d875339c15591
</html>