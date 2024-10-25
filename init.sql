CREATE DATABASE IF NOT EXISTS modules;
use mysql;
DROP USER 'modules'@'%';
CREATE USER 'modules'@'172.23.0.3' IDENTIFIED BY 'secret';
GRANT ALL ON *.* TO 'modules'@'172.23.0.3';
use modules;
CREATE TABLE IF NOT EXISTS books (id INT PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255), author VARCHAR(255), pages INT);
