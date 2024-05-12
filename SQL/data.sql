INSERT INTO Role (name) VALUES ('admin');
INSERT INTO Role (name) VALUES ('staff');
INSERT INTO Role (name) VALUES ('client');


INSERT INTO useraccount (name, id_role, phone_number, username, password, birthday, balance, address, email)
VALUES ('admin_name', 1, '0771234567', 'admin', 'admin', '1990-01-01', 0, '123 Main St', 'admin@example.com');