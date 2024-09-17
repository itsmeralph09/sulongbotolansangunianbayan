<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    require '../db/dbconn.php';

    // Function to sanitize input
    function sanitizeInput($input, $con) {
        return mysqli_real_escape_string($con, trim($input));
    }

    // Retrieve and sanitize inputs
    $username = isset($_POST['username']) ? sanitizeInput($_POST['username'], $con) : '';
    $password = isset($_POST['password']) ? sanitizeInput($_POST['password'], $con) : '';

    // Construct the SQL query to fetch user details
    $sql = "SELECT 
                user_id, CONCAT(first_name, ' ', last_name) AS fullname, barangay, username, password, role
            FROM 
                user_tbl
            WHERE 
                username = '$username'
                AND deleted = 0
                AND used = 0";

    // Execute the SQL statement
    $result = $con->query($sql);

    if ($result && $result->num_rows > 0) {
        // User found, fetch user data
        $row = $result->fetch_assoc();
        
        // Verify the password (assuming it's hashed)
        if ($password == $row['password']) {
            // Password matches, user authenticated
            // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['barangay'] = $row['barangay'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            
            // Return role value as part of the response
            echo json_encode(['success' => true, 'role' => $row['role']]);
        } else {
            // Password does not match
            echo json_encode(['success' => false, 'message' => 'Incorrect password.']);
        }
    } else {
        // User not found
        echo json_encode(['success' => false, 'message' => 'Username does not exist.']);
    }

    // Close connection
    $con->close();
}
?>
