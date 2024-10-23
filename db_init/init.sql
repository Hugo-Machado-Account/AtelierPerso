CREATE DATABASE IF NOT EXISTS baseAtelierPerso1;
USE baseAtelierPerso1;

CREATE TABLE IF NOT EXISTS atelierPerso1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text VARCHAR(255) NOT NULL
);

INSERT INTO atelierPerso1 (text) VALUES
('Hello World'),
('Hello World 2'),
('Hello World 3');