<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
} else {
    unset($_SESSION['user_id']);
    unset($_SESSION['fullname']);
    unset($_SESSION['barangay']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);

    unset($_COOKIE['PHPSESSID']);
    setcookie('PHPSESSID', '', time() - 3600, '/');

    session_destroy();
    header("Location: ../login.php");
    exit;
}
?>