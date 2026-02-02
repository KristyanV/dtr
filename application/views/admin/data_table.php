<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance Reports</title>

    <!-- CSS dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css" rel="stylesheet">

    <!-- JS dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      .wrapper {
        display: flex;
        min-height: 100vh;
      }
      .sidebar {
        width: 200px;
        min-width: 200px;
        border-right: 1px solid #dee2e6;
        min-height: 100vh;
        padding: 20px;
        position: relative; /* allow absolute positioning of footer */
      }
      .content {
        flex: 1;
        padding: 20px;
      }

      /* Mobile Responsive: hide sidebar on small screens */
      @media (max-width: 768px) {
          .sidebar {
              display: none;
          }
          .content {
              padding: 12px;
          }
      }
      .dataTables_wrapper .row {
        margin-bottom: 1rem;
      }
      .table-container {
        width: 100%;
      }

      /* Removed hover and click effects */
      table#attendanceTable tbody tr {
        background-color: #ffffff;
        cursor: default; /* Changed from pointer to default */
      }
      .stats-container {
    display: flex;
    justify-content: center;
    margin-bottom: 1.5rem;
    gap: 50px;
}

.stat-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px 25px;
    flex: 1;
    max-width: 200px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid #dee2e6;
}

.stat-label {
    color: #6c757d;
    margin: 0;
    font-size: 14px;
    font-weight: 500;
}

.stat-number {
    color: #082358;
    margin: 5px 0 0 0;
    font-size: 24px;
    font-weight: 700;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .stats-container {
        flex-direction: column;
        gap: 15px;
    }
    
    .stat-box {
        max-width: 100%;
        padding: 12px 20px;
    }
    
    .stat-number {
        font-size: 20px;
    }
}

/* Existing table styles */
.table-container {
    width: 100%;
    margin-top: 20px;
}

table#attendanceTable tbody tr {
    background-color: #ffffff;
    cursor: default;
}
/* Add to your CSS */
.status-header {
    font-size: 0.8em;
    font-weight: normal;
    margin-left: 8px;
}

.new-indicator {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.75em;
    padding: 3px 6px;
}
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    min-width: 80px;  /* Ensures consistent button widths */
}
#attendanceTable_filter input {
    margin-left: auto;
    margin-right: 10px;
}
.sidebar-footer {
        position: absolute;
        bottom: 20px;
        left: 16px; /* align to the left side of the sidebar */
        width: auto;
        text-align: left;
      }
      @media (max-width: 768px) {
          .sidebar-footer { display: none; } /* hide on small screens if sidebar hidden */
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <nav class="sidebar bg-light">
        <div class="user-info mb-4">
          <div class="fw-bold">HELLO,</div>
          <div class="fw-bold"><?= htmlspecialchars($this->session->userdata('full_name') ?? $this->session->userdata('username') ?? 'User') ?></div>
        </div>
        
        <!--
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link active" href="<?= base_url('Main') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('Main/prepare_reports') ?>">Prepare Reports</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('Public_page/attendance_form') ?>">Attendance Form</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('Main/reports') ?>">Reports</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url('Main/users') ?>">Users</a></li>
        </ul> -->
      </nav>
      <div class="content p-3">
        <div class="table-container">
            <!-- Stats Container -->
    <div class="stats-container">
       <div class="stat-box">
    <p class="stat-label">Total Viewed</p>
<p class="stat-number"><?= $total_viewed ?></p>

</div>
        <div class="stat-box">
            <p class="stat-label">Total Reports</p>
            <p class="stat-number"><?= $total_reports ?></p>
        </div>
    </div>

          <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; flex-wrap: wrap; gap: 10px;">
            <div id="attendanceTable_filter" style="flex: 1;"></div>
            <a href="<?= base_url('Public_page/attendance_form') ?>" class="btn btn-success">CREATE A REPORT</a>
          </div>
          <table id="attendanceTable" class="table table-striped table-bordered">
<!-- In your View (data_table.php) -->
<thead class="table-dark text-center align-middle">
  <tr>
    <th class="text-center">Division/Section/Unit</th>
    <th class="text-center">Date</th>
    <th class="text-center">Time</th>
    <th class="text-center">Option</th>
  </tr>
</thead>

<tbody class="text-center align-middle">
  <?php foreach ($attendance_reports as $row): ?>
    <tr> 
      <td><?= htmlspecialchars($row['division']) ?></td>
      <?php
      $report_date = !empty($row['report_date']) ? date('m/d/Y', strtotime($row['report_date'])) : 'N/A';
      $created_at = !empty($row['created_at']) ? date('h:i:s A', strtotime($row['created_at'])) : 'N/A';
      ?>
      <td><?= $report_date ?></td>
<td class="position-relative">
  <?= $created_at ?>
  <?php if (isset($row['viewed']) && $row['viewed'] == 0): ?>
    <span class="badge bg-danger new-indicator">NEW</span>
  <?php endif; ?>
</td>


<td>
    <div style="display: flex; gap: 8px; justify-content: center;">
        <!-- View Button -->
        <a href="<?= base_url('Main/mark_viewed/' . $row['id']) ?>" 
           class="btn btn-primary btn-sm view-button" 
           data-report-id="<?= $row['id'] ?>">
            VIEW
        </a>
        
        <!-- Update Button -->
        <a href="<?= base_url('Public_page/data_update/' . $row['id']) ?>" 
           class="btn btn-warning btn-sm update-button" 
           data-report-id="<?= $row['id'] ?>">
            UPDATE
        </a>
    </div>
</td>
    </tr>
  <?php endforeach; ?>
</tbody>

          </table>
        </div>
      </div>
    </div>
    <div class="sidebar-footer">
          <a href="<?= base_url('Main/signout') ?>" class="btn btn-outline-danger btn-sm">SIGN OUT</a>
        </div>
    <script>
        $(document).ready(function () {
        $('#attendanceTable').DataTable({
          responsive: true,
          pageLength: 10,
          lengthMenu: [5, 10, 25, 50],
          language: {
            lengthMenu: "SHOW _MENU_ ENTRIES PER PAGE",
            search: "SEARCH:"
          },
          columnDefs: [
            { targets: 0, width: "40%" },
            { targets: 1, width: "30%" },
            { targets: 2, width: "30%" }
          ]
        });
      });
</script>
  </body>
</html>
