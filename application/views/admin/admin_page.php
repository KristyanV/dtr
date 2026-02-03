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
      .table th {
        background: #f8f9fa;
      }
      .table thead th {
        color: #000000 !important;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid py-4">
      <div class="page-header mb-4">
        <div>
          <h2 class="mb-1">Admin Dashboard</h2>
          <strong><div class="text-muted">Hello, <?= htmlspecialchars($this->session->userdata('username') ?? 'Admin') ?></div></strong>
        </div>
        <a href="<?= base_url('Main/signout') ?>" class="btn btn-outline-danger">Sign out</a>
      </div>

      <div class="row g-3 mb-4">
        <div class="col-md-6">
          <div class="card p-3">
            <h5 class="mb-2">Attendance Reports</h5>
            <p class="text-muted mb-3">View submitted reports and manage updates.</p>
            <a href="<?= base_url('Main/list') ?>" class="btn btn-primary">Go to Reports</a>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card p-3">
            <h5 class="mb-2">Create a Report</h5>
            <p class="text-muted mb-3">Open the attendance form to submit a report.</p>
            <a href="<?= base_url('Public_page/attendance_form') ?>" class="btn btn-success">Create Report</a>
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

        // Search functionality
        $('#searchName').on('keyup', function() {
          const searchTerm = $(this).val().toLowerCase();

          if (searchTerm === '') {
            // Show all users if search is empty
            $('#userTableBody').empty();
            allUsers.forEach(row => {
              $('#userTableBody').append(row.clone());
              attachEditRoleListener(row.clone());
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
                $('#userTableBody').append(row.clone());
                attachEditRoleListener(row.clone());
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

        // Initial attachment
        $('.edit-role-btn').on('click', function() {
          handleEditRole($(this));
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
      });
    </script>
  </body>
</html>
