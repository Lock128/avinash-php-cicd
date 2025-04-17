-- Set root password for MariaDB (Debian default install)
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('password');

CREATE DATABASE IF NOT EXISTS sampledb;

USE sampledb;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100)
);

INSERT INTO users (name, email) VALUES
('Alice', 'alice@example.com'),
('Bob', 'bob@example.com');
