-- Add role column to users table
-- Run this SQL in phpMyAdmin or via your MySQL client

ALTER TABLE `users` 
ADD COLUMN `role` VARCHAR(50) DEFAULT 'note taker' AFTER `department`;
