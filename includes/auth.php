<?php
// includes/auth.php
session_start();

function revisarAutenticacion() {
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit();
    }
}
?>