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
      }
      .content {
        width: 100%;
        padding: 20px;
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
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="content">
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
    <script>
        $(document).ready(function () {
        $('#attendanceTable').DataTable({
          responsive: true,
          pageLength: 10,
          lengthMenu: [5, 10, 25, 50],
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
