<?php
    // Start the session
    session_start();

    // Get the values from the form
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    // Include database credentials
    require_once("config.php");

    // Make a connection to the database
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    // Check if the connection is successful
    if ($conn->connect_error) {
        die("<p class=\"error\">Connection to the database failed!</p>");
    }

    // Query to select the user based on the username
    $sql = "SELECT * FROM user WHERE userName = '$username'";
    $result = $conn->query($sql);

    if ($result === FALSE) {
        die("<p class=\"error\">Unable to retrieve data!</p>");
    }

    // Check if the user exists in the database
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['user_password'];
        $user_role = $row['user_role']; // Retrieve the user's role

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashed_password) || $password === $hashed_password) {
            $_SESSION['username'] = $username;  // Set the username in the session
            $_SESSION['user_role'] = $user_role;  // Store user role in session
            $_SESSION['access'] = true;

            // Redirect based on user role
            switch($user_role) {
                case 'student':
                    header("Location: ../ticket_tracking/ticket_tracking_all.php");
                    break;
                case 'house warden':
                    header("Location: ../house_warden/house_warden_open_tickets.php");
                    break;
                case 'hall secretary':
                    header("Location: ../hall_secretary_dashboard/hall_secretary_open_tickets.php");
                    break;
                case 'maintenance_staff':
                    header("Location: ../maintenance_dashboard/maintenance_opened_tickets.php");
                    break;
                default:
                    echo "<p class=\"error\">Role error! Please contact the administrator.</p>";
            }
            exit();
        } else {
            echo "<p class=\"error\">Password is incorrect!</p>";
        }
    } else {
        // Username doesn't exist
        echo "<p class=\"error\">Username does not exist!</p>";
    }
    // Close connection to the database
    $conn->close();
?>
