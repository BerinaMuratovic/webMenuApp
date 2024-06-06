<?php
include_once 'config.php'; // Include config.php to establish database connection

// Create users table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
)";

if ($conn->query($sql_users) === FALSE) {
    echo "Error creating users table: " . $conn->error;
}

// Create reservations table
$sql_reservations = "CREATE TABLE IF NOT EXISTS reservations (
    reservation_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    reservation_date DATETIME NOT NULL,
    num_guests INT NOT NULL,
    table_id INT NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (table_id) REFERENCES tables(table_id)
)";


if ($conn->query($sql_reservations) === FALSE) {
    echo "Error creating reservations table: " . $conn->error;
}
// Create orders table
$sql_orders = "CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    drink_id INT NOT NULL,
    
    main_dish_id INT NOT NULL,
    side_dish_id INT NOT NULL,

    FOREIGN KEY (drink_id) REFERENCES drinks(drink_id),
    FOREIGN KEY (main_dish_id) REFERENCES main_dish(main_dish_id),
    FOREIGN KEY (side_dish_id) REFERENCES side_dish(side_dish_id)
)";



if ($conn->query($sql_reservations) === FALSE) {
    echo "Error creating reservations table: " . $conn->error;
}


// Create main_dish table
$sql_main_dish = "CREATE TABLE IF NOT EXISTS main_dish (
    main_dish_id INT AUTO_INCREMENT PRIMARY KEY,
    dish_name VARCHAR(100) NOT NULL,
    price DECIMAL(8, 2) NOT NULL
)";

if ($conn->query($sql_main_dish) === FALSE) {
    echo "Error creating main_dish table: " . $conn->error;
}

// Create side_dish table
$sql_side_dish = "CREATE TABLE IF NOT EXISTS side_dish (
    side_dish_id INT AUTO_INCREMENT PRIMARY KEY,
    dish_name VARCHAR(100) NOT NULL,
    price DECIMAL(8, 2) NOT NULL
)";

if ($conn->query($sql_side_dish) === FALSE) {
    echo "Error creating side_dish table: " . $conn->error;
}

// Create drinks table
$sql_drinks = "CREATE TABLE IF NOT EXISTS drinks (
    drink_id INT AUTO_INCREMENT PRIMARY KEY,
    drink_name VARCHAR(100) NOT NULL,
    price DECIMAL(8, 2) NOT NULL
)";

if ($conn->query($sql_drinks) === FALSE) {
    echo "Error creating drinks table: " . $conn->error;
}

// Create tables table
$sql_tables = "CREATE TABLE IF NOT EXISTS tables (
    table_id INT AUTO_INCREMENT PRIMARY KEY,
    table_number INT NOT NULL,
    capacity INT NOT NULL,
    status ENUM('available', 'occupied', 'reserved') NOT NULL DEFAULT 'available'
)";

if ($conn->query($sql_tables) === FALSE) {
    echo "Error creating tables table: " . $conn->error;
}

echo "Tables created successfully";
$conn->close();
?>
