<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

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
                        <!-- <h1 class="text-center">Voting Results</h1> -->
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
                    sortedCardVotes.forEach(card => {
                        const cardElement = document.createElement('div');
                        cardElement.className = 'col-md-3';
                        cardElement.innerHTML = `
                            <div class="result-card ${card.rank <= 2 ? 'highlight' : 'non-top'}">
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

                    // Update chart
                    const ctx = document.getElementById('results-chart').getContext('2d');
                    const chartLabels = Object.values(cardNames);
                    const chartDataValues = Object.values(cardVotes);
                    const totalVotes = chartDataValues.reduce((a, b) => a + b, 0);
                    const chartPercentages = chartDataValues.map(votes => (votes / totalVotes) * 100);

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

                    Chart.register(ChartDataLabels);
                    new Chart(ctx, chartConfig);
                })
                .catch(error => console.error('Error fetching results:', error));
        }

        // Initial load and set up periodic updates
        updateResults();
        setInterval(updateResults, 5000); // Update every 5 seconds
    </script>

    
    </body>

</html>