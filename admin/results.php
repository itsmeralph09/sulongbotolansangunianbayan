<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>
<!-- <style>
    @media print {
        /* Hide sidebar during print */
        #wrapper .sidebar,
        #wrapper #sidebar {
            display: none !important;
        }

        #content-wrapper {
            margin-left: 0 !important; /* Expand content to take full width */
        }

        /* Hide print button during print */
        .print-button-container {
            display: none !important;
        }

        /* Adjust card styles for print */
        .result-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            height: auto; /* Allow cards to adjust height based on content */
            width: 100%; /* Full width for better printing */
            background-color: #fff; /* Ensure background is white for printing */
            position: relative; /* Needed for absolute positioning of the image */

        }

        .result-card img {
            width: 50px;
            height: 50px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        /* Green star icon for top two vote holders */
        .highlight::before {
            content: '★'; /* Unicode star character */
            position: absolute;
            top: 10px;
            right: 10px;
            color: green;
            font-size: 24px;
        }
       .highlight {
    background-color: #7fffce !important; /* Light green background */
    border: 2px solid green ; /* Green border */
    color: black; /* Ensure text is readable on light green background */
}

/* Light red border for non-top cards */
.non-top {
    border-color: lightcoral;
}
        .result-card h5,
        .result-card p {
            color: #000; /* Black text color for better readability */
            margin-top: 70px; /* Space for image and star */
        }

        /* Adjust chart for print */
        .chart-container {
            width: 100%;
            margin-top: 20px;
        }

        /* Hide page top button during print */
        .scroll-to-top {
            display: none !important;
        }
        
    }
</style> -->
<body id="page-top">
    <div class="d-none" id="results"></div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include './include/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include './include/topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Voting Results</h1>
                    </div>

                    <div class="result-container">
                        <div class="row" id="results-container">
                            <!-- Cards will be dynamically inserted here -->
                        </div>
                        <div class="chart-container">
                            <canvas id="results-chart"></canvas>
                        </div>
                        <div class="print-button-container">
                            <button class="btn btn-primary print-button" onclick="window.print()">
                                <i class="fas fa-print"></i> Print Results
                            </button>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './include/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded-circle bg-primary" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>

    <script>
        let chartInstance; // Variable to hold the chart instance

        function updateResults() {
            fetch('./action/fetch_result.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data); // Check data in the console
                    if (!data.votes) {
                        console.error('Data structure is incorrect:', data);
                        return;
                    }

                    const cardVotes = data.votes;
                    const cardNames = data.names;
                    const cardImages = data.images;
                    const cardRanks = data.ranks;

                    // Sort cards by votes and ranks
                    const sortedCardVotes = Object.keys(cardVotes)
                        .map(id => ({
                            id,
                            votes: cardVotes[id],
                            name: cardNames[id],
                            image: cardImages[id],
                            rank: cardRanks[id]
                        }))
                        .sort((a, b) => b.votes - a.votes || a.rank - b.rank);

                    // Update cards
                    const resultsContainer = document.getElementById('results-container');
                    resultsContainer.innerHTML = '';
                    sortedCardVotes.forEach((card, index) => {
                        const cardElement = document.createElement('div');
                        cardElement.className = 'col-md-3'; // 4 columns in a row (Bootstrap 4)

                        cardElement.innerHTML = `
                            <div class="result-card ${index < 2 ? 'highlight' : 'non-top'}">
                                <img src="${card.image}" class="card-img-top" alt="${card.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${card.name}</h5>
                                    <p class="card-text">${card.votes} votes</p>
                                    <p class="card-rank">Rank ${card.rank}</p>
                                </div>
                            </div>
                        `;
                        resultsContainer.appendChild(cardElement);
                    });

                    // Optional: Ensure the container has a row class if using Bootstrap
                    if (!resultsContainer.classList.contains('row')) {
                        resultsContainer.classList.add('row');
                    }

                    // Update chart
                    const ctx = document.getElementById('results-chart').getContext('2d');
                    const chartLabels = Object.values(cardNames);
                    const chartDataValues = Object.values(cardVotes);
                    const totalVotes = chartDataValues.reduce((a, b) => a + b, 0);
                    const chartPercentages = chartDataValues.map(votes => (votes / totalVotes) * 100);

                    console.log('Total Votes:', totalVotes);
                    console.log('Chart Data Values:', chartDataValues);
                    console.log('Chart Percentages:', chartPercentages);


                    const chartData = {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Number of Votes',
                            data: chartDataValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            hoverBackgroundColor: 'rgba(54, 162, 235, 0.7)',
                            hoverBorderColor: 'rgba(54, 162, 235, 1)'
                        }]
                    };

                    const chartConfig = {
                        type: 'bar',
                        data: chartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            const percentage = chartPercentages[tooltipItem.dataIndex].toFixed(2);
                                            return `${tooltipItem.label}: ${tooltipItem.raw} votes (${percentage}%)`;
                                        }
                                    }
                                },
                                datalabels: {
                                    display: true,
                                    color: 'black',
                                    formatter: (value, ctx) => {
                                        const percentage = chartPercentages[ctx.dataIndex].toFixed(2);
                                        return `${value}\n(${percentage}%)`;
                                    },
                                    anchor: 'end',
                                    align: 'center',
                                    padding: {
                                        top: 10,
                                        bottom: 5
                                    },
                                    font: {
                                        weight: 'bold',
                                        size: 12
                                    }
                                }
                            }
                        }
                    };

                    // Destroy existing chart before creating a new one
                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    Chart.register(ChartDataLabels);
                    chartInstance = new Chart(ctx, chartConfig);
                })
                .catch(error => console.error('Error fetching results:', error));
        }

        // Initial load and set up periodic updates
        updateResults();
        setInterval(updateResults, 5000); // Update every 5 seconds
    </script>


</body>

</html>
