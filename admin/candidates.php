<!DOCTYPE html>
<html lang="en">

<?php include './include/head.php'; ?>

<body id="page-top">
    <div class="d-none" id="candidates"></div>

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
                        <h1 class="h3 mb-0 text-gray-800"><i class="fa-solid fa-users-line mr-2"></i>MANAGE CANDIDATES</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header -->
                                <div class="card-header py-3 d-flex flex-column flex-md-row">
                                    <div class="col-12 col-md-6 d-flex align-items-center justify-content-start mx-0 px-0 mb-2 mb-md-0">
                                        <h6 class="font-weight-bold text-danger mb-0">LIST OF CANDIDATES</h6>
                                    </div>
                                   <!--  <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mx-0 px-0">
                                        <div class="col-12 col-md-4 float-right mx-0 px-0">
                                            <a data-toggle="modal" data-target="#addNew" class="btn btn-success shadow-sm w-100 h-100"><i class="fa-solid fa-plus mr-1"></i>ADD NEW</a>
                                        </div>
                                    </div> -->
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered nowrap table-striped table-hover" id="myTable" width="100%" cellspacing="0">
                                            <thead class="">
                                                <tr>
                                                  
                                                    <th scope="col">#</th>
                                                    <th scope="col">Picture</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Stage Name</th>
                                                    <th scope="col">Address</th>
                                                    
                                                    <!-- <th scope="col">Action</th> -->
                                                   
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <?php

                                                    require '../db/dbconn.php';
                                                    $display_candidates = "SELECT * FROM `candidate_tbl` WHERE deleted = 0";
                                                    $sqlQuery = mysqli_query($con, $display_candidates) or die(mysqli_error($con));

                                                    $counter = 1;

                                                    while($row = mysqli_fetch_array($sqlQuery)){
                                                        $candidate_id = $row['candidate_id'];
                                                        
                                                        $first_name = $row['first_name'];
                                                        $middle_name = $row['middle_name'];
                                                        $last_name = $row['last_name'];

                                                        $suffix_name = $row['suffix_name'];
                                                        if ($suffix_name == 'N/A') {
                                                            $suffix = '';
                                                        }else{
                                                            $suffix = $suffix_name;
                                                        }

                                                        $stage_name = $row['stage_name'];
                                                        $purok = $row['purok'];
                                                        $barangay = $row['barangay'];
                                                        $gender = $row['gender'];
                                                        $birthdate = $row['birthdate'];
                                                        $civil_status = $row['civil_status'];
                                                        $occupation = $row['occupation'];
                                                        $contact_number = $row['contact_number'];
                                                        $picture = $row['picture'];

                                                        $full_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . ' ' . $suffix;

                                                ?>
                                                <tr>
                                                        
                                                    <td class=""><?php echo $counter; ?></td>
                                                    <td class="d-flex">
                                                        <a href="../pictures/<?= $picture ?>" data-lightbox="picture-<?= $candidate_id ?>" data-title="<?= $full_name ?>">
                                                            <img class="mx-auto rounded" src="../pictures/<?php echo $picture; ?>" alt="Candidate Picture" style="width: 60px; height: 60px; object-fit: cover;">
                                                        </a>
                                                    </td>  
                                                    <td class=""><?php echo $full_name; ?></td>
                                                    <td class=""><?php echo $stage_name; ?></td>
                                                    <td class="">PUROK <?php echo $purok; ?>, <?php echo $barangay; ?></td>
                                                    
                                                  <!--   <td class="text-center">
                                                        <a class="btn btn-sm shadow-sm btn-primary" data-toggle="modal" data-target="#edit_<?= $candidate_id ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="#" class="btn btn-sm btn-danger delete-candidate-btn"
                                                           data-candidate-id="<?php echo $candidate_id; ?>" 
                                                           data-candidate-name="<?php echo htmlspecialchars($full_name); ?>"
                                                           data-candidate-stagename="<?php echo htmlspecialchars($stage_name); ?>"
                                                           data-candidate-address="<?php echo 'PUROK ' . htmlspecialchars($purok) . ', ' . htmlspecialchars($barangay); ?>">
                                                           <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td> -->
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
    <script>
        lightbox.option({
          'resizeDuration': 400,
          'imageFadeDuration': 400,
          'fadeDuration': 400
        })
    </script>
    <script>
         // Birth Date Validation
         document.getElementById('birthdate').addEventListener('change', function() {
             var inputDate = new Date(this.value);
             var currentDate = new Date();

             // Check if the input date is set and not in the future
             if (!this.value || inputDate > currentDate) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Invalid...',
                     text: 'Please select a valid birthdate.'
                 });
                 $('input[name="birthdate"]').addClass('is-invalid');
                 this.value = ''; // Clear the input field
             } else if (inputDate.getMonth() === currentDate.getMonth() && inputDate.getDate() === currentDate.getDate() && inputDate.getFullYear() === currentDate.getFullYear()) {
                 Swal.fire({
                     icon: 'error',
                     title: 'Invalid...',
                     text: 'Please select a valid birthdate.'
                 });
                 $('input[name="birthdate"]').addClass('is-invalid');
                 this.value = ''; // Clear the input field
             }
         });

         // Input Element for Contact Number
         function limitContactInputLength(event) {
             // Remove non-digit characters
             var inputValue = event.target.value.replace(/\D/g, '');

             // Limit the length to 11 digits
             if (inputValue.length > 11) {
                 inputValue = inputValue.slice(0, 11);
             }

             // Update the input value
             event.target.value = inputValue;
         }

         // Contact Input Validation
         var contactInput = document.getElementById('contact_number');
         contactInput.addEventListener('input', limitContactInputLength);

      </script>

    <!-- Delete Candidate Account -->
    <script>
        $(document).ready(function() {
            // Function for deleting event
            $('.delete-candidate-btn').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                var candidateId = deleteButton.data('candidate-id');
                var candidateName = decodeURIComponent(deleteButton.data('candidate-name'));
                var candidateStagename = decodeURIComponent(deleteButton.data('candidate-stagename'));
                var candidateAddress = decodeURIComponent(deleteButton.data('candidate-address'));
                
                Swal.fire({
                    title: 'Delete Candidate',
                    html: "You are about to delete the following candidate:<br><br>" +
                          "<strong>Candidate Name:</strong> " + candidateName + "<br>" +
                          "<strong>Stage Name:</strong> " + candidateStagename + "<br>" +
                          "<strong>Address:</strong> " + candidateAddress + "<br>",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'action/delete_candidate.php',
                            type: 'POST',
                            data: {
                                candidate_id: candidateId
                            },
                            success: function(response) {
                                if (response.trim() === 'success') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Candidate has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete candidate.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Failed to delete candidate.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Add Candidate Account-->
    <script>
        $(document).ready(function() {
            // Variable to track if the profile picture is changed
            let profileValid = false;

            // Function to show SweetAlert2 warning message
            const showWarningMessage = (message) => {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: message
                });
            };

            // Function to handle file input change event for profile picture
            $('#profileUpload').on('change', function() {
                const fileInput = $(this)[0];
                const file = fileInput.files[0];

                // Update the label text with the selected file name
                $(this).next('#profileLabel').text(file.name);

                // Set profileValid to true when a new profile picture is selected
                profileValid = true;

                // Check if the file type is allowed
                const allowedTypes = ['image/png', 'image/jpeg', 'image/webp'];
                if (allowedTypes.includes(file.type)) {
                    // Read the selected file and display the preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#profilePreview').attr('src', e.target.result); // Set image source to preview element
                        $('input[name="profile"]').removeClass('input-error');
                        $('.custom-file-label[for="profileUpload"]').removeClass('input-error'); // Add input-error class to the label as well
                    };
                    reader.readAsDataURL(file);
                } else {
                    // Show warning message for invalid file type
                    showWarningMessage('Please select a valid image file (PNG, JPG, WEBP).');
                    profileValid = false;
                    $('#profileUpload').val(''); // Clear the file input
                    $('input[name="profile"]').addClass('input-error');
                    $('.custom-file-label[for="profileUpload"]').addClass('input-error'); // Add input-error class to the label as well
                }
            });

            $('#addCandidate').on('click', function(e) {
                e.preventDefault(); // Prevent default form submission

                var formData = $('#addNew form'); // Select the form element
                var formDataSend = new FormData($('#addNew form')[0]); // Select the form element

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

                let passwordsAreValid = true; // Initialize as true
                const password = formData.find('input[name="password"]').val();
                const confirmPassword = formData.find('input[name="confirm_password"]').val();

                if (fieldsAreValid) {
                    if (password !== confirmPassword) {
                        passwordsAreValid = false;
                        showWarningMessage("Passwords don't match. Please check and try again.");
                        formData.find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                    } else {
                        formData.find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                    }
                }

                if (fieldsAreValid && passwordsAreValid) {
                    // Check if profile picture is changed
                    if (!profileValid) {
                        showWarningMessage('Please upload a valid picture.');
                        $('input[name="profile"]').addClass('input-error');
                        $('.custom-file-label[for="profileUpload"]').addClass('input-error'); // Add input-error class to the label as well
                        return; // Stop form submission
                    }
                        
                    $.ajax({
                        url: 'action/add_candidate.php', // URL to submit the form data
                        type: 'POST',
                        data: formDataSend,
                        contentType: false, // Important: Prevent jQuery from setting contentType
                        processData: false,
                        success: function(response) {
                            // Handle the success response
                            console.log(response); // Output response to console (for debugging)
                            if (response === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Candidate added successfully!',
                                    showConfirmButton: true, // Show OK button
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Failed to add candidate!',
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
                                title: 'Failed to add candidate',
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

    <!-- Update Candidate Account -->
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
            $(document).on('click', '[id^="updateUser_"]', function(e) {
                e.preventDefault(); // Prevent default form submission
                var userID = $(this).attr('id').split('_')[1]; // Extract event ID
                var formData = $('#updateForm_' + userID); // Get the form data
                var modalDiv = $('#edit_' + userID);

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

                let passwordsAreValid = true; // Initialize as true
                const password = modalDiv.find('input[name="password"]').val();
                const confirmPassword = modalDiv.find('input[name="confirm_password"]').val();

                if (fieldsAreValid && password !== '') {
                    if (password !== confirmPassword) {
                        passwordsAreValid = false;
                        showSweetAlert('warning','Oops!',"Passwords don't match. Please check and try again.");
                        modalDiv.find('input[name="confirm_password"]').addClass('is-invalid'); // Add red border to confirm password field
                    } else {
                        modalDiv.find('input[name="confirm_password"]').removeClass('is-invalid'); // Remove red border if passwords match
                    }
                }
                
                if (fieldsAreValid && passwordsAreValid) {
                    // Perform check for crop name existence
                    $.ajax({
                        url: 'action/check_user_existence.php', // URL to check if UID and email exist
                        type: 'POST',
                        data: formData.serialize(), // Form data to be checked
                        dataType: 'json', // Specify JSON data type for response
                        success: function(response) {
                            // Remove existing error classes
                            $('.form-control').removeClass('input-error');

                            if (response.exists.username && response.exists.email) {
                                showSweetAlert('error', 'Oops!', 'Username and Email already exists.');
                                modalDiv.find('input[name="username"]').addClass('input-error');
                                modalDiv.find('input[name="email"]').addClass('input-error');
                            }else if (response.exists.username) {
                                showSweetAlert('error', 'Oops!', 'Username already exists.');
                                modalDiv.find('input[name="username"]').addClass('input-error');
                            } else if (response.exists.email) {
                                showSweetAlert('error', 'Oops!', 'Email already exists.');
                                modalDiv.find('input[name="email"]').addClass('input-error');
                            } else {
                                // If Garden Code and Garden Name do not exist, proceed with updating
                                $.ajax({
                                    url: 'action/update_user.php', // URL to submit the form data
                                    type: 'POST',
                                    data: formData.serialize(), // Form data to be submitted
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
                                        showSweetAlert('error', 'Error', 'Failed to update user. Please try again later.');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle the error response for existence check
                            console.error(xhr.responseText); // Output error response to console (for debugging)
                            showSweetAlert('error', 'Error', 'Failed to check Username and Email existence. Please try again later.');
                        }
                    });
                }
            });
        });
    </script>

</body>

</html>