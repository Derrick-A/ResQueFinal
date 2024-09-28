<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .error {
        color: red;
    }
    .success {
        color: green;
    }
</style>
<?php
//Start the session
session_start();

// come from a form submission
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$email = $_REQUEST['email'];
$resname = $_REQUEST['resName'];
$roomNumber = $_REQUEST['roomNumber'];
$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$hall = $_REQUEST['studentHall'];
$hall2 = $_REQUEST['hw-hall'];
$hall3 = $_REQUEST['hallSecretaryHall'];
$role = $_REQUEST['role']; // Retrieve role from the form

echo "Selected role: " . $role . "<br>"; // Debugging statement

//include database credentials 
require_once("config.php");

// Database connection
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

//check if the query is successful
if ($conn->connect_error) {
    die("<p class=\"error\">Connection to the database failed!</p>" . $conn->connect_error);
}


//query to check if the user exists in the database
$sql = "SELECT * FROM user WHERE userName = '$username'";
$result = $conn->query($sql);

if (!$result) {
    die("Error querying user table: " . $conn->error);
}

if ($result->num_rows > 0) {
    //user already exists, log them in
    $_SESSION['username'] = $username;  // Set the username in the session
    $_SESSION['hall'] = $hall;
    $_SESSION['resName'] = $resname;
    $_SESSION['access'] = "yes";
    header("Location: ../ticket_tracking/ticket_tracking_all.php");
    exit();
} else {
    //user doesn't already exist
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
    $userTable = "INSERT INTO user(userName, user_password, user_role, email)
                  VALUES ('$username', '$hashed_password', '$role', '$email')";
    $fromUser = $conn->query($userTable);

    //check if the user has been added successfully into user table
    if ($fromUser === TRUE) {
        echo "User added successfully.";
        //check the role of the user
        switch ($role) {
            //if the user is a student
            case 'student':
                //check if the residence exists
                $checkRes = "SELECT * FROM residence WHERE resName = '$resname'";
                $resResult = $conn->query($checkRes);

                //if the residence doesn't exist, add the residence
                if ($resResult->num_rows == 0) {
                    $residenceTable = "INSERT INTO residence (resName, hall_name) VALUES ('$resname', '$hall')";
                    $residence = $conn->query($residenceTable);
                    
                    if (!$residence) {
                        die("<p class=\"error\">Error adding into residence table: " . $conn->error . "</p>");
                    }
                }

                //insert into the student table
                $studentTable = "INSERT INTO student(f_Name, l_Name, resName, userName, room_number)
                                 VALUES ('$fname', '$lname', '$resname', '$username', '$roomNumber')";
                $student = $conn->query($studentTable);

                //check if the student has been added successfully and go to the dashboard
                if ($student === TRUE) {
                    echo "<p class=\"success\">User and Student added successfully!</p>";
                    header("Location: ticketCreationFinal.php");
                    exit();
                } else {
                    die("<p class=\"error\">Error adding into student table: " . $conn->error . "</p>");
                }
                break;

            //if the user is a house warden
            case 'house warden':
                // Handle house warden case
                // Check if the residence exists
                $checkRes = "SELECT * FROM residence WHERE resName = '$resname'";
                $resResult = $conn->query($checkRes);

                // If the residence doesn't exist, add the residence
                if ($resResult->num_rows == 0) {
                    $residenceTable = "INSERT INTO residence (resName, hall_name) VALUES ('$resname', '$hall2')";
                    $residence = $conn->query($residenceTable);
                    
                    if (!$residence) {
                        die("<p class=\"error\">Error adding to residence table: " . $conn->error . "</p>");
                    }
                }

                // Ensure that the selected hall secretary exists
                //$checkHSUser = "SELECT * FROM hall_secretary WHERE HS_userName = '$HS_userName'";
                $checkHSUser = "SELECT resName FROM residence  
                                JOIN hall_secretary ON hall_secretary.hall_name = residence.hall_name WHERE resName = '$resname'";
                $hsResult = $conn->query($checkHSUser);

                if ($hsResult->num_rows == 0) {
                    die("<p class='error'>No such hall secretary found with HS_userName: $HS_userName</p>");
                }

                // Insert into the house warden table
                $wardenTable = "INSERT INTO house_warden (f_Name, l_Name, resName, userName, HS_userName)
                                VALUES ('$fname', '$lname', '$resname', '$username', 'SOME_HS_USER')"; // Replace SOME_HS_USER with the actual HS_userName
                $warden = $conn->query($wardenTable);

                if ($warden === TRUE) {
                    echo "<p class=\"success\">House Warden added successfully!</p>";
                    header("Location: ../house_warden/house_warden_open_tickets.php");
                    exit();
                } else {
                    die("<p class=\"error\">Error adding to house warden table: " . $conn->error . "</p>");
                }

                break;
            case 'hall secretary':
                // Logic for hall secretary
                $secretaryTable = "INSERT INTO hall_secretary (HS_userName, f_Name, l_Name, userName, hall_name)
                                   VALUES ('$username', '$fname', '$lname', '$username', '$hall3')";
                $secretary = $conn->query($secretaryTable);

                if ($secretary === TRUE) {
                    echo "<p class='success'>Hall Secretary added successfully!</p>";
                    header("Location: ../hall_secretary_dashboard/hall_secretary_open_tickets.php");
                    exit();
                } else {
                    die("<p class='error'>Error adding to hall secretary table: " . $conn->error . "</p>");
                }
                break;
    
            default:
                // Handle other roles
                die("<p class=\"error\">Unknown user role: $role</p>");
                break;
            }
        } else {
        die("<p class=\"error\">Error adding into user table: " . $conn->error . "</p>");
    }
}
// Close connection to the database
$conn->close();
?>

</body>
</html>
