<?php
// Assuming you have a database connection established
require '../../db/dbconn.php';

// Check if the username or email already exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    // Query to check if username or email already exists
    $query = "SELECT * FROM `user_tbl` WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($con, $query);

    // Prepare response object
    $response = array();

    // If a row is fetched, username or email already exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $exists = array(
            'username' => ($row['username'] == $username),
            'email' => ($row['email'] == $email)
        );
        $response['exists'] = $exists;
    } else {
        // If no row is fetched, garden doesn't exist
        $response['exists'] = false;
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If request method is not POST, return error response
    $response = array('error' => 'Invalid request method');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>