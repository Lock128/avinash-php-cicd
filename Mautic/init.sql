CREATE DATABASE IF NOT EXISTS mautic;
CREATE USER 'mautic'@'%' IDENTIFIED BY 'mautic_password';
ALTER USER 'mautic' IDENTIFIED WITH mysql_native_password BY 'mautic_password';
GRANT ALL PRIVILEGES ON mautic.* TO 'mautic'@'%';
FLUSH PRIVILEGES;
