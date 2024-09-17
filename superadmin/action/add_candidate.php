<?php
// Include your database connection file
require '../../db/dbconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = strtoupper(mysqli_real_escape_string($con, $_POST['first_name']));
    $middle_name = strtoupper(mysqli_real_escape_string($con, $_POST['middle_name']));
    $last_name = strtoupper(mysqli_real_escape_string($con, $_POST['last_name']));
    $suffix_name = strtoupper(mysqli_real_escape_string($con, $_POST['suffix_name']));

    $stage_name = strtoupper(mysqli_real_escape_string($con, $_POST['stage_name']));
    $gender = strtoupper(mysqli_real_escape_string($con, $_POST['gender']));
    $purok = mysqli_real_escape_string($con, $_POST['purok']);
    $barangay = strtoupper(mysqli_real_escape_string($con, $_POST['barangay']));

    $birthdate = mysqli_real_escape_string($con, $_POST['birthdate']);
    $civil_status = strtoupper(mysqli_real_escape_string($con, $_POST['civil_status']));
    $occupation = strtoupper(mysqli_real_escape_string($con, $_POST['occupation']));
    $contact_number = strtoupper(mysqli_real_escape_string($con, $_POST['contact_number']));

    // Handle file upload
    $file = $_FILES['profile'];
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    // Remove spaces from the last name
    $last_name_no_spaces = str_replace(' ', '', $last_name);

    // Handle file name
    $file_name = $last_name_no_spaces . '.' . $file_extension;

    $file_tmp = $file['tmp_name'];

    // Move uploaded file to desired location
    $file_destination = "../../pictures/" . $file_name;

    if (move_uploaded_file($file_tmp, $file_destination)) {

        // SQL query to insert into `candidate_tbl`
        $sql = "INSERT INTO `candidate_tbl` (`first_name`, `middle_name`, `last_name`, `suffix_name`, `stage_name`, `purok`, `barangay`, `gender`, `birthdate`, `civil_status`, `occupation`, `contact_number`, `picture`) 
                VALUES ('$first_name', '$middle_name', '$last_name', '$suffix_name', '$stage_name', '$purok', '$barangay', '$gender', '$birthdate', '$civil_status', '$occupation', '$contact_number', '$file_name')";

        // Execute the query
        if (mysqli_query($con, $sql)) {
            // If the query is successful, return success
            echo 'success';
        } else {
            // If the query fails, return error
            echo 'error: ' . mysqli_error($con);
        }

    } else {
        echo 'File upload failed';
    }
}

// Close the database connection
mysqli_close($con);
?>
