
-- Users table
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    username VARCHAR(64) NOT NULL UNIQUE,
    email VARCHAR(120) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Products table
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    item_description TEXT NULL,
    item_features TEXT NULL,
    feature_list TEXT NULL,
    detail_description TEXT NULL,
    sizes TEXT NULL,
    images TEXT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    status BOOLEAN DEFAULT FALSE,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Orders table
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Contacts table
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    message TEXT NOT NULL,
    phone VARCHAR(64) NOT NULL,
    email VARCHAR(120) NOT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);

-- Subscribe table
DROP TABLE IF EXISTS `subscribe`;
CREATE TABLE `subscribe`  (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(120) NOT NULL,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);


INSERT INTO products (id, name, description, item_description, item_features, feature_list, detail_description, sizes, images, price, category, image_url, status, created_at, updated_at) VALUES
(1, 'Fry Chicken', 'Fry chicken mixed with fries', 'adaysuyidausy ss', '[{name: ''type'', description: ''hgs''}]', '[{name: ''sm'', description: ''Small''}]', NULL, '[{name: ''sm'', description: ''Small''}]', '[{src: ''https://i.pravatar.cc/200?u=fake@pravatar.com''}, {src: ''https://i.pravatar.cc/200?u=fake@pravatar.com''}, {src: ''https://i.pravatar.cc/200?u=fake@pravatar.com''}, {src: ''https://i.pravatar.cc/200?u=fake@pravatar.com''}]', 299.99, 'Dairy product', '/public/images/img1.jpg', FALSE,  '2024-08-27 11:24:03',  '2024-08-27 11:24:03'),
(2, 'Burger', 'Beef burger with cheese. A juicy treat with juice', NULL, '[{name: ''type'', description: ''hgs''}]', NULL, NULL, NULL, NULL, 199.99, 'Dairy product', '/public/images/img2.jpg', FALSE,  '2024-08-27 11:24:03',  '2024-08-27 11:24:03'),
(3, 'Pasta Salad', 'Chicken chunks mixed with macaroni and varnish', NULL, NULL, NULL, NULL, NULL, NULL, 999.99, 'Vegetable', '/public/images/img3.jpg', TRUE,  '2024-08-27 11:24:03',  '2024-08-27 11:24:03'),
(4, 'Cherry', 'Sorted and freshly picked cherry.', NULL, NULL, NULL, NULL, NULL, NULL, 421.99, 'Dairy', '/public/images/img4.jpg', TRUE, '2024-08-27 11:24:03', '2024-08-27 11:24:03'),
(5, 'Fry Fish', 'Cooked to perfection.', NULL, NULL, NULL, NULL, NULL, NULL, 30.99, 'Fruits', '/public/images/img5.jpg', TRUE,  '2024-08-27 11:24:03',  '2024-08-27 11:24:03'),
(6, 'Chicken', 'Fresh chicken tenders.', NULL, NULL, NULL, NULL, NULL, NULL, 299.99, 'Meet', '/public/images/img6.jpg', TRUE,  '2024-08-27 11:24:03',  '2024-08-27 11:24:03');