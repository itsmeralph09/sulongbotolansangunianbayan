<?php
// Include your database connection file
require '../../db/dbconn.php';

// Check if candidate_id is provided and is numeric
if (isset($_POST['candidate_id']) && is_numeric($_POST['candidate_id'])) {
    // Sanitize the input to prevent SQL injection
    $candidate_id = mysqli_real_escape_string($con, $_POST['candidate_id']);

    // SQL query to update the 'deleted' flag
    $sql = "UPDATE candidate_tbl SET deleted = 1 WHERE candidate_id = '$candidate_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error';
    }
} else {
    // If candidate_id is not provided or is not numeric, return error
    echo 'error';
}

// Close the database connection
mysqli_close($con);
?>
