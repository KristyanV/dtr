<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Daily Attendance Report</title>
  
  <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
}

body {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  padding: 10px;
  width: 100%;
  max-width: 1440px;
  margin: 0 auto;
  min-width: 800px;
}

/* ✅ Container wrapper for all sections */
.container-wrapper {
  width: 100%;
  max-width: 850px;
  margin: 0 auto;
  page-break-inside: avoid;
}

/* ✅ Responsive Container */
.attendance-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding: 10px;
  overflow-x: auto;
}

/* ✅ Table Styles */
.attendance-table {
  width: 100%;
  max-width: 100%;
  border-collapse: collapse;
  border: 1px solid #000000;
  margin-top: 10px;
}

/* ✅ Logo Cell - Increased Height */
#logo-cell {
  width: 75px;
  height: 120px;
  border: 2px solid #000000; /* Increased from 1px to 2px */
  padding: 20px;
  text-align: center;
  vertical-align: middle;
}
/* ✅ Logo Image */
#logo {
  width: 67px;
  height: 67px;
}

/* ✅ Header Text - Centered <b> */
.header-text,
.sub-header {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  border: 1px solid #000000;
  padding: 10px;
  font-family: Arial;
  font-size: 12pt;
  height: 70px;
}

.header-text b,
.sub-header b {
  text-align: center;
  font-size: 16px;
}

/* ✅ Background for Sub-header */
.sub-header {
  background-color: #b0c4de;
  font-size: 20px;
}

/* ✅ Responsive Adjustments */
@media (max-width: 768px) {
  #logo {
    width: 50px;
    height: 50px;
  }

  .header-text,
  .sub-header {
    font-size: 10pt;
    height: 60px;
  }
}

/* Print Styles */
@media print {
  * {
    margin: 0;
    padding: 0;
  }
  
  body {
    padding: 0;
    margin: 0;
  }
  
  .container-wrapper {
    page-break-inside: avoid;
  }
  
  .attendance-container {
    page-break-inside: avoid;
  }
  
  .report-container {
    page-break-inside: avoid;
  }
  
  .report-header {
    page-break-inside: avoid;
  }
  
  .report-info {
    page-break-inside: avoid;
  }
  
  .attendance-section,
  .uniform-section {
    page-break-inside: avoid;
  }
  
  .attendance-table,
  .uniform-table {
    page-break-inside: avoid;
  }
  
  .signature-section {
    page-break-inside: avoid;
  }
  
  .footer {
    page-break-inside: avoid;
  }
  
  .back-to-home {
    display: block;
    margin: 30px auto 0 auto;
    text-align: center;
    width: fit-content;
  }
}

/* Report Container */
.report-container {
  width: 100%;
  padding: 10px 0;
  margin: 10px 0;
  page-break-inside: avoid;
}

/* ✅ Report Header fits within body */
.report-header {
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  margin-bottom: 5px;
  gap: 10px;
  flex-wrap: wrap;
  width: 100%;
  max-width: 100%;
  font-size: 16px;
  margin-bottom: 10px;
  page-break-inside: avoid;
}
.report-header p{
  margin-bottom: 0px;
  text-decoration: underline;
}

.report-header .content_head {
  flex: 0;
  white-space: nowrap;
}

.report-header label {
  display: flex;
  align-items: center;
  margin-left: 20px;
}

.report-header #division {
  width: 200px;
  justify-content: center;
  min-width: 260px;
}

.report-info {
  display: flex;
  justify-content: center;
  gap: 30px; /* space between each label-p group */
  flex-wrap: wrap;
  width: 100%;
  font-size: 14px; 
  margin-bottom: 15px;
  page-break-inside: avoid;
}

.info-item {
  display: flex;
  align-items: center;
  gap: 5px; /* tighter space between label and value */
}

.report-info p {
  text-decoration: underline;
  margin: 0;
}


