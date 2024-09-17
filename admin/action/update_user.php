<?php
require '../../db/dbconn.php';

$response = array(); // Initialize response array

// Check if user_id is provided and is numeric
if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    // Sanitize inputs to prevent SQL injection
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $first_name = strtoupper(mysqli_real_escape_string($con, $_POST['first_name']));
    $middle_name = strtoupper(mysqli_real_escape_string($con, $_POST['middle_name']));
    $last_name = strtoupper(mysqli_real_escape_string($con, $_POST['last_name']));
    $suffix_name = strtoupper(mysqli_real_escape_string($con, $_POST['suffix_name']));
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $designation = strtoupper(mysqli_real_escape_string($con, $_POST['designation']));

    // Check if password is provided
    $password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : '';

    // Update the user's information
    $sql = "UPDATE user_tbl SET 
            username = '$username',
            email = '$email',
            first_name='$first_name', 
            middle_name='$middle_name',
            last_name='$last_name',
            suffix_name='$suffix_name',
            designation='$designation'";

    // Update password if provided
    if (!empty($password)) {
        $hashpass = $password;
        $sql .= ", password='$hashpass'";
    }

    $sql .= " WHERE user_id='$user_id'";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // Success message based on password update
        $message = !empty($password) ? "password has changed" : "password remain unchanged";
        $response = array("status" => "success", "message" => "User updated successfully, $message");
    } else {
        // Error message
        $response = array("status" => "error", "message" => "Failed to update user");
    }
} else {
    // If required parameters are missing
    $response = array("status" => "error", "message" => "Invalid or missing parameters");
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
mysqli_close($con);
?>