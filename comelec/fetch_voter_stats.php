<?php
require '../db/dbconn.php';

// Total voters
$sql = "SELECT COUNT(*) AS total_voters FROM user_tbl WHERE role = 3 AND deleted = 0";
$result = mysqli_query($con, $sql);
$total_voters = mysqli_fetch_assoc($result)['total_voters'];

// Voters who have voted
$sql = "SELECT COUNT(*) AS total_voters_done FROM user_tbl WHERE role = 3 AND used = 1 AND deleted = 0";
$result = mysqli_query($con, $sql);
$total_voters_done = mysqli_fetch_assoc($result)['total_voters_done'];

// Voters who have not voted
$sql = "SELECT COUNT(*) AS total_voters_notdone FROM user_tbl WHERE role = 3 AND used = 0 AND deleted = 0";
$result = mysqli_query($con, $sql);
$total_voters_notdone = mysqli_fetch_assoc($result)['total_voters_notdone'];

// Calculate percentage of voters who have voted
if ($total_voters > 0) {
    $sql = "SELECT (COUNT(CASE WHEN used = 1 THEN 1 END) / COUNT(*) * 100) AS percentage_voted FROM user_tbl WHERE role = 3";
    $result = mysqli_query($con, $sql);
    $percentage_voted = ($total_voters_done/$total_voters)*100;
} else {
    $percentage_voted = 0; // No voters, set percentage to 0
}

header('Content-Type: application/json');
echo json_encode([
    'total_voters' => $total_voters,
    'total_voters_done' => $total_voters_done,
    'total_voters_notdone' => $total_voters_notdone,
    'percentage_voted' => $percentage_voted,
]);
?>
