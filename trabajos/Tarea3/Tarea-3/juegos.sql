CREATE DATABASE vendedores;
use vendedores;

CREATE TABLE vendedor (
	id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(30) NOT NULL,
	cant_cod INT(3),
	cant_mine INT(3),
	cant_for INT(3),
	v_total INT(3),
	c_cod INT(3),
	c_mine INT(3),
	c_for INT(3),
	c_total INT(3),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


