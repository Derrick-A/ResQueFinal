<?php

session_start();
if (isset($_SESSION['access'])) {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
}

header("Location: home.php");