<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = strtoupper(mysqli_real_escape_string($con, $_POST['first_name']));
    $middle_name = strtoupper(mysqli_real_escape_string($con, $_POST['middle_name']));
    $last_name = strtoupper(mysqli_real_escape_string($con, $_POST['last_name']));
    $suffix_name = strtoupper(mysqli_real_escape_string($con, $_POST['suffix_name']));

    $designation = strtoupper(mysqli_real_escape_string($con, $_POST['designation']));

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // SQL query to insert new event
    $sql = "INSERT INTO `user_tbl` (`username`, `email`, `first_name`, `middle_name`, `last_name`, `suffix_name`, `designation`, `password`, `role`) VALUES ('$username','$email', '$first_name','$middle_name', '$last_name', '$suffix_name', '$designation','$password','USER')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        // If the query is successful, return success
        echo 'success';
    } else {
        // If the query fails, return error
        echo 'error: ' . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>
