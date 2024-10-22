CREATE DATABASE IF NOT EXISTS scandi_db;
CREATE USER IF NOT EXISTS 'scandi_user'@'%' IDENTIFIED BY 'your_secure_password';
GRANT ALL PRIVILEGES ON scandi_db.* TO 'scandi_user'@'%';
FLUSH PRIVILEGES;


-- Table for Categories
CREATE TABLE Categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Table for Attributes
CREATE TABLE Attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES Categories(id) ON DELETE CASCADE
);

-- Table for Products
CREATE TABLE Products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(100) NOT NULL UNIQUE, -- Unique SKU for each product
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Table for Product Attribute Values
CREATE TABLE Product_Attribute (
    product_id INT NOT NULL,
    attribute_id INT NOT NULL,
    value VARCHAR(255) NOT NULL,      -- Value can be a number or text based on the attribute
    PRIMARY KEY (product_id, attribute_id),
    FOREIGN KEY (product_id) REFERENCES Products(id) ON DELETE CASCADE,
    FOREIGN KEY (attribute_id) REFERENCES Attributes(id) ON DELETE CASCADE
);

-- Insert mock data into Categories table
INSERT INTO Categories (name) VALUES
('DVD'),
('Book'),
('Furniture');

-- Insert mock data into Attributes table
INSERT INTO Attributes (category_id, name) VALUES
(1, 'Size'),      -- For DVD
(2, 'Weight'),  -- For Book
(3, 'Height'),  -- For Furniture
(3, 'Width'),    -- For Furniture
(3, 'Length');  -- For Furniture

-- Insert mock data into Products table
INSERT INTO Products (sku, name, price) VALUES
-- DVDs
('DVD002', 'Inception DVD', 24.99),
('DVD003', 'Interstellar DVD', 29.99),
('DVD004', 'The Godfather DVD', 19.99),
('DVD005', 'Star Wars DVD', 21.99),
-- Books
('BOOK002', 'The Hobbit', 19.99),
('BOOK003', 'Game of Thrones', 24.99),
('BOOK004', '1984 by George Orwell', 14.99),
('BOOK005', 'To Kill a Mockingbird', 18.99),
-- Furniture
('FURN003', 'Dining Table', 199.99),
('FURN004', 'Sofa Set', 499.99),
('FURN005', 'Wardrobe', 299.99),
('FURN006', 'Office Desk', 149.99);

-- DVDs (Size in MB)
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(1, 1, '800'),  -- Inception DVD, 800 MB
(2, 1, '850'),  -- Interstellar DVD, 850 MB
(3, 1, '700'),  -- The Godfather DVD, 700 MB
(4, 1, '750');  -- Star Wars DVD, 750 MB

-- Books (Weight in Kg)
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(5, 2, '1.0'),  -- The Hobbit, 1.0 Kg
(6, 2, '1.5'),  -- Game of Thrones, 1.5 Kg
(7, 2, '0.8'),  -- 1984 by George Orwell, 0.8 Kg
(8, 2, '1.1');  -- To Kill a Mockingbird, 1.1 Kg

-- Furniture (Dimensions)
-- Dining Table
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(9, 3, '0.9'),   -- Dining Table, 0.9m Height
(9, 4, '1.8'),   -- Dining Table, 1.8m Width
(9, 5, '2.2');   -- Dining Table, 2.2m Length

-- Sofa Set
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(10, 3, '1.2'),  -- Sofa Set, 1.2m Height
(10, 4, '2.5'),  -- Sofa Set, 2.5m Width
(10, 5, '3.0');  -- Sofa Set, 3.0m Length

-- Wardrobe
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(11, 3, '2.0'),  -- Wardrobe, 2.0m Height
(11, 4, '1.0'),  -- Wardrobe, 1.0m Width
(11, 5, '1.5');  -- Wardrobe, 1.5m Length

-- Office Desk
INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES
(12, 3, '0.75'), -- Office Desk, 0.75m Height
(12, 4, '1.5'),  -- Office Desk, 1.5m Width
(12, 5, '1.0');  -- Office Desk, 1.0m Length