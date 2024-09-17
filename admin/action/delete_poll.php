<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if poll_id is provided and is numeric
if (isset($_POST['poll_id']) && is_numeric($_POST['poll_id'])) {
    // Sanitize the input to prevent SQL injection
    $poll_id = mysqli_real_escape_string($con, $_POST['poll_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE poll_tbl SET deleted = 1 WHERE poll_id = '$poll_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If poll_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
