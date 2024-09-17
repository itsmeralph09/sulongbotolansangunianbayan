<?php
  require_once "function/check_session.php";
  // Check if user_id and role sessions are already set
  redirectToDashboard();
?>
<!doctype html>
<html lang="en">

<head>
  <title>PCB BOT</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="icon" href="img/botlogo.png" type="png">

  <!-- SWEETALERT2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js" integrity="sha256-+0Qf8IHMJWuYlZ2lQDBrF1+2aigIRZXEdSvegtELo2I=" crossorigin="anonymous"></script>

  <style>
    body.swal2-shown > [aria-hidden='true'] {
      transition: 0.1s filter;
      filter: blur(3px);
    }
  </style>

</head>
<body>
  <?php displaySessionErrorMessage(); ?>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="img/botlogo.png" class="img-fluid" alt="BOT logo image" height="auto" width="auto">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="post" id="loginForm">

            <p class="text-center h2 fw-bold mb-4 mx-1 mx-md-3 mt-3" style="color: #830408;">PCB | Board of Trustees</p>

             <!-- Email input -->
            <div class="form-floating mb-4">
              <input type="text" class="form-control" name="username" autocomplete="off" id="floatingInput" placeholder="Enter your username" style="border-radius: 20px ;" required>
              <label for="floatingInput">Username</label>
            </div>
            
             <!-- Password input -->
            <div class="form-floating mb-4">
              <input type="password" class="form-control" name="password" autocomplete="off" id="floatingPassword" placeholder="Enter your password" style="border-radius: 20px ;" required>
              <label for="floatingPassword">Password</label>
            </div>

             <!-- Submit button -->
            <div class="d-flex justify-content-center mx-1 mb-3 mb-lg-1">
              <input type="submit" value="Login" name="login" id="login-btn" class="btn btn-danger btn-lg text-light my-2 py-3" style="width:100% ; border-radius: 30px; font-weight:600;" />
            </div>

           </form>
          
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery Library -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Custom JavaScript -->
  <script>
      const showWarningMessage2 = (message) => {
          Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: message
          });
      };

      $(document).ready(function() {
          $('#login-btn').on('click', function(event) {
              event.preventDefault();

              const $loginForm = $('#loginForm');
              const $requiredFields = $loginForm.find('input[required]');
              let fieldsAreValid = true; // Initialize as true

              $requiredFields.each(function() {
                  if ($(this).val().trim() === '') {
                      fieldsAreValid = false; // Set to false if any required field is empty
                      $(this).addClass('is-invalid'); // Add red border to missing field
                  } else {
                      $(this).removeClass('is-invalid'); // Remove red border if field is filled
                  }
              });

              // Proceed with AJAX request if all required fields are filled
              if (fieldsAreValid) {
                  // Perform AJAX request
                  $.ajax({
                      url: './action/login_action.php',
                      type: 'POST',
                      data: $loginForm.serialize(),
                      dataType: 'json',
                      success: function(response) {
                          if (response.success) {
                              // Redirect based on session role
                              const role = response.role;
                              if (role === "ADMIN") {
                                  window.location.href = './admin/index.php'; // Redirect to admin dashboard
                              } else if (role === "USER") {
                                  window.location.href = './user/index.php'; // Redirect to user page
                              }
                          } else {
                              // If AJAX request is successful but response indicates error, show SweetAlert error message
                              showWarningMessage2(response.message || 'Invalid username or password. Please try again.');
                          }
                      },
                      error: function(xhr, status, error) {
                          // If AJAX request fails, show SweetAlert error message
                          showWarningMessage2('Failed to submit the form. Please try again later.');
                          console.error(xhr.responseText);
                      }
                  });
              } else {
                  // If any required field is empty, show SweetAlert error message
                  showWarningMessage2('Please fill out all required fields.');
              }
          });
      });
  </script>

</body>

</html>