/* Attendance and Uniform Tables */
.attendance-section h2,
.uniform-section h2 {
  font-size: 11pt;
  font-weight: bold;
  margin-bottom: 0;
  margin-top: 10px;
  page-break-inside: avoid;
}

.attendance-section,
.uniform-section {
  page-break-inside: avoid;
  width: 100%;
}

.attendance-table,
.uniform-table {
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
  border-collapse: collapse;
  page-break-inside: avoid;
}

.attendance-table th,
.attendance-table td,
.uniform-table th,
.uniform-table td {
  border: 1px solid #000000;
  padding: 7px;
  font-size: 11pt;
  text-align: left;
  vertical-align: top;
}

.attendance-table th,
.uniform-table th {
  text-align: center;
  font-weight: bold;
}

/* Signature Section */
.signature-section {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-top: 20px; 
  padding: 0 10px;
  page-break-inside: avoid;
}

.submitted-by { 
  flex: 1;
  text-align: left;
}

.noted,
.submitted {
  font-weight: bold;
  margin-bottom: 10px;
}
.submission-note {
  width: 100%;
  font-weight: bold;
  white-space: nowrap; /* Prevent breaking into two lines */
  margin-top: 20px;
}


.signature {
  text-decoration: underline;
  font-size: 12pt;
  margin: 0;
}

.position {
  font-size: 12pt;
  margin-top: 4px;
  font-weight: bold;
}

.footer {
  display: flex;
  justify-content: flex-end; /* push content to the right */
  padding: 0 10px;
  margin-top: 10px;
  width: 100%;
  page-break-inside: avoid;
}

.footer-info {
  text-align: right;
  font-size: 7pt;
  line-height: 1.2;
  background: #ffffff;
  width: 1.25in;
  height: 0.68in;
  padding-right: 2px;
}

.footer-note {
  font-weight: bold;
  margin: 0;
}

.footer-text {
  margin: 0;
}



  </style>

</head>
<body lang="en-US" dir="ltr">
 <form action="<?= base_url('Public_page/view_data/'.($report['id'] ?? ''))?>" method="POST">
  <div class="container-wrapper">
  <div class="attendance-container">
  <table class="attendance-table">
    <tr>
      <td id="logo-cell" rowspan="2">
        <img src="<?= base_url('assets/image/prc_logo.png')?>" id="logo" />
      </td>
      <td class="header-text">
    <b>Professional Regulation Commission</b>
  </td>
    </tr>
    <tr>
      <td class="sub-header">
        <b>DAILY REPORT OF ATTENDANCE</b>
      </td>
    </tr>
  </table>
</div>
<input type="hidden" name="id" value="<?= $report['id'] ?? '' ?>">
 <div class="report-container">
 <div class="report-header">
  <span class="content_head">DIVISION/SECTION/UNIT:</span>
  <p><?= htmlspecialchars($report['division'] ?? 'none') ?></p>


  <label for="date">Date:</label>
  <p><?= htmlspecialchars( $report['report_date'] ?? 'none')?></p>
</div>

<div class="report-info">
  <div class="info-item">
    <label for="employee_section">Number of Employees in Section/Unit:</label>
    <p><?= htmlspecialchars($report['total_employees'] ?? 'none') ?></p>
  </div>
  <div class="info-item">
    <label for="number_absent">Number of Absent:</label>
    <p><?= htmlspecialchars($report['total_absent'] ?? 'none') ?></p>
  </div>
  <div class="info-item">
    <label for="number_present">Number of Present:</label>
    <p><?= htmlspecialchars($report['total_present'] ?? 'none') ?></p>
  </div>
</div>


  <div class="attendance-section">
    <h2>ATTENDANCE:</h2>
    <table class="attendance-table">
      <tr>
        <th>Name of Absentees</th>
        <th>Informed/Not Informed</th>
        <th>Cause of Absence</th>
      </tr>
