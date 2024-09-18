<?php
require 'function/check_session.php';

// Call the checkSession function to perform session validation
checkSession();

// Database connection details
$host = 'localhost'; // Your database host
$dbname = 'u293681336_szp'; // Your database name
$username = 'u293681336_szp'; // Your database username
$password = 'Moondrop#123'; // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user_id']; // Replace this with $_SESSION['user_id'] if session is used

    // Fetch the user's votes
    $stmt = $pdo->prepare("SELECT v.candidate_id, c.first_name, c.middle_name, c.last_name, c.stage_name, c.picture 
                            FROM vote_tbl v 
                            JOIN candidate_tbl c ON v.candidate_id = c.candidate_id 
                            WHERE v.user_id = :user_id AND v.deleted = 0");
    $stmt->execute([':user_id' => $userId]);
    $votes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SZP - Sulong Botolan</title>
    <link rel="icon" href="../img/SZP.png" type="png">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border: 1px solid #ccc;
            margin: 10px;
            border-radius: 5px;
        }
        .card img {
            width: 100%;
            border-bottom: 1px solid #ccc;
        }
        .countdown {
            font-size: 1.5rem;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Vote Receipt</h1>
        <div class="row">
            <?php foreach ($votes as $vote): 
                $fullName = htmlspecialchars("{$vote['first_name']}" . 
                    (!empty($vote['stage_name']) ? " \"{$vote['stage_name']}\"" : "") . 
                    " {$vote['middle_name']} {$vote['last_name']}");
                $picturePath = '../pictures/' . htmlspecialchars($vote['picture']);
            ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="<?php echo $picturePath; ?>" class="card-img-top" alt="<?php echo $fullName; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $fullName; ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="logout-btn" class="btn btn-danger mt-3">Logout</button>
        <p class="countdown mt-3">You will be logged out automatically in <span id="countdown-timer">10</span> seconds.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Countdown timer for automatic logout
        let countdown = 10;
        const countdownElement = document.getElementById('countdown-timer');
        const logoutButton = document.getElementById('logout-btn');
        
        const timer = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;

            if (countdown <= 0) {
                clearInterval(timer);
                window.location.href = '../function/logout_action.php'; // Redirect to logout page
            }
        }, 1000);

        // Handle logout button click
        logoutButton.addEventListener('click', () => {
            clearInterval(timer);
            window.location.href = '../function/logout_action.php'; // Redirect to logout page
        });
    </script>
</body>
</html>
