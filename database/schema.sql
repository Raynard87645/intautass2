CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    username VARCHAR(64) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    status BOOLEAN DEFAULT FALSE
);

CREATE TABLE IF NOT EXISTS contacts (
    id SERIAL PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    message TEXT NOT NULL,
    phone VARCHAR(64) NOT NULL,
    email VARCHAR(120) NOT NULL
);

INSERT INTO products (name, description, price, category, image_url, status) VALUES
('Fry Chicken', 'Fry chicken mixed with fries', 299.99, 'Dairy product', '/public/images/img1.jpg', FALSE),
('Burger', 'Beef burger with cheese. A juicy treat with juice', 199.99, 'Dairy product', '/public/images/img2.jpg', FALSE),
('Pasta Salad', 'Chicken chunks mixed with macaroni and varnish', 999.99, 'Vegetable', '/public/images/img3.jpg', TRUE),
('Cherry', 'Sorted and freshly picked cherry.', 421.99, 'Dairy', '/public/images/img4.jpg', TRUE);
('Fry Fish', 'Cooked to perfection.', 30.99, 'Fruits', '/public/images/img5.jpg', TRUE);
('Chicken', 'Fresh chicken tenders.', 299.99, 'Meet', '/public/images/img6.jpg', TRUE);