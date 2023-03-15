<?php

include 'config.php';

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the user with the specified ID
    $sql = "DELETE FROM user_form WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Redirect to the admin page
    header('location:admin_page.php');
} else {
    // If the user ID is not provided, redirect to the admin page
    header('location:admin_page.php');
}

?>
