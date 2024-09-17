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

    // Fetch data from the candidate_tbl
    $stmt = $pdo->query("SELECT candidate_id, first_name, middle_name, last_name, stage_name, picture FROM candidate_tbl WHERE deleted = 0");
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    cursor: pointer;
    transition: background 0.3s ease;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    max-width: 200px; /* Set maximum width for uniformity */
    height: 250px; /* Set a fixed height for uniformity */
    margin: auto;
    display: flex;
    flex-direction: column; /* Stack image and text vertically */
}

.card img {
    width: 100%;
    height: 70%; /* Image occupies 70% of the card height */
    object-fit: cover; /* Ensures the image covers the area without distortion */
}

.card-body {
    height: 30%; /* Text area occupies the remaining 30% */
    display: flex;
    align-items: center; /* Vertically center text within the text area */
    justify-content: center; /* Horizontally center text within the text area */
    padding: 10px;
    text-align: center;
    background-color: #f8f9fa; /* Optional: Add a background color for better readability */
}

.card {
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

.card.selected {
    background-color: #28a745; /* Green background color when selected */
    color: white; /* White text color for better contrast */
    transform: scale(1.1);
    box-shadow: 0 0 15px rgba(0, 255, 0, 0.6);
}

.card.selected .card-body {
    background-color: #28a745; /* Green background for the text area when selected */
}
        .modal-content {
            text-align: center;
        }
        .btn-reset {
            background-color: #dc3545; /* Red background color */
            color: white;
        }
        .btn-reset:hover {
            background-color: #c82333; /* Darker red on hover */
        }
        .selected-cards img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <form id="voting-form" method="POST" action="save_votes.php">
            <div class="row col-12">
                <h3 class="">Hi, <span class="text-danger"><em><?= $_SESSION['fullname'] ?></em>!</span> Please vote for  two (2) SB Members.</h3>
            </div>
            <hr>
            <div class="row">
                <?php foreach ($cards as $card): 
                    $fullName = htmlspecialchars("{$card['first_name']}" . 
                        (!empty($card['stage_name']) ? " \"{$card['stage_name']}\"" : "") . 
                        " {$card['middle_name']} {$card['last_name']}"); 
                    $picturePath = '../pictures/' . htmlspecialchars($card['picture']);
                ?>
                    <div class="col-md-3 mb-3">
                        <div class="card shadow" data-id="<?php echo $card['candidate_id']; ?>">
                            <img src="<?php echo $picturePath; ?>" class="card-img-top" alt="<?php echo $fullName; ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?php echo $fullName; ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <input type="hidden" name="cards" id="selected-cards" value="">
            <div class="d-flex justify-content-between align-items-center my-3">
                <button type="button" id="reset-btn" class="btn btn-reset shadow-sm btn-lg">Reset</button>
                <button type="button" id="submit-btn" class="btn btn-primary ml-auto shadow-sm btn-lg" style="display: none;">Submit</button>
            </div>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Vote!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="confirmation-message">You have selected:</p>
                    <div id="selected-cards-display" class="justify-content-center">
                        <!-- Selected cards will be displayed here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="confirmVote()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Oops! You have already selected 2 candidates!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="error-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const maxSelection = 2;
        const cards = document.querySelectorAll('.card');
        const submitBtn = document.getElementById('submit-btn');
        const resetBtn = document.getElementById('reset-btn');
        const selectedCardsInput = document.getElementById('selected-cards');
        const confirmationModal = document.getElementById('confirmation-modal');
        const errorModal = document.getElementById('error-modal');
        const confirmationMessage = document.getElementById('confirmation-message');
        const selectedCardsDisplay = document.getElementById('selected-cards-display');
        const errorMessage = document.getElementById('error-message');

        cards.forEach(card => {
            card.addEventListener('click', () => {
                const selected = document.querySelectorAll('.card.selected').length;
                const isSelected = card.classList.contains('selected');

                if (isSelected) {
                    card.classList.remove('selected');
                } else if (selected < maxSelection) {
                    card.classList.add('selected');
                } else {
                    showErrorModal('You can only vote up to 2 candidates.');
                    return;
                }

                updateSelectedCards();
            });
        });

        function updateSelectedCards() {
            const selectedCards = document.querySelectorAll('.card.selected');
            const selectedIds = Array.from(selectedCards).map(card => card.getAttribute('data-id'));
            selectedCardsInput.value = selectedIds.join(',');

            if (selectedIds.length === maxSelection) {
                submitBtn.style.display = 'block';
            } else {
                submitBtn.style.display = 'none';
            }
        }

        function showModal() {
            const selectedCards = document.querySelectorAll('.card.selected');
            selectedCardsDisplay.innerHTML = '';

            selectedCards.forEach(card => {
                const imgSrc = card.querySelector('img').src;
                const cardName = card.querySelector('.card-title').textContent;

                const cardElement = document.createElement('div');
                cardElement.className = 'selected-cards d-flex flex-column align-items-center';
                cardElement.innerHTML = `
                    <img src="${imgSrc}" alt="${cardName}">
                    <p>${cardName}</p>
                `;
                selectedCardsDisplay.appendChild(cardElement);
            });

            $('#confirmation-modal').modal('show');
        }

        function showErrorModal(message) {
            errorMessage.textContent = message;
            $('#error-modal').modal('show');
        }

        function confirmVote() {
            document.getElementById('voting-form').submit();
        }

        submitBtn.addEventListener('click', () => {
            const selectedCards = document.querySelectorAll('.card.selected');
            if (selectedCards.length === maxSelection) {
                showModal();
            } else {
                showErrorModal('You must select exactly 2 cards.');
            }
        });

        resetBtn.addEventListener('click', () => {
            document.querySelectorAll('.card.selected').forEach(card => card.classList.remove('selected'));
            updateSelectedCards();
        });
    </script>
</body>
</html>