<!-- Attendance Table -->
<tbody>
  <?php if (!empty($report['absentees'])): ?>
    <?php $absentees = json_decode($report['absentees'], true); ?>
    <?php foreach ($absentees as $absentee): ?>
      <tr>
        <td><?= htmlspecialchars($absentee['name'] ?? 'N/A' ) ?></td>
        <td><?= htmlspecialchars($absentee['informed'] ?? 'N/A' ) ?></td>
        <td><?= htmlspecialchars($absentee['cause'] ?? 'N/A' ) ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</tbody>

    </table>
  </div>

  <div class="uniform-section">
    <h2>NOT IN PRESCRIBED UNIFORM:</h2>
    <table class="uniform-table">
      <tr>
        <th>Name of Employee</th>
        <th>Remarks</th>
      </tr>
<!-- Uniform Table -->
<tbody>
  <?php if (!empty($report['not_in_uniform'])): ?>
    <?php $uniforms = json_decode($report['not_in_uniform'], true); ?>
    <?php foreach ($uniforms as $uniform): ?> 
      <tr>
        <td><?= htmlspecialchars($uniform['name'] ?? 'N/A' ) ?></td>
        <td><?= htmlspecialchars($uniform['remarks'] ?? 'N/A' ) ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</tbody>

    </table>
  </div>

  <div class="signature-section">
  <div class="submitted-by">
    <p class="noted">NOTED:</p>
    <?php if (!empty($report['noted_by_name'])): ?>
      <p class="signature"><?= htmlspecialchars($report['noted_by_name']) ?></p>
      <p class="position"><?= htmlspecialchars($report['noted_by_role'] ?? 'Authorized Signatory') ?></p>
    <?php else: ?>
      <p class="signature">_______________________</p>
      <p class="position">Authorized Signatory</p>
    <?php endif; ?>
   <div class="submission-note">
  To be submitted to the HRD Division on or before 3:00 P.M.
</div>

  </div>

  <div class="submitted-by">
    <p class="submitted">Respectfully submitted:</p>
    <?php $submitter_name = htmlspecialchars($report['submitted_by_name'] ?? 'Section/Unit Supervisor'); ?>
    <?php $submitter_role = htmlspecialchars($report['submitted_by_role'] ?? 'Section/Unit Supervisor'); ?>
    <p class="signature"><?= $submitter_name ?></p>
    <p class="position"><?= $submitter_role ?></p>
  </div> 
</div>

<div class="footer">
  <div class="footer-info">
    <p class="footer-note">HRDD-AM-01</p>
    <p class="footer-note">Rev. 00</p>
    <p class="footer-text">June 14, 2021</p>
    <p class="footer-text">Page 1 of 1</p>
  </div>
</div>

  <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px;">
    <a href="<?= base_url('Main/list') ?>" class="btn btn-secondary">BACK TO HOME</a>
    <?php if (isset($user_role) && $user_role === 'note taker'): ?>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#notedConfirmModal">
        NOTED
      </button>
    <?php endif; ?>
  </div>

  </div>
 </form>

  <!-- Noted Confirmation Modal -->
  <div class="modal fade" id="notedConfirmModal" tabindex="-1" aria-labelledby="notedConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="notedConfirmModalLabel">
            <i class="bi bi-check-circle-fill me-2"></i>Confirm Noted Action
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center py-4">
          <div class="mb-3">
            <i class="bi bi-question-circle text-success" style="font-size: 3rem;"></i>
          </div>
          <h6 class="mb-3">Are you sure you want to mark this report as noted?</h6>
          <p class="text-muted small mb-0">This action will record your name and timestamp.</p>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i>Cancel
          </button>
          <a href="<?= base_url('Public_page/mark_as_noted/' . ($report['id'] ?? '')) ?>" class="btn btn-success">
            <i class="bi bi-check-circle me-1"></i>Yes, Mark as Noted
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success text-center" style="margin-top: 20px;">
    <?= $this->session->flashdata('success') ?>
  </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
  <div class="alert alert-danger text-center" style="margin-top: 20px;">
    <?= $this->session->flashdata('error') ?>
  </div>
  <?php endif; ?>
  
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>