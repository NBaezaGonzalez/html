CREATE DATABASE estudiante;
use estudiante;

CREATE TABLE alumnos (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	user_id BIGINT(30) NOT NULL,
	user_name VARCHAR(30) NOT NULL,
	password VARCHAR(100) NOT NULL,
	date TIMESTAMP,
);
