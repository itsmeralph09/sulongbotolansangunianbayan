<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize the poll data
    $poll_title = strtoupper(mysqli_real_escape_string($con, $_POST['poll_title']));
    $poll_description = strtoupper(mysqli_real_escape_string($con, $_POST['poll_description']));
    $poll_options = $_POST['poll_options']; // This is an array of options

    // SQL query to insert new poll
    $sql = "INSERT INTO `poll_tbl` (`poll_title`, `poll_description`, `poll_status`) VALUES ('$poll_title', '$poll_description', 'CLOSE')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Get the last inserted poll_id
        $poll_id = mysqli_insert_id($con);

        // Prepare to insert poll options
        $insert_options_success = true;
        foreach ($poll_options as $option) {
            $poll_option = strtoupper(mysqli_real_escape_string($con, $option));
            $sql_option = "INSERT INTO `poll_options_tbl` (`poll_option`, `poll_id`) VALUES ('$poll_option', '$poll_id')";
            if (!mysqli_query($con, $sql_option)) {
                $insert_options_success = false;
                break;
            }
        }

        if ($insert_options_success) {
            echo 'success';
        } else {
            echo 'error: ' . mysqli_error($con);
        }
    } else {
        // If the query fails, return error
        echo 'error: ' . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
