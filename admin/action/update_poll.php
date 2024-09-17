<?php
require '../../db/dbconn.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = isset($_POST['poll_id']) ? mysqli_real_escape_string($con, $_POST['poll_id']) : '';
    $poll_title = isset($_POST['poll_title']) ? mysqli_real_escape_string($con, $_POST['poll_title']) : '';
    $poll_description = isset($_POST['poll_description']) ? mysqli_real_escape_string($con, $_POST['poll_description']) : '';
    $poll_options = isset($_POST['poll_options']) ? $_POST['poll_options'] : array();

    // Validate the required fields
    if (empty($poll_id) || empty($poll_title) || empty($poll_description) || count($poll_options) < 2) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill up the required fields and ensure there are at least two options.';
        echo json_encode($response);
        exit;
    }

    // Update poll details
    $update_poll_query = "UPDATE poll_tbl SET poll_title = '$poll_title', poll_description = '$poll_description' WHERE poll_id = '$poll_id'";
    if (mysqli_query($con, $update_poll_query)) {
        // Mark old options as deleted
        $delete_options_query = "UPDATE poll_options_tbl SET deleted = 1 WHERE poll_id = '$poll_id'";
        mysqli_query($con, $delete_options_query);

        // Insert new options
        $insert_options_query = "INSERT INTO poll_options_tbl (poll_id, poll_option) VALUES ";
        $values = array();
        foreach ($poll_options as $option) {
            $option = mysqli_real_escape_string($con, $option);
            $values[] = "('$poll_id', '$option')";
        }
        $insert_options_query .= implode(',', $values);

        if (mysqli_query($con, $insert_options_query)) {
            $response['status'] = 'success';
            $response['message'] = 'Poll updated successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Failed to update poll options. Please try again later.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to update poll details. Please try again later.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
