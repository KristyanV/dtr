<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->ensure_role_column_exists();
        $this->ensure_noted_columns_exist();
    }

    // Ensure role column exists in users table
    public function ensure_role_column_exists() {
        $field_exists = $this->db->field_exists('role', 'users');
        
        if (!$field_exists) {
            $this->db->query("ALTER TABLE `users` ADD COLUMN `role` ENUM('note taker', 'viewer') DEFAULT 'viewer' AFTER `department`");
        }
    }

    // Ensure is_noted and noted_at columns exist in attendance_reports table
    public function ensure_noted_columns_exist() {
        $is_noted_exists = $this->db->field_exists('is_noted', 'attendance_reports');
        $noted_at_exists = $this->db->field_exists('noted_at', 'attendance_reports');
        $noted_by_name_exists = $this->db->field_exists('noted_by_name', 'attendance_reports');
        $noted_by_role_exists = $this->db->field_exists('noted_by_role', 'attendance_reports');
        
        if (!$is_noted_exists) {
            $this->db->query("ALTER TABLE `attendance_reports` ADD COLUMN `is_noted` TINYINT(1) DEFAULT 0 COMMENT 'Whether the report has been noted'");
        }
        
        if (!$noted_at_exists) {
            $this->db->query("ALTER TABLE `attendance_reports` ADD COLUMN `noted_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'When the report was noted'");
        }
        
        if (!$noted_by_name_exists) {
            $this->db->query("ALTER TABLE `attendance_reports` ADD COLUMN `noted_by_name` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Name of user who noted'");
        }
        
        if (!$noted_by_role_exists) {
            $this->db->query("ALTER TABLE `attendance_reports` ADD COLUMN `noted_by_role` VARCHAR(255) NULL DEFAULT NULL COMMENT 'Role of user who noted'");
        }
    }

    public function insert_attendance($data) {
        return $this->db->insert('attendance_reports', $data);
    }

public function getData()
{
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get('attendance_reports')->result_array(); // includes 'viewed'
}

    public function getTotalReports() {
    return $this->db->count_all('attendance_reports');
}

    public function getDataById($id) {
        $this->db->where('id', $id);
        return $this->db->get('attendance_reports')->row_array();
        
    }
public function update_record($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('attendance_reports', $data);
}


    // Login - check `users` table first, then `admin`
        public function get_user($username, $password) {
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $query = $this->db->get('users');
            $user = $query->row();

            if ($user) {
                $user->is_admin = 0;
                return $user;
            }

            // Fallback to admin table
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $admin = $this->db->get('admin')->row();

            if ($admin) {
                $admin->name = null;
                $admin->middlename = null;
                $admin->surname = null;
                $admin->companyposition = 'Admin';
                $admin->is_admin = 1;
            }

            return $admin;
        }

        // Create a new user
        public function create_user($data) {
            $this->db->insert('users', $data);
            return $this->db->insert_id();
        }

        // Check existing user by username or email
        public function get_user_by_username_or_email($username, $email) {
            $this->db->group_start();
            $this->db->where('username', $username);
            $this->db->or_where('email', $email);
            $this->db->group_end();
            $query = $this->db->get('users');
            return $query->row();
        }
public function mark_as_viewed($report_id)
{
    $report = $this->db->get_where('attendance_reports', ['id' => $report_id])->row();

    if ($report && $report->viewed == 0) {
        $this->db->where('id', $report_id);
        $this->db->set('viewed', 'viewed + 1', FALSE); // increment view count
        $this->db->update('attendance_reports');
    }
}



public function getTotalViewed() {
    return $this->db->where('viewed >', 0)->count_all_results('attendance_reports');
}

// Get all users
public function get_all_users() {
    $this->db->order_by('created_at', 'DESC');
    return $this->db->get('users')->result_array();
}

// Update user role
public function update_user_role($user_id, $role) {
    $this->db->where('id', $user_id);
    $update_result = $this->db->update('users', ['role' => $role]);
    return $update_result;
}

// Mark report as noted
public function mark_as_noted($report_id, $noted_by_name, $noted_by_role) {
    $this->db->where('id', $report_id);
    return $this->db->update('attendance_reports', [
        'is_noted' => 1, 
        'noted_at' => date('Y-m-d H:i:s'),
        'noted_by_name' => $noted_by_name,
        'noted_by_role' => $noted_by_role
    ]);
}

// Reset user password
public function reset_user_password($user_id, $new_password) {
    $this->db->where('id', $user_id);
    return $this->db->update('users', ['password' => $new_password]);
}

}