<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_page extends CI_Controller {

	 public function __construct() {
        parent::__construct();
        $this->load->library('session'); 
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->model('Attendance_model');
    }
//Attendance Report Form
    public function index() {
        $this->load->view('attendance_form');
    }

    // Provide an explicit route for the attendance form dropdown/link
    public function attendance_form() {
        $this->load->view('attendance_form');
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->load->view('attendance_form');
            return;
        }

        // ✅ Validate required fields
        $this->form_validation->set_rules('division', 'Division', 'required');
        $this->form_validation->set_rules('report_date', 'Report Date', 'required');
        $this->form_validation->set_rules('total_employees', 'Total Employees', 'required|numeric');
        $this->form_validation->set_rules('total_absent', 'Total Absent', 'required|numeric');
        $this->form_validation->set_rules('total_present', 'Total Present', 'required|numeric');

        if (!$this->form_validation->run()) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('attendance_form');
            return;
        }

        // ✅ Get POST data
        $division = $this->input->post('division');
        $date = $this->input->post('report_date');
        $total_employees = $this->input->post('total_employees');
        $total_absent = $this->input->post('total_absent');
        $total_present = $this->input->post('total_present');

// Process Absentees
$absentees = [];
if (!empty($_POST['absentees']['name'])) {
    foreach ($_POST['absentees']['name'] as $index => $name) {
        $entry = [
            'name' => trim($_POST['absentees']['name'][$index]),
            'informed' => trim($_POST['absentees']['informed'][$index] ?? ''),
            'cause' => trim($_POST['absentees']['cause'][$index] ?? '')
        ];

        // Replace empty values with N/A
        foreach ($entry as $key => $value) {
            if (empty($value)) {
                $entry[$key] = 'N/A';
            }
        }

        $absentees[] = $entry;
    }
}

// Process Uniform Data
$not_in_uniform = [];
if (!empty($_POST['not_in_uniform']['name'])) {
    foreach ($_POST['not_in_uniform']['name'] as $index => $name) {
        $entry = [
            'name' => trim($_POST['not_in_uniform']['name'][$index]),
            'remarks' => trim($_POST['not_in_uniform']['remarks'][$index] ?? '')
        ];

        foreach ($entry as $key => $value) {
            if (empty($value)) {
                $entry[$key] = 'N/A';
            }
        }

        $not_in_uniform[] = $entry;
    }
}

    // Prepare data
    $user_id = $this->session->userdata('id') ?? null;
    $user_name = $this->session->userdata('name') ?? null;
    $user_middlename = $this->session->userdata('middlename') ?? null;
    $user_surname = $this->session->userdata('surname') ?? null;
    $user_role = $this->session->userdata('companyposition') ?? null;

    // Convert middle name to initial only
    $middle_initial = !empty($user_middlename) ? strtoupper(substr($user_middlename, 0, 1)) . '.' : '';
    $full_name = strtoupper(trim("$user_name $middle_initial $user_surname"));

    $data = [
        'division' => $this->input->post('division'),
        'report_date' => $this->input->post('report_date'),
        'total_employees' => $this->input->post('total_employees'),
        'total_absent' => $this->input->post('total_absent'),
        'total_present' => $this->input->post('total_present'),
        'absentees' => json_encode($absentees, JSON_THROW_ON_ERROR),
        'not_in_uniform' => json_encode($not_in_uniform, JSON_THROW_ON_ERROR),
        'submitted_by' => $user_id,
        'submitted_by_name' => $full_name,
        'submitted_by_role' => $user_role
    ];


        // ✅ Insert into DB and handle errors
    try {
    $status = $this->Attendance_model->insert_attendance($data);
    if ($status) {
        // Get the inserted ID
        $insert_id = $this->db->insert_id();
        
        $this->session->set_flashdata('success', 'Attendance submitted successfully!');
        // Redirect with the actual inserted ID
        redirect('Public_page/view_report2/' . $insert_id);
    } else {
        $this->session->set_flashdata('error', 'Failed to submit attendance.');
        redirect('attendance_form'); // Redirect back to form instead
    }
} catch (Exception $e) {
    $this->session->set_flashdata('error', 'An error occurred: ' . $e->getMessage());
    redirect('attendance_form'); // Redirect back to form on error
}

    }



//View Attendance Report
    public function view_report($id) {
        $data['report'] = $this->Attendance_model->getDataById($id);
        $this->load->view('admin/View_attendance', $data);
    }

    public function view_data() {
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            // Get POST data
            $division = $this->input->post('division');
            $date = $this->input->post('report_date');
            $total_employees = $this->input->post('total_employees');
            $total_absent = $this->input->post('total_absent');
            $total_present = $this->input->post('total_present');

  $absentees = [];
        if (!empty($_POST['absentees']['name'])) {
            foreach ($_POST['absentees']['name'] as $index => $name) {
                $entry = [
                    'name' => $_POST['absentees']['name'][$index] ?? 'N/A',
                    'informed' => $_POST['absentees']['informed'][$index] ?? 'N/A',
                    'cause' => $_POST['absentees']['cause'][$index] ?? 'N/A'
                ];
                $absentees[] = $entry;
            }
        }

        // Process uniform data
        $not_in_uniform = [];
        if (!empty($_POST['not_in_uniform']['name'])) {
            foreach ($_POST['not_in_uniform']['name'] as $index => $name) {
                $entry = [
                    'name' => $_POST['not_in_uniform']['name'][$index] ?? 'N/A',
                    'remarks' => $_POST['not_in_uniform']['remarks'][$index] ?? 'N/A'
                ];
                $not_in_uniform[] = $entry;
            }
        }


            // Prepare data for DB insertion
            $data = [
                'division' => $division,
                'report_date' => $date,
                'total_employees' => $total_employees,
                'total_absent' => $total_absent,
                'total_present' => $total_present,
                'absentees' => json_encode($absentees, JSON_THROW_ON_ERROR),
                'not_in_uniform' => json_encode($not_in_uniform, JSON_THROW_ON_ERROR)
            ];

        } 
    }// Controller: View_attendance.php
