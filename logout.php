<?php
session_start();
if (isset($_GET['name'])) {
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    session_destroy();
    header('location:index.php');
}
