CREATE DATABASE IF NOT EXISTS mautic;

-- Attempt to drop the user if it already exists
DROP USER IF EXISTS 'mautic'@'%';

-- Recreate the user
CREATE USER 'mautic'@'%' IDENTIFIED BY 'mautic_password';

-- Set the password using native password authentication
ALTER USER 'mautic'@'%' IDENTIFIED WITH mysql_native_password BY 'mautic_password';

-- Grant privileges
GRANT ALL PRIVILEGES ON mautic.* TO 'mautic'@'%';

FLUSH PRIVILEGES;
