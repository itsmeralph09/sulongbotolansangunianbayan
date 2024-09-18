<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="index"></div>

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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="font-weight-bold text-danger text-uppercase mb-1">
                                                Hello, <span class=""><?= $_SESSION['fullname']; ?>!</span></div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800">Welcome to Sulong Zambales - Sulong Botolan | Voting System.</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa-solid fa-clipboard-check text-danger fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Voters</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVoters">0</div> <!-- Updated -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users text-primary fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                HAVE VOTED</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVotersDone">0</div> <!-- Updated -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users text-success fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">HAVE NOT VOTED YET</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalVotersNotDone">0</div> <!-- Updated -->
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users text-info fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Votes Percentage</div>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" id="votingPercentage">0%</div> <!-- Updated -->
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-warning" role="progressbar" id="votingProgressBar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div> <!-- Updated -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fa-users text-warning fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded-circle bg-primary" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>
    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <script>
        $(document).ready(function() {
            function fetchVoterStats() {
                $.ajax({
                    url: 'fetch_voter_stats.php', // Your PHP endpoint
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // Update total voters
                        $('#totalVoters').text(data.total_voters);
                        // Update voters who have voted
                        $('#totalVotersDone').text(data.total_voters_done);
                        // Update voters who have not voted
                        $('#totalVotersNotDone').text(data.total_voters_notdone);
                        // Update voting percentage
                        $('#votingPercentage').text(data.percentage_voted.toFixed(2) + '%');
                        $('#votingProgressBar').css('width', data.percentage_voted + '%').attr('aria-valuenow', data.percentage_voted);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching voter stats:', error);
                    }
                });
            }

            // Fetch data initially
            fetchVoterStats();
            
            // Set interval to fetch data every 10 seconds
            setInterval(fetchVoterStats, 10000);
        });
    </script>
</body>

</html>
