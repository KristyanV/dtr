<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
      body {
        background: #f5f6f8;
      }
      .card {
        border: 1px solid #e1e4e8;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      }
      .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
      }
      .logo-section {
        display: flex;
        align-items: center;
        gap: 15px;
      }
      .logo-section img {
        height: 70px;
        width: auto;
      }
      .header-text h2 {
        margin: 0;
      }
      .header-text .text-muted {
        margin: 0;
      }
      .table th {
        background: #f8f9fa;
      }
      .table thead th {
        color: #000000 !important;
      }
      /* Signup Form Styles */
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
    <div class="container-fluid py-4">
      <div class="page-header mb-4">
        <div class="logo-section">
          <img src="<?= base_url('assets/image/prc_logo.png') ?>" alt="PRC Logo">
          <div class="header-text">
            <h2 class="mb-1">Admin Dashboard</h2>
            <strong><div class="text-muted">Hello, <?= htmlspecialchars($this->session->userdata('username') ?? 'Admin') ?></div></strong>
          </div>
        </div>
        <a href="<?= base_url('Main/signout') ?>" class="btn btn-outline-danger">Sign out</a>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card p-3">
            <h5 class="mb-2">Attendance Reports</h5>
            <p class="text-muted mb-3">View submitted reports and manage updates.</p>
            <a href="<?= base_url('Main/list') ?>" class="btn btn-primary">Go to Reports</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card p-3">
            <h5 class="mb-2">Create a Report</h5>
            <p class="text-muted mb-3">Open the attendance form to submit a report.</p>
            <a href="<?= base_url('Public_page/attendance_form') ?>" class="btn btn-success">Create Report</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card p-3">
            <h5 class="mb-2">Add Employee</h5>
            <p class="text-muted mb-3">Register a new employee account.</p>
            <button class="btn" id="addEmployeeBtn" style="background-color: #1400FF; color: white; border: none;">Add Employee</button>
          </div>
        </div>
      </div>

      <!-- User Management Table -->
      <div class="card p-4">
        <h4 class="mb-3">Registered Users</h4>
        
        <!-- Search Function -->
        <div class="mb-3">
          <input type="text" id="searchName" class="form-control" placeholder="Search by name...">
        </div>
        
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Name</th>
                <th>Position</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="userTableBody">
              <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                  <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['name'] . ' ' . ($user['surname'] ?? '')) ?></td>
                    <td><?= htmlspecialchars($user['companyposition'] ?? 'N/A') ?></td>
                    <td>
                      <span class="role-badge-<?= $user['id'] ?>">
                        <?= strtoupper(htmlspecialchars($user['role'] ?? 'viewer')) ?>
                      </span>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-warning edit-role-btn" 
                              data-user-id="<?= $user['id'] ?>" 
                              data-current-role="<?= htmlspecialchars($user['role'] ?? 'viewer') ?>">
                        EDIT ROLE
                      </button>
                      <button class="btn btn-sm btn-danger reset-password-btn" 
                              data-user-id="<?= $user['id'] ?>" 
                              data-username="<?= htmlspecialchars($user['username']) ?>">
                        RESET PASSWORD
                      </button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center text-muted">No users registered yet</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        // Store original table rows
        let allUsers = [];

        // Populate allUsers on page load
        $('#userTableBody tr').each(function() {
          allUsers.push($(this));
        });

        // Add Employee Button Handler
        $('#addEmployeeBtn').on('click', function() {
          handleAddEmployee();
        });

        // Handle add employee modal
        function handleAddEmployee() {
          Swal.fire({
            title: 'Add New Employee',
            html: `
              <div style="max-width: 520px; margin: 0 auto;">
                <form id="addEmployeeForm">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <input type="email" id="emp-email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                      <input type="text" id="emp-username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="col-12">
                      <div class="password-container">
                        <input type="password" id="emp-password" placeholder="Password (min 6 chars)" required minlength="6">
                        <span toggle="#emp-password" class="fa fa-fw fa-eye field-icon toggle-password-emp"></span>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="password-container">
                        <input type="password" id="emp-confirm-password" placeholder="Confirm Password" required minlength="6">
                        <span class="fa fa-times-circle password-match-icon" id="emp-matchIcon"></span>
                        <span toggle="#emp-confirm-password" class="fa fa-fw fa-eye field-icon toggle-password-emp"></span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <input type="text" id="emp-name" class="form-control" placeholder="First name" required>
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="emp-middlename" class="form-control" placeholder="Middle name">
                    </div>
                    <div class="col-md-4">
                      <input type="text" id="emp-surname" class="form-control" placeholder="Surname" required>
                    </div>

                    <div class="col-md-6">
                      <input type="date" id="emp-dateofbirth" class="form-control" placeholder="Date of birth" required>
                    </div>
                    <div class="col-md-6">
                      <select id="emp-gender" class="form-control" required>
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>

                    <div class="col-md-6">
                      <input type="text" id="emp-position" class="form-control" placeholder="Company / Position">
                    </div>
                    <div class="col-md-6">
                      <select id="emp-department" class="form-control" required>
                        <option value="">Select Division/Section</option>
                        <option value="FAD">FAD</option>
                        <option value="DUMMY1">DUMMY1</option>
                        <option value="DUMMY2">DUMMY2</option>
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Add Employee',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#212529',
            didOpen: function(modal) {
              // Add event listeners for password visibility toggle
              $('.toggle-password-emp').on('click', function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                  input.attr("type", "text");
                } else {
                  input.attr("type", "password");
                }
              });

              // Real-time password match validation
              $("#emp-confirm-password, #emp-password").on("keyup", function() {
                var password = $("#emp-password").val();
                var confirmPassword = $("#emp-confirm-password").val();
                var matchIcon = $("#emp-matchIcon");
                
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
            },
            preConfirm: () => {
              const email = $('#emp-email').val().trim();
              const username = $('#emp-username').val().trim();
              const name = $('#emp-name').val().trim();
              const middlename = $('#emp-middlename').val().trim();
              const surname = $('#emp-surname').val().trim();
              const dateofbirth = $('#emp-dateofbirth').val().trim();
              const gender = $('#emp-gender').val();
              const position = $('#emp-position').val().trim();
              const department = $('#emp-department').val();
              const password = $('#emp-password').val();
              const confirmPassword = $('#emp-confirm-password').val();

              if (!email || !username || !name || !surname || !dateofbirth || !gender || !department || !password || !confirmPassword) {
                Swal.showValidationMessage('Please fill in all required fields');
                return false;
              }

              if (!email.includes('@')) {
                Swal.showValidationMessage('Please enter a valid email');
                return false;
              }

              if (password !== confirmPassword) {
                Swal.showValidationMessage('Passwords do not match');
                return false;
              }

              if (password.length < 6) {
                Swal.showValidationMessage('Password must be at least 6 characters');
                return false;
              }

              return {
                email: email,
                username: username,
                name: name,
                middlename: middlename,
                surname: surname,
                dateofbirth: dateofbirth,
                gender: gender,
                companyposition: position,
                department: department,
                password: password
              };
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const formData = result.value;

              $.ajax({
                url: '<?= base_url('Main/add_employee') ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                  const res = JSON.parse(response);
                  if (res.success) {
                    Swal.fire('Success!', res.message, 'success').then(() => {
                      location.reload();
                    });
                  } else {
                    Swal.fire('Error!', res.message, 'error');
                  }
                },
                error: function() {
                  Swal.fire('Error!', 'Failed to add employee', 'error');
                }
              });
            }
          });
        }

        // Search functionality
        $('#searchName').on('keyup', function() {
          const searchTerm = $(this).val().toLowerCase();

          if (searchTerm === '') {
            // Show all users if search is empty
            $('#userTableBody').empty();
            allUsers.forEach(row => {
              const clonedRow = row.clone();
              $('#userTableBody').append(clonedRow);
              attachEditRoleListener(clonedRow);
              attachResetPasswordListener(clonedRow);
            });
          } else {
            // Filter users based on search term
            const filteredRows = allUsers.filter(row => {
              const name = $(row).find('td:nth-child(4)').text().toLowerCase();
              return name.includes(searchTerm);
            });

            $('#userTableBody').empty();
            if (filteredRows.length > 0) {
              filteredRows.forEach(row => {
                const clonedRow = row.clone();
                $('#userTableBody').append(clonedRow);
                attachEditRoleListener(clonedRow);
                attachResetPasswordListener(clonedRow);
              });
            } else {
              $('#userTableBody').html('<tr><td colspan="7" class="text-center text-muted">No users found</td></tr>');
            }
          }
        });

        // Attach edit role listener to dynamically added buttons
        function attachEditRoleListener(rowElement) {
          $(rowElement).find('.edit-role-btn').on('click', function() {
            handleEditRole($(this));
          });
        }

        // Attach reset password listener to dynamically added buttons
        function attachResetPasswordListener(rowElement) {
          $(rowElement).find('.reset-password-btn').on('click', function() {
            handleResetPassword($(this));
          });
        }

        // Initial attachment
        $('.edit-role-btn').on('click', function() {
          handleEditRole($(this));
        });

        $('.reset-password-btn').on('click', function() {
          handleResetPassword($(this));
        });

        // Handle edit role modal
        function handleEditRole(button) {
          const userId = button.data('user-id');
          const currentRole = button.data('current-role');

          Swal.fire({
            title: 'Update User Role',
            html: `
              <select id="role-select" class="form-select">
                <option value="viewer" ${currentRole === 'viewer' ? 'selected' : ''}>Viewer</option>
                <option value="note taker" ${currentRole === 'note taker' ? 'selected' : ''}>Note Taker</option>
              </select>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#198754',
            preConfirm: () => {
              return $('#role-select').val();
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const newRole = result.value;

              $.ajax({
                url: '<?= base_url('Main/update_user_role') ?>',
                type: 'POST',
                data: {
                  user_id: userId,
                  role: newRole
                },
                success: function(response) {
                  const res = JSON.parse(response);
                  if (res.success) {
                    Swal.fire('Success!', res.message, 'success');
                    $('.role-badge-' + userId).text(newRole.toUpperCase());
                    $('.edit-role-btn[data-user-id="' + userId + '"]').data('current-role', newRole);
                  } else {
                    Swal.fire('Error!', res.message, 'error');
                  }
                },
                error: function() {
                  Swal.fire('Error!', 'Failed to update role', 'error');
                }
              });
            }
          });
        }

        // Handle reset password
        function handleResetPassword(button) {
          const userId = button.data('user-id');
          const username = button.data('username');

          Swal.fire({
            title: 'Reset Password',
            html: `
              <p class="mb-3">Reset password for user: <strong>${username}</strong></p>
              <input type="password" id="new-password" class="form-control mb-2" placeholder="New password (min 6 characters)">
              <input type="password" id="confirm-password" class="form-control" placeholder="Confirm password">
            `,
            showCancelButton: true,
            confirmButtonText: 'Reset Password',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#dc3545',
            preConfirm: () => {
              const newPassword = $('#new-password').val();
              const confirmPassword = $('#confirm-password').val();

              if (!newPassword || !confirmPassword) {
                Swal.showValidationMessage('Please fill in both fields');
                return false;
              }

              if (newPassword !== confirmPassword) {
                Swal.showValidationMessage('Passwords do not match');
                return false;
              }

              if (newPassword.length < 6) {
                Swal.showValidationMessage('Password must be at least 6 characters');
                return false;
              }

              return newPassword;
            }
          }).then((result) => {
            if (result.isConfirmed) {
              const newPassword = result.value;

              $.ajax({
                url: '<?= base_url('Main/reset_user_password') ?>',
                type: 'POST',
                data: {
                  user_id: userId,
                  new_password: newPassword
                },
                success: function(response) {
                  const res = JSON.parse(response);
                  if (res.success) {
                    Swal.fire('Success!', res.message, 'success');
                  } else {
                    Swal.fire('Error!', res.message, 'error');
                  }
                },
                error: function() {
                  Swal.fire('Error!', 'Failed to reset password', 'error');
                }
              });
            }
          });
        }
      });
    </script>
  </body>
</html>
