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
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>ADD POLL</a>
                                        </div>
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
                                                    <th scope="col">Options</th>                                  
                                                    <th scope="col">Status</th>                                              
                                                    <th scope="col">Action</th>                            
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php

                                                    require '../db/dbconn.php';
                                                    $display_users = "SELECT * FROM `poll_tbl` WHERE deleted = 0";
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


                                                        if ($poll_status == "CLOSE") {
                                                            $status_button = "<a class='btn btn-sm btn-success open-poll-btn shadow-sm'
                                                                                data-toggle='tooltip' data-placement='right' title='Open " . htmlspecialchars($poll_title) . "'
                                                                                data-poll-id='" . htmlspecialchars($poll_id) . "'
                                                                                data-poll-title='" . htmlspecialchars($poll_title) . "'
                                                                                data-poll-description='" . htmlspecialchars($poll_description) . "'
                                                                                data-poll-status='" . htmlspecialchars($poll_status) . "'>
                                                                                <i class='fa-solid fa-play'></i>
                                                                              </a>";
                                                        } elseif ($poll_status == "OPEN") {
                                                            $status_button = "<a class='btn btn-sm btn-secondary close-poll-btn shadow-sm'
                                                                                data-toggle='tooltip' data-placement='right' title='Close " . htmlspecialchars($poll_title) . "'
                                                                                data-poll-id='" . htmlspecialchars($poll_id) . "'
                                                                                data-poll-title='" . htmlspecialchars($poll_title) . "'
                                                                                data-poll-description='" . htmlspecialchars($poll_description) . "'
                                                                                data-poll-status='" . htmlspecialchars($poll_status) . "'>
                                                                                <i class='fa-solid fa-stop'></i>
                                                                              </a>";
                                                        }

                                                        // Fetch poll options
                                                        $poll_options_query = "SELECT * FROM `poll_options_tbl` WHERE poll_id = $poll_id AND deleted = 0";
                                                        $options_result = mysqli_query($con, $poll_options_query) or die(mysqli_error($con));
                                                        $options = [];
                                                        while ($option_row = mysqli_fetch_array($options_result)) {
                                                            $options[] = $option_row['poll_option'];
                                                        }
                                                        $options_text = implode(', ', $options);

                                                ?>
                                                <tr>         
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <td class=""><?php echo $poll_title; ?></td>
                                                    <td class=""><?php echo (strlen($poll_description) > 30) ? substr($poll_description, 0, 30) . '...' : $poll_description; ?></td>
                                                    <td>
                                                        <ul>
                                                            <?php foreach ($options as $option): ?>
                                                                <li><small><?php echo htmlspecialchars($option); ?></small></li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </td>
                                                    <td class=""><?php echo $status_text; ?></td>
                                                    <td class="text-center">
                                                        <?php if ($poll_status == 'OPEN') { ?>
                                                            <a class="btn btn-sm shadow-sm btn-primary disabled" data-toggle="modal" data-target="#edit_<?php echo $poll_id; ?>">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        <?php }elseif ($poll_status == 'CLOSE') { ?>
                                                            <a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#edit_<?php echo $poll_id; ?>">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </a>
                                                        <?php } ?>
                                                        <?= $status_button ?>
                                                        <a class="btn btn-sm shadow-sm btn-info" 
                                                           href="poll_result.php?poll_id=<?= urlencode($poll_id) ?>&poll_title=<?= urlencode($poll_title) ?>&poll_description=<?= urlencode($poll_description) ?>">
                                                           <i class="fa-solid fa-poll"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger delete-poll-btn"
                                                           data-user-id="<?php echo $poll_id; ?>" 
                                                           data-user-title="<?php echo htmlspecialchars($poll_title); ?>"
                                                           data-user-description="<?php echo htmlspecialchars($poll_description); ?>"
                                                           data-user-status="<?php echo htmlspecialchars($poll_status); ?>"
                                                           >
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $counter++;
                                                    include('modal/poll_edit_modal.php');
                                                } 
                                                ?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php include('modal/poll_add_modal.php'); ?>
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

    <!-- Add Poll Modal Script -->
    <script>
        $(document).ready(function() {
            // Function to add new poll option input field with a remove button
            $('#add-option-button').on('click', function() {
                var newIndex = $('.poll-option-input').length;
                var newOption = `
                    <div class="col-12 form-group mb-3 px-0 poll-option-group">
                        <div class="col-12 d-flex">
                            <label class="control-label modal-label my-auto" for="poll_options_${newIndex}">Poll Option ${newIndex + 1} </label>
                        </div>
                        <div class="col-12 d-flex">
                            <input class="form-control poll-option-input custom-readonly-input" id="poll_options_${newIndex}" name="poll_options[]" type="text" required>
                            <button type="button" class="btn btn-danger ml-2 remove-option-button">Remove</button>
                        </div>
                    </div>`;
                $('#poll-options-container').append(newOption);
            });

            // Function to remove poll option input field
            $(document).on('click', '.remove-option-button', function() {
                $(this).closest('.poll-option-group').remove();
            });
        });
    </script>

    <!-- Edit Poll Modal Script -->
    <!-- <script>
        $(document).ready(function() {
            // Function to add new poll option input field with a remove button
            $(document).on('click', '[id^=add-option-button_]', function() {
                const poll_id = $(this).attr('id').split('_')[1];
                const newIndex = $('#poll-options-container_' + poll_id + ' .poll-option-input_' + poll_id).length;
                const newOption = `
                    <div class="col-12 form-group mb-3 px-0 poll-option-group">
                        <div class="col-12 d-flex">
                            <label class="control-label modal-label my-auto" for="poll_options_${poll_id}_${newIndex}">Poll Option ${newIndex + 1}</label>
                        </div>
                        <div class="col-12 d-flex">
                            <input class="form-control poll-option-input_${poll_id} custom-readonly-input" id="poll_options_${poll_id}_${newIndex}" name="poll_options[]" type="text" required>
                            <button type="button" class="btn btn-danger ml-2" id="remove-option-button_${poll_id}_${newIndex}">Remove</button>
                        </div>
                    </div>`;
                $('#poll-options-container_' + poll_id).append(newOption);
            });

            // Function to remove poll option input field
            $(document).on('click', '[id^=remove-option-button_]', function() {
                // const poll_id = $(this).closest('.modal').find('[id^=poc_]').attr('id').split('_')[1];
                const poll_id = $(this).attr('id').split('_')[1];
                console.log(poll_id);
                const remainingOptions = $('#poll-options-container_' + poll_id + ' .poll-option-group').length;

                // Prevent removal if only two options are left
                if (remainingOptions <= 2) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Cannot Remove Option',
                        text: 'At least two poll options are required.'
                    });
                } else {
                    $(this).closest('.poll-option-group').remove();
                }
            });
        });
    </script>
 -->
    <!-- Delete Poll -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-poll-btn').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                var pollID = deleteButton.data('user-id');
                var pollTitle = decodeURIComponent(deleteButton.data('user-title'));
                var pollDescription = decodeURIComponent(deleteButton.data('user-description'));
                var pollStatus = decodeURIComponent(deleteButton.data('user-status'));
                Swal.fire({
                    title: 'Delete Poll',
                    html: "You are about to delete the following poll:<br><br>" +
                          "<strong>Title:</strong> " + pollTitle + "<br>" +
                          "<strong>Description:</strong> " + pollDescription + "<br>" +
                          "<strong>Status:</strong> " + pollStatus + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_poll.php',
                            type: 'POST',
                            data: {
                                poll_id: pollID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Poll has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete poll.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete poll.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Open/Close Poll -->
    <script>
        $(document).ready(function() {
            // Function for opening/closing polls
            $('.open-poll-btn, .close-poll-btn').on('click', function(e) {
                e.preventDefault();
                var actionButton = $(this);
                var pollID = actionButton.data('poll-id');
                var pollTitle = actionButton.data('poll-title');
                var pollDescription = actionButton.data('poll-description');
                var pollStatus = actionButton.data('poll-status');
                var isOpenAction = actionButton.hasClass('open-poll-btn');
                var actionText = isOpenAction ? 'open' : 'close';
                var actionURL = isOpenAction ? 'action/open_poll.php' : 'action/close_poll.php';
                var confirmText = isOpenAction ? 'Yes, start!' : 'Yes, close!';

                Swal.fire({
                    title: isOpenAction ? 'Open Poll' : 'Close Poll',
                    html: "You are about to " + actionText + " the following poll:<br><br>" +
                          "<strong>Title:</strong> " + pollTitle + "<br>" +
                          "<strong>Description:</strong> " + pollDescription + "<br>" +
                          "<strong>Status:</strong> " + pollStatus + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: confirmText
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: actionURL,
                            type: 'POST',
                            data: {
                                poll_id: pollID
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Success!',
                                        'Poll has been ' + actionText + 'ed.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to ' + actionText + ' poll.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to ' + actionText + ' poll.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Add Poll-->
    <script>
        $(document).ready(function() {
            // Function to show SweetAlert2 warning message
            const showWarningMessage = (message) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: message
                });
            };

            $('#addPoll').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#addNew form'); // Select the form element

                const requiredFields = formData.find('[required], select');
                let fieldsAreValid = true; // Initialize as false

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty
                        showWarningMessage('Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });

                if (fieldsAreValid) {

                    $.ajax({
                        url: 'action/add_poll.php', // URL to submit the form data
                        type: 'POST',
                        data: formData.serialize(), // Serialize form data
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Poll added successfully!',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add poll!',
                                    text: 'Please try again later.',
                                    showConfirmButton: true,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed to add poll',
                                text: 'Please try again later.',
                                showConfirmButton: true, // Show OK button
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    });

                }
            });
        });
    </script>

    <!-- Update Poll -->
    <!-- <script>
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
            $(document).on('click', '[id^="updatePoll_"]', function(e) {
                e.preventDefault(); // Prevent default form submission
                var pollID = $(this).attr('id').split('_')[1]; // Extract event ID
                // var formData = $('#updateForm_' + pollID); // Get the form data
                var formData = $('#updateForm_' + pollID).serialize(); // Get the form data
                var modalDiv = $('#edit_' + pollID);

                let fieldsAreValid = true; // Initialize as true
                // const requiredFields = formData.find('[required]'); // Select required fields
                const requiredFields = modalDiv.find(':input[required]'); // Select required fields

                // Remove existing error classes
                $('.form-control').removeClass('input-error');

                requiredFields.each(function() {
                    // Check if the element is a select and it doesn't have a selected value
                    if ($(this).is('select') && $(this).val() === null) {
                        fieldsAreValid = false; // Set to false if any required select field doesn't have a value
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    }
                    // Check if the element is empty
                    else if ($(this).val().trim() === '') {
                        fieldsAreValid = false; // Set to false if any required field is empty or null
                        showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                        $(this).addClass('is-invalid'); // Add red border to missing field
                    } else {
                        $(this).removeClass('is-invalid'); // Remove red border if field is filled
                    }
                });
                
                if (fieldsAreValid) {
                    $.ajax({
                        url: 'action/update_poll.php', // URL to submit the form data
                        type: 'POST',
                        data: formData, // Form data to be submitted
                        dataType: 'json',
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
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
                            // Handle the error response
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            showSweetAlert('error', 'Error', 'Failed to update poll. Please try again later.');
                        }
                    });   
                }
            });
        });
    </script> -->
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

        // Function to refresh the form data
        const refreshFormData = (pollID) => {
            const form = $('#updateForm_' + pollID);
            form.find('.form-control').each(function() {
                $(this).val($(this).val()); // Force the form control to update its value
            });
        };

        // Function to add new poll option input field with a remove button
        $(document).on('click', '[id^=add-option-button_]', function() {
            const poll_id = $(this).attr('id').split('_')[1];
            const newIndex = $('#poll-options-container_' + poll_id + ' .poll-option-input_' + poll_id).length;
            const newOption = `
                <div class="col-12 form-group mb-3 px-0 poll-option-group">
                    <div class="col-12 d-flex">
                        <label class="control-label modal-label my-auto" for="poll_options_${poll_id}_${newIndex}">Poll Option ${newIndex + 1}<small class="text-info my-0"> (New Option)</small></label>
                    </div>
                    <div class="col-12 d-flex">
                        <input class="form-control poll-option-input_${poll_id} custom-readonly-input" id="poll_options_${poll_id}_${newIndex}" name="poll_options[]" type="text" required>
                        <button type="button" class="btn btn-danger btn-sm ml-2" id="remove-option-button_${poll_id}_${newIndex}"><i class="fa-solid fa-xmark"></i></button>
                        <button type="button" class="btn btn-success btn-sm ml-2" id="save-option-button_${poll_id}_${newIndex}"><i class="fa-solid fa-check"></i></button>
                    </div>
                </div>`;
            $('#poll-options-container_' + poll_id).append(newOption);
            refreshFormData(poll_id); // Refresh form data after adding a new option
        });

        // Function to remove poll option input field
        $(document).on('click', '[id^=remove-option-button_]', function() {
            const poll_id = $(this).attr('id').split('_')[1];
            const remainingOptions = $('#poll-options-container_' + poll_id + ' .poll-option-group').length;

            // Prevent removal if only two options are left
            if (remainingOptions <= 2) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cannot Remove Option',
                    text: 'At least two poll options are required.'
                });
            } else {
                $(this).closest('.poll-option-group').remove();
                refreshFormData(poll_id); // Refresh form data after removing an option
            }
        });

        // Function to handle Save button click
        $(document).on('click', '[id^=save-option-button_]', function() {
            const buttonId = $(this).attr('id');
            const poll_id = buttonId.split('_')[1];
            const optionIndex = buttonId.split('_')[2];
            const optionValue = $(`#poll_options_${poll_id}_${optionIndex}`).val();

            if (optionValue.trim() === '') {
                showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                $(`#poll_options_${poll_id}_${optionIndex}`).addClass('is-invalid'); // Add red border to missing field
                return;
            }

            $.ajax({
                url: 'action/save_new_option.php', // URL to handle saving new options
                type: 'POST',
                data: {
                    poll_id: poll_id,
                    poll_option: optionValue
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire(
                            'Success!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh page or handle accordingly
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
                    Swal.fire(
                        'Error!',
                        'Failed to save new option. Please try again later.',
                        'error'
                    );
                }
            });
        });

        // Handle form submission
        $(document).on('click', '[id^="updatePoll_"]', function(e) {
            e.preventDefault(); // Prevent default form submission
            var pollID = $(this).attr('id').split('_')[1]; // Extract poll ID
            var form = $('#updateForm_' + pollID);
            var formData = form.serialize(); // Serialize form data
            var modalDiv = $('#edit_' + pollID);

            let fieldsAreValid = true; // Initialize as true
            const requiredFields = modalDiv.find(':input[required]'); // Select required fields

            // Remove existing error classes
            form.find('.form-control').removeClass('is-invalid');

            requiredFields.each(function() {
                // Check if the element is empty
                if ($(this).val().trim() === '') {
                    fieldsAreValid = false; // Set to false if any required field is empty
                    showSweetAlert('warning', 'Oops!', 'Please fill-up the required fields.');
                    $(this).addClass('is-invalid'); // Add red border to missing field
                } else {
                    $(this).removeClass('is-invalid'); // Remove red border if field is filled
                }
            });

            if (fieldsAreValid) {
                $.ajax({
                    url: 'action/update_poll.php', // URL to submit the form data
                    type: 'POST',
                    data: formData, // Form data to be submitted
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response
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
                        // Handle the error response
                        showSweetAlert('error', 'Error', 'Failed to update poll. Please try again later.');
                    }
                });
            }
        });
    });
</script>


</body>

</html>