create database finflow; 

use finflow; 

create table users(
	id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    email varchar(100) unique, 
    password varchar(255)
);

create table categories(
	id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    name varchar(100),
    FOREIGN KEY (user_id) REFERENCES users(id) on DELETE CASCADE
);

create table transactions(
	id int AUTO_INCREMENT PRIMARY KEY,
    user_id int,
    category_id int,
    type ENUM('income', 'expense'),
    amount decimal(10,2),
    description text,
    date DATE,
    FOREIGN KEY (user_id) REFERENCES users(id) on DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) on DELETE set null
);