CREATE TABLE categories 
(
	categoryID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(50) NOT NULL
);

INSERT INTO categories (name)
VALUES
('Heterosexual'),
('Homosexual'),
('Illegal');