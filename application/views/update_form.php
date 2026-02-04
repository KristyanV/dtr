<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: sans-serif;
  font-family: Arial, sans-serif;

}

body {
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
  background-color: #f4f4f4;
  width: 100%;
  max-width: 1200px; /* Control overall width */
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
  max-width: 900px; /* Adjusts for larger screens */
  border-collapse: collapse;
  border: 1px solid #000000;
  margin-top: 10px;
}

/* ✅ Logo Cell - Increased Height */
#logo-cell {
  width: 75px;
  height: 120px; /* Extended height */
  border: 1px solid #000000;
  padding: 20px; /* More padding for spacing */
  text-align: center;
  vertical-align: middle; /* Centers the logo */
}

/* ✅ Logo Image */
#logo {
  width: 67px;
  height: 67px;
}

/* ✅ Header Text - Increased Height */
.header-text, .sub-header {
  width: 100%;
  border: 1px solid #000000;
  padding: 10px; /* More padding for height */
  text-align: center;
  font-family: Arial;
  font-size: 12pt;
  word-wrap: break-word;
  height: 50px; /* Extended height */

}

/* ✅ Background for Sub-header */
.sub-header {
  background-color: #b0c4de; /* Darker shade for visibility */
  font-size: 11pt;
}

/* ✅ Responsive Adjustments */
@media (max-width: 768px) {
  .attendance-table {
    min-width: 100%;
  }

  #logo {
    width: 50px; /* Smaller logo for small screens */
    height: 50px;
  }

  .header-text, .sub-header {
    font-size: 10pt;
    height: 60px; /* Slightly smaller height on small screens */
  }
}


/* Report Container */
.report-container {
  width: 100%;
  padding: 20px 0px;
  margin: 20px 0;

}

.report-header {
  display: flex;
  align-items: center;
  justify-content: center; /* Centers content */
  text-align: center; /* Ensures text alignment */
  margin-bottom: 15px;
  gap: 10px; /* Reduce gap to close spacing */
  width: 100%;
  font-size: 20px;
  margin-bottom: 20px;
}

.report-header .content_head {
  flex: 0; /* Prevents it from taking extra space */
  white-space: nowrap; /* Prevents text wrapping */
}


.report-header label {
  display: flex;
  align-items: center;
  margin-left: 20px;
}
.report-header #division{
  width: 250px;
  justify-content: center;
  min-width: 285px;
}

.report-header input {
  width: 150px;
  height: 32px;
}

.report-info {
  display: flex;
  justify-content: center;
  gap: 20px;
  flex-wrap: wrap;
  width: 100%;
  font-size: 20px;
}

.report-info input {
  width: 60px;
}


/* Tables Container */
.container {
  width: 100%;
  margin: 20px 0;
}

