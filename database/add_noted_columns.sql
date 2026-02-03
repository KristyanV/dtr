-- Add is_noted and noted_at columns to attendance_reports table
-- Run this SQL in phpMyAdmin or via your MySQL client

ALTER TABLE `attendance_reports` 
ADD COLUMN `is_noted` TINYINT(1) DEFAULT 0 COMMENT 'Whether the report has been noted' AFTER `viewed`,
ADD COLUMN `noted_at` TIMESTAMP NULL DEFAULT NULL COMMENT 'When the report was noted' AFTER `is_noted`;
