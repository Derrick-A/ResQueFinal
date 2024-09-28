<?php
// Include database details from config.php file
require_once("../config.php");

// Check if the request is POST and photoID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['photoID'])) {
    // Get the submitted data
    $photoID = $_POST['photoID'];
    $photo = $_POST['photo'];
    $ticketID = $_POST['ticketID'];

    // Attempt to make database connection
    $connection = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
    
    // Check if connection was successful
    if ($connection->connect_error) {
        die("<p class=\"error\">Connection failed: Incorrect credentials or Database not available!</p>");
    }

    // Delete photo from the database
    $sql_delete = "DELETE FROM systemsurgeons.photos WHERE photoID = '$photoID'";
    if ($connection->query($sql_delete) === TRUE) {
        // Delete the image file from the filesystem
        $file_path = "../landing_page/pictures/" . $photo;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        
        // Redirect back to the ticket page
        header("Location: ticket_tracking_all.php?ticketID=$ticketID");
        exit();
    } else {
        echo "<p class='error'>Failed to delete photo: " . $connection->error . "</p>";
    }

    // Close the connection
    $connection->close();
}
?>
