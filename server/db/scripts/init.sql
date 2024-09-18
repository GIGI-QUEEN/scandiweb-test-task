CREATE TABLE IF NOT EXISTS product_types (
                                             id INT AUTO_INCREMENT PRIMARY KEY,
                                             type_name VARCHAR(255) NOT NULL
);


CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        sku VARCHAR(255) NOT NULL,
                                        name VARCHAR(255) NOT NULL,
                                        price DOUBLE NOT NULL,
                                        type_id INT,
                                        FOREIGN KEY (type_id) REFERENCES product_types(id)
);


CREATE TABLE IF NOT EXISTS furnitures (
                                          product_id INT PRIMARY KEY,
                                          height FLOAT NOT NULL,
                                          width FLOAT NOT NULL,
                                          length FLOAT NOT NULL,
                                          FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS books (
                                     product_id INT PRIMARY KEY,
                                     weight FLOAT NOT NULL,
                                     FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);


CREATE TABLE IF NOT EXISTS dvds (
                                    product_id INT PRIMARY KEY,
                                    size FLOAT NOT NULL,
                                    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

INSERT INTO product_types (type_name) VALUES
                                          ('furniture'),
                                          ('book'),
                                          ('dvd');

INSERT INTO products (sku, name, price, type_id) VALUES
                                                     ('FUR001', 'Sofa', 499.99, 1),
                                                     ('FUR002', 'Dining Table', 299.99, 1),
                                                     ('BOOK001', 'War and Peace', 19.99, 2), 
                                                     ('BOOK002', 'The Catcher in the Rye', 9.99, 2),  
                                                     ('DVD001', 'Inception', 14.99, 3), 
                                                     ('DVD002', 'The Matrix', 12.99, 3); 

INSERT INTO books (product_id, weight) VALUES
                                           ((SELECT id FROM products WHERE sku = 'BOOK001'), 1.2),
                                           ((SELECT id FROM products WHERE sku = 'BOOK002'), 0.5);
                                           
INSERT INTO furnitures (product_id, height, width, length) VALUES
                                                               ((SELECT id FROM products WHERE sku = 'FUR001'), 85, 200, 90),
                                                               ((SELECT id FROM products WHERE sku = 'FUR002'), 75, 150, 90);

INSERT INTO dvds (product_id, size) VALUES
                                        ((SELECT id FROM products WHERE sku = 'DVD001'), 4.7),  -- Inception
                                        ((SELECT id FROM products WHERE sku = 'DVD002'), 4.7);  -- The Matrix