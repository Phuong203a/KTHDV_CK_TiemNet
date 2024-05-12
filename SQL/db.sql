CREATE TABLE UserAccount (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  id_role INT,
  phone_number VARCHAR(20),
  username VARCHAR(50),
  password VARCHAR(50),
  birthday DATE,
  balance DECIMAL(10, 2),
  address VARCHAR(255),
  email VARCHAR(255)
);

CREATE TABLE Role (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE Computer (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  serial VARCHAR(50),
  zone_id INT
);


CREATE TABLE Zone (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  price_per_hour DECIMAL(10, 2),
  keyboard VARCHAR(50),
  mouse VARCHAR(50),
  headphone VARCHAR(50),
  CPU VARCHAR(50),
  RAM VARCHAR(50),
  Card VARCHAR(50),
  Chair VARCHAR(50)
);

CREATE TABLE Invoice (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  id_zone INT,
  id_computer INT,
  status VARCHAR(50),
  staff_name VARCHAR(255),
  content VARCHAR(255),
  tax DECIMAL(10, 2),
  total DECIMAL(10, 2)
);

CREATE TABLE Category (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255)
);

CREATE TABLE Service (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  category_id INT,
  name VARCHAR(255),
  price DECIMAL(10, 2),
  img VARCHAR(255)
);

CREATE TABLE PaymentHistory (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action VARCHAR(255),
  amount DECIMAL(10, 2),
  status VARCHAR(50),
  time DATETIME
);

CREATE TABLE History (
  ID INT AUTO_INCREMENT PRIMARY KEY,
  id_service INT,
  id_computer INT,
  id_zone INT,
  name VARCHAR(255),
  description VARCHAR(255),
  time DATETIME
);