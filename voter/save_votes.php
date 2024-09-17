<?php
require 'function/check_session.php';

// Call the checkSession function to perform session validation
checkSession();

// Database connection details
$host = 'localhost'; // Your database host
$dbname = 'sb_db'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get selected candidate IDs from form
        $selectedCandidates = isset($_POST['cards']) ? $_POST['cards'] : '';

        // Debug output to verify data
        error_log("Selected Candidates: " . $selectedCandidates);

        // Convert the comma-separated string to an array
        $candidateIds = explode(',', $selectedCandidates);

        // Debug output to verify data
        error_log("Candidate IDs: " . print_r($candidateIds, true));

        // Static user ID for now
        $userId = $_SESSION['user_id'];

        // Get the current datetime
        $datetime = date('Y-m-d H:i:s');

        // Prepare and execute insertion for each selected candidate
        $stmt = $pdo->prepare("INSERT INTO vote_tbl (user_id, candidate_id, datetime, deleted) VALUES (:user_id, :candidate_id, :datetime, 0)");

        foreach ($candidateIds as $candidateId) {
            if (!empty($candidateId)) {
                $stmt->execute([
                    ':user_id' => $userId,
                    ':candidate_id' => $candidateId,
                    ':datetime' => $datetime
                ]);
                // Debug output to verify execution
                error_log("Inserted vote for candidate ID: " . $candidateId);
            }
        }

        // Update the `used` column in the `user_tbl` after saving votes
        $updateStmt = $pdo->prepare("UPDATE user_tbl SET used = 1 WHERE user_id = :user_id");
        $updateStmt->execute([':user_id' => $userId]);

        // Debug output to verify update execution
        error_log("Updated 'used' column for user ID: " . $userId);

        // Redirect or show a success message
        header('Location: success.php'); // Redirect to a success page
        exit;
    }
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    exit;
}

?>
