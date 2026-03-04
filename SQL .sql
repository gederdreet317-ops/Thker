CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);
-- كلمة مرور افتراضية: admin (مشفرة بـ MD5 للتجربة، يمكنك تغييرها)
INSERT INTO users (username, password) VALUES ('admin', MD5('admin'));

CREATE TABLE incoming (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(10) NOT NULL,
    number VARCHAR(20) NOT NULL,
    financial_number VARCHAR(20),
    source VARCHAR(100),
    department VARCHAR(100),
    subject TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE outgoing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date VARCHAR(10) NOT NULL,
    number VARCHAR(20) NOT NULL,
    rights_date VARCHAR(10),
    destination VARCHAR(100),
    section_number VARCHAR(20),
    organization VARCHAR(100),
    employees TEXT,
    governorates TEXT,
    hobbies TEXT,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);