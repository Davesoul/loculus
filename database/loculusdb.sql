-- CREATE TABLE --

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE directories (
    directory_id INT AUTO_INCREMENT PRIMARY KEY,
    directory_name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE resources (
    resource_id INT AUTO_INCREMENT PRIMARY KEY,
    resource_name VARCHAR(255) NOT NULL,
    type VARCHAR(255),
    size BIGINT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE permissions (
    permission_id INT AUTO_INCREMENT PRIMARY KEY,
    permission_type ENUM('GUEST', 'STANDARD', 'ADMIN') NOT NULL
);

CREATE TABLE user_directory (
    user_id INT NOT NULL,
    directory_id INT NOT NULL,
    permission_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (directory_id) REFERENCES directories(directory_id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(permission_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, directory_id, permission_id)
);

CREATE TABLE directory_resource (
    directory_id INT NOT NULL,
    resource_id INT NOT NULL,
    FOREIGN KEY (directory_id) REFERENCES directories(directory_id) ON DELETE CASCADE,
    FOREIGN KEY (resource_id) REFERENCES resources(resource_id) ON DELETE CASCADE,
    PRIMARY KEY (directory_id, resource_id)
);

CREATE TABLE history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action VARCHAR(50) NOT NULL,
    history_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE transfers (
    transfer_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    resource_id INT NOT NULL,
    destination_user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (resource_id) REFERENCES resources(resource_id) ON DELETE CASCADE,
    FOREIGN KEY (destination_user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE user_preferences (
    preference_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    profile_picture VARCHAR(255),
    color1 VARCHAR(20),
    color2 VARCHAR(20),
    color3 VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- INSERT INTO --


-- Insert users
INSERT INTO users (username, email, password) VALUES
    ('user1', 'user1@example.com', 'password1'),
    ('user2', 'user2@example.com', 'password2'),
    ('user3', 'user3@example.com', 'password3');

-- Insert directories
INSERT INTO directories (directory_name, path) VALUES
    ('user_1', '../../Directories/user_1'),
    ('user_2', '../../Directories/user_2'),
    ('user_3', '../../Directories/user_3'),
    ('Our_books', '../../Directories/user_1/our_books');


-- Insert permissions
INSERT INTO permissions (permission_type) VALUES
    ('ADMIN'),
    ('STANDARD'),
    ('GUEST');

-- Insert into user_directory
INSERT INTO user_directory (user_id, directory_id, permission_id) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(1, 4, 1),
(2, 4, 2),
(3, 4, 3);


-- Insert into history
INSERT INTO history (user_id, action) VALUES
(1, 'create account'),
(2, 'create account'),
(3, 'create account');

-- Insert into user_preferences
INSERT INTO user_preferences (user_id, profile_picture, color1, color2, color3) VALUES
(1, 'default.jpg', '#FF5733', '#3E95CD', '#3E3E3E'),
(2, 'default.jpg', '#E84393', '#41B883', '#6C757D'),
(3, 'default.jpg', '#5F27CD', '#F39C12', '#00BCD4');