.table1{
  width: 100%;
  margin: 20px 0;
  padding: 15px;
  background: white;
  min-width: 800px;
  border-radius: 9px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.table2{
  width: 100%;
  margin: 20px 0;
  padding: 15px;
  background: white;
  min-width: 700px;
  border-radius: 9px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}


table {
  width: 100%;
  border-collapse: collapse;
  margin: 10px 0;
}

th, td {
  padding: 10px;
  border:2px solid #ddd;
}


th {
  background-color: #4A72B2; /* Darker blue */
  color: white; /* Ensures text is visible */
  font-weight: bold;
  padding: 10px; /* Adds spacing for better readability */
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

/* Responsive Adjustments */
@media (max-width: 700px) {
  .report-header {
    flex-direction: column;
    align-items: stretch;
  }
  
  .report-header input {
    width: 100%;
    
  }
  
  .report-info {
    flex-direction: column;
    align-items: center;
  }
}

</style>
    <title>DAILY REPORT ATTENDANCE</title>
  </head>
  <body>
   
  <form id="report_attendance" method="POST" action="<?= base_url('Public_page/update_data/' . $attendance_reports['id']) ?>">
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
    <select id="division" name="division">
      <option value="">-- Select Division --</option>
      <option value="FAD" <?= ($attendance_reports['division'] ?? '') === 'FAD' ? 'selected' : '' ?>>FAD</option>
      <option value="DUMMY1" <?= ($attendance_reports['division'] ?? '') === 'DUMMY1' ? 'selected' : '' ?>>DUMMY1</option>
      <option value="DUMMY2" <?= ($attendance_reports['division'] ?? '') === 'DUMMY2' ? 'selected' : '' ?>>DUMMY2</option>
    </select>
        <label for="report_date">Date:</label>
    <input type="date" id="report_date" name="report_date" value="<?= htmlspecialchars($attendance_reports['report_date'] ?? '') ?>">
</div>

    <div class="report-info">
      <label for="total_employees">Number of Employees in Section/Unit:</label>
      <input type="number" id="total_employees" name="total_employees" value="<?= htmlspecialchars($attendance_reports['total_employees'] ?? 'none') ?>">


      <label for="total_absent">Number of Absent:</label>
      <input type="number" id="total_absent" name="total_absent" value="<?= htmlspecialchars($attendance_reports['total_absent'] ?? 'none') ?>">

      <label for="total_present">Number of Present:</label>
      <input type="number" id="total_present" name="total_present" value="<?= htmlspecialchars($attendance_reports['total_present'] ?? 'none') ?>">
    </div>
  </div>

  <div class="container">
    <!-- Table for Absentees -->
    <div class="table1">
      <h4>ATTENDANCE:</h4>
      <table id="attendanceTable">
        <thead>
          <tr>
            <th>Name of Absentees</th>
            <th>Informed/Not Informed</th>
            <th>Cause of Absence</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <select name="absentees[name][]" class="employee-name">
                <option value="">-- Select Employee --</option>
              </select>
            </td>
            <td>
              <select name="absentees[informed][]" required>
                <option value="">-- Select --</option>
                <option value="Informed">Informed</option>
                <option value="Not Informed">Not Informed</option>
              </select>
            </td>
            <td><input type="text" name="absentees[cause][]" placeholder="Cause"></td>
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger">DELETE</button></td>
          </tr>
        </tbody>
      </table>
      <button type="button"  onclick="addAbsenteeRow()" class="btn btn-success">ADD ROW</button>
    </div>

    <!-- Table for Not in Prescribed Uniform -->
    <div class="table2">
      <h4>NOT IN PRESCRIBED UNIFORM:</h4>
      <table id="uniformTable">
        <thead>
          <tr>
            <th>Name of Employee</th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <select name="not_in_uniform[name][]" class="employee-name">
                <option value="">-- Select Employee --</option>
              </select>
            </td>
            <td><input type="text" name="not_in_uniform[remarks][]" placeholder="Remarks"></td>
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger">DELETE</button></td>
          </tr>
        </tbody>
      </table>
      <button type="button"  onclick="addUniformRow()" class="btn btn-success">ADD ROW</button>
    </div>
  </div>

  <div class="signature-section">
    <div class="submitted-by">
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

  <!-- Optional: Form Submit Button -->
  <div style="text-align: center; margin-top: 30px; display: flex; gap: 15px; justify-content: center;">
    <a href="<?= base_url('Main/list') ?>" class="btn btn-secondary">BACK TO HOME</a>
    <button type="submit" class="btn btn-primary">UPDATE ATTENDANCE REPORT</button>
  </div>

</form>


<script>
    // ✅ Flash message alert
    <?php if ($this->session->flashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $this->session->flashdata('error'); ?>',
    });
    <?php elseif ($this->session->flashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?= $this->session->flashdata('success'); ?>',
        showConfirmButton: false,
        timer: 2000
    });
    <?php endif; ?>
function addAbsenteeRow() {
    const table = document.querySelector('#attendanceTable tbody');
    const newRow = `
        <tr>
            <td>
              <select name="absentees[name][]" class="employee-name" ${employeeSelectDisabled ? 'disabled' : ''}>
                ${employeeOptionsHtml}
              </select>
            </td>
            <td>
              <select name="absentees[informed][]" required>
                <option value="">-- Select --</option>
                <option value="Informed">Informed</option>
                <option value="Not Informed">Not Informed</option>
              </select>
            </td>
            <td><input type="text" name="absentees[cause][]" placeholder="Cause"></td>
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger">DELETE</button></td>
        </tr>
    `;
    table.insertAdjacentHTML('beforeend', newRow);
}

function addUniformRow() {
    const table = document.querySelector('#uniformTable tbody');
    const newRow = `
        <tr>
            <td>
              <select name="not_in_uniform[name][]" class="employee-name" ${employeeSelectDisabled ? 'disabled' : ''}>
                ${employeeOptionsHtml}
              </select>
            </td>
            <td><input type="text" name="not_in_uniform[remarks][]" placeholder="Remarks"></td>
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger">DELETE</button></td>
        </tr>
    `;
    table.insertAdjacentHTML('beforeend', newRow);
}

