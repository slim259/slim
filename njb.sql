
CREATE DATABASE IF NOT EXISTS student_management;
USE student_management;


CREATE TABLE IF NOT EXISTS user (
                                    id INT AUTO_INCREMENT PRIMARY KEY,
                                    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user'
    );


CREATE TABLE IF NOT EXISTS section (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       designation VARCHAR(100) NOT NULL,
    description TEXT
    );


CREATE TABLE IF NOT EXISTS student (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       name VARCHAR(100) NOT NULL,
    birthday DATE NOT NULL,
    image VARCHAR(255),
    section_id INT,
    FOREIGN KEY (section_id) REFERENCES section(id)
    );