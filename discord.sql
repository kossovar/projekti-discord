CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    display_name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE servers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
--kur nje user fshihet dhe ka server, serveri fshihet poashtu
    ALTER TABLE servers DROP FOREIGN KEY servers_ibfk_1;
    ALTER TABLE servers ADD CONSTRAINT servers_ibfk_1 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

    
INSERT INTO users (email, display_name, username, password, birthdate, role)
VALUES 
('admin@admin.com', 'Admin', 'admin', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-01-01', 'admin'),
('elsa@test.com', 'Elsa Rama', 'elsarama', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-12-16', 'user'),
('haris@test.com', 'Haris Cmega', 'harisc', '$2y$10$q1NPFtBIhYXBKd8UbCvA2O87W8TUL2nNwQn8ab9V/.co4O./HVcP2', '2004-01-01', 'user');
