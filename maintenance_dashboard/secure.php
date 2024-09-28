<?php
    session_start();
    if (!isset($_SESSION['access'])||!($_SESSION['user_role'] == "maintenance_staff")) {
        header("Location: ../landing_page/home.php");
    }
?>