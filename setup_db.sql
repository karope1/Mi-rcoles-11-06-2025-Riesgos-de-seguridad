CREATE DATABASE test_db;
USE test_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

INSERT INTO users (username, password) VALUES 
('admin', 'password123'),
('usuario1', 'claveSegura'),
('test', 'test123');