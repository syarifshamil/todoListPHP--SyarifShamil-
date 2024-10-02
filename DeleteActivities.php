<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $index = $_POST['index'];

    if (isset($_SESSION['users'][$index])) {
        unset($_SESSION['users'][$index]);
        // Reindex array
        $_SESSION['users'] = array_values($_SESSION['users']);
        $_SESSION['Type'] = "Delete";
        $_SESSION['Message'] = "Activity berhasil dihapus!";
    }

    header("Location: ListActivities.php");
    exit();
}
?>
