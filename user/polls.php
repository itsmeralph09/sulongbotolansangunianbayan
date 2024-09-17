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
                        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-square-poll-vertical mr-2"></i>POLLS</h1>
                        <!-- <a href="users-deleted.php" class="btn btn-sm btn-info shadow-sm"><i class="fas fa-trash fa-sm"></i> Archived Users</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">LIST OF POLLS</h6>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>                                        
                                                    <th scope="col">Title</th>                                               
                                                    <th scope="col">Description</th>                                  
                                                    <th scope="col">Status</th>                                              
                                                    <th scope="col">Action</th>                            
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php
                                                    $user_id = $_SESSION['user_id'];

                                                    require '../db/dbconn.php';
                                                    $display_users = "SELECT * FROM `poll_tbl` WHERE poll_status = 'OPEN' AND deleted = 0";
                                                    $sqlQuery = mysqli_query($con, $display_users) or die(mysqli_error($con));

                                                    $counter = 1;

                                                    while($row = mysqli_fetch_array($sqlQuery)){
                                                        $poll_id = $row['poll_id'];
                                                        $poll_title = $row['poll_title'];
                                                        $poll_description = $row['poll_description'];
                                                        $poll_status = $row['poll_status'];

                                                        if ($poll_status == "CLOSE") {
                                                            $status_text = "<span class='text-danger'>CLOSE</span>";
                                                        }elseif ($poll_status == "OPEN") {
                                                            $status_text = "<span class='text-success'>OPEN</span>";
                                                        }

                                                        // Check if the user has already voted for this poll
                                                        $check_vote_query = "SELECT * FROM poll_vote_tbl WHERE poll_id = '$poll_id' AND user_id = '$user_id'";
                                                        $check_vote_result = mysqli_query($con, $check_vote_query);
                                                        $has_voted = mysqli_num_rows($check_vote_result) > 0;

                                                ?>
                                                <tr>         
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <td class=""><?php echo $poll_title; ?></td>
                                                    <td class=""><?php echo $poll_description; ?></td>
                                                    <td class=""><?php echo $status_text; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($has_voted) { ?>
                                                            <a class="btn btn shadow-sm btn-primary" data-toggle="modal" data-target="#view_vote_<?php echo $poll_id; ?>">
                                                                <i class="fa-solid fa-eye mr-1"></i>View
                                                            </a>
                                                        <?php }else{ ?>
                                                            <a class="btn btn shadow-sm btn-success " data-toggle="modal" data-target="#vote_<?php echo $poll_id; ?>">
                                                                <i class="fa-solid fa-hand-pointer mr-1"></i>Vote
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $counter++;
                                                    include('modal/poll_vote_modal.php');
                                                    include('modal/poll_voteview_modal.php');
                                                } 
                                                ?>
                                            </tbody>

                                        </table>
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
            })
        });
    </script>

    <!-- Vote -->
<script>
    $(document).ready(function() {
        // Function to show SweetAlert2 messages
        const showSweetAlert = (icon, title, message) => {
            Swal.fire({
                icon: icon,
                title: title,
                text: message
            });
        };

        // Delegate click event handling to a parent element
        $(document).on('click', '[id^="submitVote_"]', function(e) {
            e.preventDefault(); // Prevent default form submission
            var pollID = $(this).attr('id').split('_')[1]; // Extract poll ID
            var form = $('#voteForm_' + pollID); // Get the form data
            var modalDiv = $('#vote_' + pollID);
            var selectedOption = modalDiv.find('input[name="poll_option"]:checked'); // Get the selected option

            if (selectedOption.length === 0) {
                showSweetAlert('warning', 'No Option Selected', 'Please select an option before voting.');
            } else {
                var selectedOptionText = selectedOption.next('label').text(); // Get the selected option text

                Swal.fire({
                    title: 'Confirm your vote',
                    text: `You have selected: "${selectedOptionText}". Do you want to proceed?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, vote!',
                    cancelButtonText: 'No, cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/vote_poll.php', // URL to submit the form data
                            type: 'POST',
                            data: form.serialize(), // Form data to be submitted
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    Swal.fire(
                                        'Success!',
                                        response.message,
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                showSweetAlert('error', 'Error', 'Failed to submit your vote. Please try again later.');
                            }
                        });
                    }
                });
            }
        });
    });
</script>

</body>

</html>