<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
      body{display:flex;justify-content:center;align-items:center;min-height:100vh;background:#f4f4f4;font-family:Arial, sans-serif}
      .signup-box{width:520px;background:#fff;padding:28px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.08)}
      .signup-box h2{text-align:center;margin-bottom:20px}
      .form-control{height:48px}
      .submit-btn{height:48px}
      .small-note{font-size:14px;color:black;margin-top:10px;text-align:center}
      .password-container {position:relative;display:flex;align-items:center;width:100%}
      .password-container input {width:100%;height:48px;padding:0 50px 0 12px;border-radius:4px;border:1px solid #ced4da;outline:none}
      .password-container input:focus {border-color:#80bdff;box-shadow:0 0 0 0.2rem rgba(0,123,255,0.25)}
      .field-icon {position:absolute;right:15px;top:50%;transform:translateY(-50%);cursor:pointer;color:#222;font-size:16px;z-index:2}
      .password-match-icon {position:absolute;right:45px;top:50%;transform:translateY(-50%);font-size:16px;z-index:1;display:none}
      .password-match-icon.error {color:#dc3545;display:block}
      .password-match-icon.success {color:#28a745;display:block}
    </style>
  </head>
  <body>

    <div class="signup-box">
      <h2>Create an account</h2>

      <form method="post" action="<?php echo base_url('Main/register'); ?>" id="signupForm">

        <div class="row g-3">
          <div class="col-md-6">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="col-md-6">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
          </div>

          <div class="col-12">
            <div class="password-container">
              <input type="password" id="passwordField" name="password" placeholder="Password (min 6 chars)" required minlength="6">
              <span toggle="#passwordField" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
          </div>

          <div class="col-12">
            <div class="password-container">
              <input type="password" id="verifyPasswordField" name="confirm_password" placeholder="Confirm Password" required minlength="6">
              <span class="fa fa-times-circle password-match-icon" id="matchIcon"></span>
              <span toggle="#verifyPasswordField" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
          </div>

          <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="First name" required>
          </div>
          <div class="col-md-4">
            <input type="text" name="middlename" class="form-control" placeholder="Middle name">
          </div>
          <div class="col-md-4">
            <input type="text" name="surname" class="form-control" placeholder="Surname" required>
          </div>

          <div class="col-md-6">
            <input type="date" name="dateofbirth" class="form-control" placeholder="Date of birth" required>
          </div>
          <div class="col-md-6">
            <select name="gender" class="form-control" required>
              <option value="">Select gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>

          <div class="col-md-6">
            <input type="text" name="companyposition" class="form-control" placeholder="Company / Position">
          </div>
          <div class="col-md-6">
            <select name="department" class="form-control" required>
              <option value="">Select Division/Section</option>
              <option value="FAD">FAD</option>
              <option value="DUMMY1">DUMMY1</option>
              <option value="DUMMY2">DUMMY2</option>
            </select>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-dark w-100 submit-btn">Create account</button>
          </div>
        </div>

        <div class="small-note">Already have an account? <a href="<?php echo base_url('Main'); ?>" style="color:black;"><strong>Login</strong></a></div>

      </form>
    </div>

    <!-- Flash messages via SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

      // Real-time password match validation
      $("#verifyPasswordField, #passwordField").on("keyup", function() {
        var password = $("#passwordField").val();
        var confirmPassword = $("#verifyPasswordField").val();
        var matchIcon = $("#matchIcon");
        
        if (confirmPassword.length > 0) {
          if (password !== confirmPassword) {
            matchIcon.removeClass("fa-check-circle success").addClass("fa-times-circle error");
          } else {
            matchIcon.removeClass("fa-times-circle error").addClass("fa-check-circle success");
          }
        } else {
          matchIcon.removeClass("error success");
        }
      });

      // Password match validation
      $("#signupForm").on("submit", function(e) {
        var password = $("#passwordField").val();
        var confirmPassword = $("#verifyPasswordField").val();
        
        if (password !== confirmPassword) {
          e.preventDefault();
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Password not match...'
          });
          // Clear only password fields
          $("#passwordField").val('');
          $("#verifyPasswordField").val('');
          $("#matchIcon").removeClass("error success");
          return false;
        }
      });

      <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({icon:'error',title:'Oops...',text:'<?= addslashes($this->session->flashdata('error')); ?>'});
      <?php elseif ($this->session->flashdata('success')): ?>
        Swal.fire({icon:'success',title:'Success!',text:'<?= addslashes($this->session->flashdata('success')); ?>'});
      <?php endif; ?>
    </script>

  </body>
</html>
