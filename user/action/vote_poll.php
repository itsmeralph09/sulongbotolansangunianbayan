<?php
require '../../db/dbconn.php';

$response = array('status' => '', 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $poll_id = isset($_POST['poll_id']) ? mysqli_real_escape_string($con, $_POST['poll_id']) : '';
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($con, $_POST['user_id']) : '';
    $poll_option = isset($_POST['poll_option']) ? mysqli_real_escape_string($con, $_POST['poll_option']) : '';

    // Validate the required fields
    if (empty($poll_id) || empty($user_id) || empty($poll_option)) {
        $response['status'] = 'error';
        $response['message'] = 'Please fill-up the required fields.';
        echo json_encode($response);
        exit;
    }

    // Check if the user has already voted for this poll
    $check_vote_query = "SELECT * FROM poll_vote_tbl WHERE poll_id = '$poll_id' AND user_id = '$user_id'";
    $check_vote_result = mysqli_query($con, $check_vote_query);

    if (mysqli_num_rows($check_vote_result) > 0) {
        $response['status'] = 'error';
        $response['message'] = 'You have already voted for this poll.';
        echo json_encode($response);
        exit;
    }

    // Insert the vote
    $insert_vote_query = "INSERT INTO poll_vote_tbl (poll_id, poll_option_id, user_id) VALUES ('$poll_id', '$poll_option', '$user_id')";
    if (mysqli_query($con, $insert_vote_query)) {
        $response['status'] = 'success';
        $response['message'] = 'Your vote has been submitted successfully.';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to submit your vote. Please try again later.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
