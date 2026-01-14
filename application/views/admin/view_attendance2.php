<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
  padding: 20px;
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

/* Report Container */
.report-container {
  width: 100%;
  padding: 20px 0;
  margin: 20px 0;
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
  font-size: 20px;
  margin-bottom: 10px;
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
  font-size: 20px; 
  margin-bottom: 30px; 
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
  font-size: 12pt;
  font-weight: bold;
  margin-bottom: 0;
}

.attendance-table,
.uniform-table {
  width: 100%;
  max-width: 100%;
  margin: 0 auto;
  border-collapse: collapse;
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
  margin-top: 40px; 
  padding: 0 20px;
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
  padding: 0 20px;
  margin-top: 20px;
  width: 100%;
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
 <div class="report-container">
 <div class="report-header">
  <span class="content_head">DIVISION/SECTION/UNIT:</span>
  <p><?= htmlspecialchars($attendance_reports['division'] ?? 'none') ?></p>

  <label for="date">Date:</label>
  <p><?= htmlspecialchars($attendance_reports['report_date'] ?? 'none') ?></p>
</div>

<div class="report-info">
  <div class="info-item">
    <label for="employee_section">Number of Employees in Section/Unit:</label>
    <p><?= htmlspecialchars($attendance_reports['total_employees'] ?? 'none') ?></p>
  </div>
  <div class="info-item">
    <label for="number_absent">Number of Absent:</label>
    <p><?= htmlspecialchars($attendance_reports['total_absent'] ?? 'none') ?></p>
  </div>
  <div class="info-item">
    <label for="number_present">Number of Present:</label>
    <p><?= htmlspecialchars($attendance_reports['total_present'] ?? 'none') ?></p>
  </div>
</div>


 <div class="attendance-section">
    <h2>ATTENDANCE:</h2>
    <table class="attendance-table">
      <thead>
        <tr>
          <th>Name of Absentees</th>
          <th>Informed/Not Informed</th>
          <th>Cause of Absence</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($attendance_reports['absentees'])): ?>
          <?php 
          $absentees = json_decode($attendance_reports['absentees'], true);
          if (json_last_error() === JSON_ERROR_NONE && is_array($absentees)): ?>
            <?php foreach ($absentees as $absentee): ?>
              <tr>
                <td><?= htmlspecialchars($absentee['name'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($absentee['informed'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($absentee['cause'] ?? 'N/A') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endif; ?>
      </tbody>
    </table>
</div>

<div class="uniform-section">
    <h2>NOT IN PRESCRIBED UNIFORM:</h2>
    <table class="uniform-table">
      <thead>
        <tr>
          <th>Name of Employee</th>
          <th>Remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($attendance_reports['not_in_uniform'])): ?>
          <?php 
          $uniforms = json_decode($attendance_reports['not_in_uniform'], true);
          if (json_last_error() === JSON_ERROR_NONE && is_array($uniforms)): ?>
            <?php foreach ($uniforms as $uniform): ?>
              <tr>
                <td><?= htmlspecialchars($uniform['name'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($uniform['remarks'] ?? 'N/A') ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        <?php endif; ?>
      </tbody>
    </table>
</div>

  <div class="signature-section">
  <div class="submitted-by">
    <p class="noted">NOTED:</p>
    <p class="signature">ARJEN C. DE LOS SANTOS</p>
    <p class="position">Division OIC</p> 
   <div class="submission-note">
  To be submitted to the HRD Division on or before 3:00 P.M.
</div>

  </div>

  <div class="submitted-by">
    <p class="submitted">Respectfully submitted:</p>
    <br>
    <p class="position">Section/Unit Supervisor</p>
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

  </div>
<div style="text-align: center; margin-top: 30px;">
  <p>Do you want to Edit?</p>
  <a href="<?= base_url('Public_page/data_update/' . $attendance_reports['id']) ?>" class="btn btn-primary">
    Update Attendance Report
  </a>
</div>

</body>
</html>