function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
}

let employeeOptionsHtml = '<option value="">-- Select Employee --</option>';
let employeeSelectDisabled = true;

function updateEmployeeOptions(optionsHtml, isDisabled) {
  const selects = document.querySelectorAll('.employee-name');
  selects.forEach((select) => {
    const currentValue = select.value;
    select.innerHTML = optionsHtml;
    select.disabled = isDisabled;
    // Try to restore previous value if it exists in new options
    if (currentValue && select.querySelector(`option[value="${currentValue}"]`)) {
      select.value = currentValue;
    }
  });
}

function fetchEmployeesByDivision(division) {
  if (!division) {
    employeeOptionsHtml = '<option value="">-- Select Employee --</option>';
    employeeSelectDisabled = true;
    updateEmployeeOptions(employeeOptionsHtml, employeeSelectDisabled);
    return;
  }

  $.getJSON('<?= base_url('Public_page/get_employees_by_division'); ?>', { division: division })
    .done(function (data) {
      const options = ['<option value="">-- Select Employee --</option>'];
      if (Array.isArray(data)) {
        data.forEach(function (employee) {
          if (employee && employee.name) {
            const safeName = String(employee.name).replace(/"/g, '&quot;');
            options.push(`<option value="${safeName}">${safeName}</option>`);
          }
        });
      }

      employeeOptionsHtml = options.join('');
      employeeSelectDisabled = false;
      updateEmployeeOptions(employeeOptionsHtml, employeeSelectDisabled);
    })
    .fail(function () {
      employeeOptionsHtml = '<option value="">-- Select Employee --</option>';
      employeeSelectDisabled = true;
      updateEmployeeOptions(employeeOptionsHtml, employeeSelectDisabled);
    });
}


    // ✅ Submit handler with validation
    $(document).ready(function () {
        // Fetch employees on page load if division is already selected
        const initialDivision = $('#division').val();
        if (initialDivision) {
            fetchEmployeesByDivision(initialDivision);
        }

        // Listen for division change
        $('#division').on('change', function() {
            const division = $(this).val();
            fetchEmployeesByDivision(division);
        });

        // 𝗣𝗥𝗘-𝗙𝗜𝗟𝗟 𝗗𝗔𝗧𝗔 𝗛𝗘𝗥𝗘 (ADD THIS SECTION)
        <?php if (!empty($attendance_reports['absentees'])): ?>
            <?php $absentees = json_decode($attendance_reports['absentees'], true); ?>
            <?php foreach ($absentees as $index => $absentee): ?>
                <?php if ($index > 0): ?>
                    addAbsenteeRow();
                <?php endif; ?>
            <?php endforeach; ?>
            // Wait for employees to load before setting values
            setTimeout(function() {
                <?php foreach ($absentees as $index => $absentee): ?>
                    document.querySelectorAll('[name="absentees[name][]"]')[<?= $index ?>].value = '<?= addslashes($absentee['name']) ?>';
                    document.querySelectorAll('[name="absentees[informed][]"]')[<?= $index ?>].value = '<?= addslashes($absentee['informed']) ?>';
                    document.querySelectorAll('[name="absentees[cause][]"]')[<?= $index ?>].value = '<?= addslashes($absentee['cause']) ?>';
                <?php endforeach; ?>
            }, 500);
        <?php endif; ?>

        <?php if (!empty($attendance_reports['not_in_uniform'])): ?>
            <?php $uniforms = json_decode($attendance_reports['not_in_uniform'], true); ?>
            <?php foreach ($uniforms as $index => $uniform): ?>
                <?php if ($index > 0): ?>
                    addUniformRow();
                <?php endif; ?>
            <?php endforeach; ?>
            // Wait for employees to load before setting values
            setTimeout(function() {
                <?php foreach ($uniforms as $index => $uniform): ?>
                    document.querySelectorAll('[name="not_in_uniform[name][]"]')[<?= $index ?>].value = '<?= addslashes($uniform['name']) ?>';
                    document.querySelectorAll('[name="not_in_uniform[remarks][]"]')[<?= $index ?>].value = '<?= addslashes($uniform['remarks']) ?>';
                <?php endforeach; ?>
            }, 500);
        <?php endif; ?>

        // Existing submit handler
        $('#report_attendance').submit(function (e) {
            /* ... existing validation code ... */
        });
    });
</script>

  


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>