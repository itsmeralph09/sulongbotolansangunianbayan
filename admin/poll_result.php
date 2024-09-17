<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="polls"></div>

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
                        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-square-poll-vertical mr-2"></i>POLL RESULT</h1>
                        <a href="polls.php" class="btn btn-sm btn-secondary shadow-sm"><i class="fas fa-chevron-left fa-sm"></i> BACK</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">POLL RESULTS FOR <?= urldecode($_GET['poll_title']) ?></h6>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <button class="btn btn-success shadow-sm w-100 h-100" id="printBtn"><i class="fa-solid fa-print mr-1"></i>PRINT RESULT</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                        $poll_id = urldecode($_GET['poll_id']);
                                        require '../db/dbconn.php';
                                        // Fetch poll options and their vote counts
                                        $poll_options_query = "SELECT 
                                                                    po.poll_option, 
                                                                    po.poll_option_id,
                                                                    COUNT(pv.poll_vote_id) AS vote_count 
                                                                FROM 
                                                                    poll_options_tbl po 
                                                                LEFT JOIN 
                                                                    poll_vote_tbl pv 
                                                                ON 
                                                                    po.poll_option_id = pv.poll_option_id 
                                                                WHERE 
                                                                    po.poll_id = $poll_id 
                                                                AND 
                                                                    po.deleted = 0 
                                                                GROUP BY 
                                                                    po.poll_option_id";
                                        $options_result = mysqli_query($con, $poll_options_query) or die(mysqli_error($con));

                                        $total_votes_query = "SELECT COUNT(*) AS total_votes FROM poll_vote_tbl WHERE poll_id = $poll_id AND deleted = 0";
                                        $total_votes_result = mysqli_query($con, $total_votes_query);
                                        $total_votes = mysqli_fetch_assoc($total_votes_result)['total_votes'];

                                        $options_with_voters = [];
                                        while ($option_row = mysqli_fetch_array($options_result)) {
                                            $option = $option_row['poll_option'];
                                            $option_id = $option_row['poll_option_id'];
                                            $vote_count = $option_row['vote_count'];
                                            $percentage = ($total_votes > 0) ? round(($vote_count / $total_votes) * 100, 2) : 0;

                                            // Fetch voter names for each option
                                            $voters_query = "SELECT u.first_name, u.last_name 
                                                             FROM poll_vote_tbl pv 
                                                             JOIN user_tbl u ON pv.user_id = u.user_id 
                                                             WHERE pv.poll_option_id = $option_id AND pv.deleted = 0";
                                            $voters_result = mysqli_query($con, $voters_query) or die(mysqli_error($con));

                                            $voters = [];
                                            while ($voter_row = mysqli_fetch_array($voters_result)) {
                                                $voters[] = $voter_row['first_name'] . ' ' . $voter_row['last_name'];
                                            }

                                            $options_with_voters[] = [
                                                'option' => $option,
                                                'vote_count' => $vote_count,
                                                'percentage' => $percentage,
                                                'voters' => $voters
                                            ];
                                        }

                                        $total_boards_query = "SELECT COUNT(*) AS total_boards FROM user_tbl WHERE role = 'USER' AND deleted = 0";
                                        $total_boards_result = mysqli_query($con, $total_boards_query);
                                        $total_boards = mysqli_fetch_assoc($total_boards_result)['total_boards'];
                                    ?>

                                    <div class="container-fluid" id="printArea">
                                        <div class="row">
                                            <div class="col-12">
                                                <h6>Poll Title: <span class="text-info"><?= urldecode($_GET['poll_title']) ?></span></h6>
                                            </div>
                                            <div class="col-12">
                                                <h6>Poll Description: <span class="text-info"><?= urldecode($_GET['poll_description']) ?></span></h6>
                                            </div>
                                            <div class="col-12">
                                                <h6>Total Number of Boards: <span class="text-info"><?= $total_boards ?></span></h6>
                                            </div>
                                            <div class="col-12">
                                                <h6>Current Number of Votes: <span class="text-info"><?= $total_votes ?></span></h6>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-3 d-flex justify-content-center">
                                            <div class="col-12 mb-2">
                                                <h5 class="text-center text-info">Poll Result</h5>
                                            </div>
                                            <div class="col-12">
                                                <table class="table table-bordered table-striped nowrap " id="" width="100%" cellspacing="">
                                                    <thead class="">
                                                        <tr>
                                                            <th>Options</th>
                                                            <th>Votes</th>
                                                            <th>Percentage</th>
                                                            <!-- <th>Voters</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($options_with_voters as $option_data): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($option_data['option']); ?></td>
                                                                <td><?= $option_data['vote_count']; ?></td>
                                                                <td><?= $option_data['percentage']; ?>%</td>
                                                                <!-- <td>
                                                                    <ul>
                                                                        <?php foreach ($option_data['voters'] as $voter): ?>
                                                                            <li><?= htmlspecialchars($voter); ?></li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                </td> -->
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include './include/logout_modal.php'; ?>

    <?php include './include/script.php'; ?>

    <script>
        $(document).ready(function(){
            //inialize datatable
            $('#myTable').DataTable({
                scrollX: true
            });

            // Print functionality
            $('#printBtn').click(function() {
                var printContent = document.getElementById('printArea').innerHTML;
                var originalContent = document.body.innerHTML;
                document.body.innerHTML = printContent;
                window.print();
                document.body.innerHTML = originalContent;
                window.location.reload();
            });
        });
    </script>

</body>

</html>