CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    display_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

INSERT INTO users (email, display_name, username, password, birthdate, role)
VALUES 
('admin@admin.com', 'Admin', 'admin', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-01-01', 'admin'),
('elsa@test.com', 'Elsa Rama', 'elsarama', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-12-16', 'user'),
('haris@test.com', 'Haris Cmega', 'harisc', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-01-01', 'user');
