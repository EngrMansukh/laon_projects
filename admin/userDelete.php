<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    $query = "UPDATE users SET is_active = 0, user_role = 0 WHERE id = $user_id";

    if ($conn->query($query) === TRUE) {
        //$msgSuccess = "User Delete successfully!";
        header("Location: usersList.php?msg");
        exit();
    } else {
        $msgError = "Error deleted user: " . $conn->error;
    }
} else {
    $msgError = "User ID not provided.";
}


?>