public function view_report2($id) {
    $data['attendance_reports'] = $this->Attendance_model->getDataById($id);
$this->load->view('admin/View_attendance2', $data);

}


    public function view_data2($id){
       if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $division = $this->input->post('division');
            $date = $this->input->post('report_date');
            $total_employees = $this->input->post('total_employees');
            $total_absent = $this->input->post('total_absent');
            $total_present = $this->input->post('total_present');
            
            $absentees = [];
        if (!empty($_POST['absentees']['name'])) {
            foreach ($_POST['absentees']['name'] as $index => $name) {
                $entry = [
                    'name' => $_POST['absentees']['name'][$index] ?? 'N/A',
                    'informed' => $_POST['absentees']['informed'][$index] ?? 'N/A',
                    'cause' => $_POST['absentees']['cause'][$index] ?? 'N/A'
                ];
                $absentees[] = $entry;
            }
        }

        // Process uniform data
        $not_in_uniform = [];
        if (!empty($_POST['not_in_uniform']['name'])) {
            foreach ($_POST['not_in_uniform']['name'] as $index => $name) {
                $entry = [
                    'name' => $_POST['not_in_uniform']['name'][$index] ?? 'N/A',
                    'remarks' => $_POST['not_in_uniform']['remarks'][$index] ?? 'N/A'
                ];
                $not_in_uniform[] = $entry;
            }
        }

         
            $data = [
                'division' => $division,
                'report_date' => $date,
                'total_employees' => $total_employees,
                'total_absent' => $total_absent,
                'total_present' => $total_present,
                'absentees' => json_encode($absentees, JSON_THROW_ON_ERROR),
                'not_in_uniform' => json_encode($not_in_uniform, JSON_THROW_ON_ERROR)
            ];

    } 
}   

//Update Attendance Report
    public function data_update($id) {
        // Load existing data
        $data['attendance_reports'] = $this->Attendance_model->getDataById($id);
        $this->load->view('update_form', $data);
    }

    public function update_data($id) {
        // Validate input first
        $this->form_validation->set_rules('division', 'Division', 'required');
        $this->form_validation->set_rules('report_date', 'Date', 'required');
        $this->form_validation->set_rules('total_employees', 'Total Employees', 'required|numeric');
        $this->form_validation->set_rules('total_absent', 'Total Absent', 'required|numeric');
        $this->form_validation->set_rules('total_present', 'Total Present', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('Public_page/data_update/' . $id);
        }
        // Process Absentees
$absentees = [];
if (!empty($_POST['absentees']['name'])) {
    foreach ($_POST['absentees']['name'] as $index => $name) {
        $entry = [
            'name' => trim($_POST['absentees']['name'][$index]),
            'informed' => trim($_POST['absentees']['informed'][$index] ?? ''),
            'cause' => trim($_POST['absentees']['cause'][$index] ?? '')
        ];

        // Replace empty values with N/A
        foreach ($entry as $key => $value) {
            if (empty($value)) {
                $entry[$key] = 'N/A';
            }
        }

        $absentees[] = $entry;
    }
}

// Process Uniform Data
$not_in_uniform = [];
if (!empty($_POST['not_in_uniform']['name'])) {
    foreach ($_POST['not_in_uniform']['name'] as $index => $name) {
        $entry = [
            'name' => trim($_POST['not_in_uniform']['name'][$index]),
            'remarks' => trim($_POST['not_in_uniform']['remarks'][$index] ?? '')
        ];

        foreach ($entry as $key => $value) {
            if (empty($value)) {
                $entry[$key] = 'N/A';
            }
        }

        $not_in_uniform[] = $entry;
    }
}

        // Process data
    $data = [
    'division' => $this->input->post('division'),
    'report_date' => $this->input->post('report_date'),
    'total_employees' => $this->input->post('total_employees'),
    'total_absent' => $this->input->post('total_absent'),
    'total_present' => $this->input->post('total_present'),
    'absentees' => json_encode($absentees),
    'not_in_uniform' => json_encode($not_in_uniform)
];

        try {
            $status = $this->Attendance_model->update_record($id, $data);
            
            if ($status) {
                $this->session->set_flashdata('success', 'Record updated successfully!');
                redirect('Public_page/view_report2/' . $id);
            } else {
                $this->session->set_flashdata('error', 'No changes made to the record');
                redirect('Public_page/data_update/' . $id);
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Error: ' . $e->getMessage());
            redirect('Public_page/data_update/' . $id);
        }
    }



























}
