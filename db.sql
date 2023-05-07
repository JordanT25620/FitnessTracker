CREATE DATABASE IF NOT EXISTS gymbro;
USE gymbro;
CREATE TABLE IF NOT EXISTS users (
    id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(20) NOT NULL,
    pass varchar(100) NOT NULL
);