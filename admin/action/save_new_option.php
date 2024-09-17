<?php
require '../../db/dbconn.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = isset($_POST['poll_id']) ? mysqli_real_escape_string($con, $_POST['poll_id']) : '';
    $poll_option = isset($_POST['poll_option']) ? mysqli_real_escape_string($con, $_POST['poll_option']) : '';

    if (empty($poll_id) || empty($poll_option)) {
        $response['status'] = 'error';
        $response['message'] = 'Poll ID and option are required.';
        echo json_encode($response);
        exit;
    }

    // Insert the new option
    $insert_option_query = "INSERT INTO poll_options_tbl (poll_id, poll_option) VALUES ('$poll_id', '$poll_option')";

    if (mysqli_query($con, $insert_option_query)) {
        $response['status'] = 'success';
        $response['message'] = 'New poll option added successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to add new poll option. Please try again later.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
