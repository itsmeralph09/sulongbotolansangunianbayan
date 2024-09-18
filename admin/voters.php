<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="voters"></div>

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
                        <h1 class="h3 mb-0 text-gray-800"><i class="fa-solid fa-users mr-2"></i>MANAGE VOTERS</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">LIST OF VOTERS</h6>
                                    </div>
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <!-- <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>ADD NEW</a> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap table-striped table-hover" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>
                                                    
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Barangay</th>
                                                    
                                                    <th scope="col">Action</th>
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php

                                                    require '../db/dbconn.php';
                                                    $display_candidates = "SELECT * FROM `user_tbl` WHERE role = 3 AND deleted = 0";
                                                    $sqlQuery = mysqli_query($con, $display_candidates) or die(mysqli_error($con));

                                                    $counter = 1;

                                                    while($row = mysqli_fetch_array($sqlQuery)){
                                                        $user_id = $row['user_id'];
                                                        
                                                        $first_name = $row['first_name'];
                                                        $middle_name = $row['middle_name'];
                                                        $last_name = $row['last_name'];

                                                        $barangay = $row['barangay'];
                                                        $username = $row['username'];
                                                        

                                                        $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];

                                                ?>
                                                <tr>
                                                        
                                                    <td class=""><?php echo $counter; ?></td>
                                                    
                                                    <td class=""><?php echo $full_name; ?></td>
                                                    <td class=""><?php echo $username; ?></td>
                                                    <td class=""><?php echo $barangay; ?></td>
                                                    
                                                    <td class="text-center">
                                                        <!-- <a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#edit_<?= $user_id ?>"><i class="fa-solid fa-pen-to-square"></i></a> -->
                                                        <!-- <a href="#" class="btn btn-sm btn-danger delete-user-btn"
                                                           data-user-id="<?php echo $user_id; ?>" 
                                                           data-user-name="<?php echo htmlspecialchars($full_name); ?>"
                                                           data-user-username="<?php echo htmlspecialchars($username); ?>"
                                                           data-user-barangay="<?php echo htmlspecialchars($barangay); ?>">
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a> -->
                                                    </td>
                                                </tr>
                                                <?php
                                                    $counter++;
                                                    //include('modal/candidate_edit_modal.php');
                                                } 
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php // include('modal/candidate_add_modal.php'); ?>
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

</body>

</html>