<?php
// Database connection details
// Database connection details
$host = 'localhost'; // Your database host
$dbname = 'u293681336_szp'; // Your database name
$username = 'u293681336_szp'; // Your database username
$password = 'Moondrop#123'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch data from database including candidates with 0 votes
    $stmt = $pdo->query('
        SELECT c.candidate_id AS card_id, 
               COALESCE(COUNT(v.vote_id), 0) AS votes,
               c.first_name, c.middle_name, c.last_name, c.stage_name, c.picture
        FROM candidate_tbl c
        LEFT JOIN vote_tbl v ON c.candidate_id = v.candidate_id AND v.deleted = 0
        WHERE c.deleted = 0
        GROUP BY c.candidate_id
    ');

    $cardVotes = [];
    $cardNames = [];
    $cardImages = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cardVotes[$row['card_id']] = $row['votes'];
        $fullName = "{$row['first_name']}" . 
                    (!empty($row['stage_name']) ? " \"{$row['stage_name']}\"" : "") . 
                    " {$row['middle_name']} {$row['last_name']}";
        $cardNames[$row['card_id']] = $fullName;
        $cardImages[$row['card_id']] = '../pictures/' . $row['picture'];
    }

    // Sort cards by votes in descending order
    $sortedCardVotes = $cardVotes;
    arsort($sortedCardVotes);

    // Determine the ranks and handle ties
    $rankedCards = [];
    $rank = 1;
    $previousVotes = null;
    $tieRank = null;

    foreach ($sortedCardVotes as $id => $votes) {
        if ($previousVotes === null || $votes < $previousVotes) {
            $rank = count($rankedCards) + 1;
            $tieRank = $rank;
        }
        $rankedCards[$id] = $tieRank;
        $previousVotes = $votes;
    }

    $response = [
        'votes' => $cardVotes,
        'names' => $cardNames,
        'images' => $cardImages,
        'ranks' => $rankedCards
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
}
?>
