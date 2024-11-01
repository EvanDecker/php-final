CREATE DATABASE IF NOT EXISTS modules;
use mysql;
GRANT ALL ON *.* TO 'modules'@'%';
use modules;
CREATE TABLE IF NOT EXISTS books (id INT PRIMARY KEY AUTO_INCREMENT, title VARCHAR(255), author VARCHAR(255), pages INT);
