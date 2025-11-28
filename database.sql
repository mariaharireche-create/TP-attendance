CREATE DATABASE IF NOT EXISTS attendance_db;
USE attendance_db;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fullname VARCHAR(100) NOT NULL,
  matricule VARCHAR(50) NOT NULL,
  group_id VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS attendance_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id VARCHAR(50) NOT NULL,
  group_id VARCHAR(50) NOT NULL,
  date DATETIME NOT NULL,
  opened_by VARCHAR(50) NOT NULL,
  status ENUM('open','closed') DEFAULT 'open'
);
