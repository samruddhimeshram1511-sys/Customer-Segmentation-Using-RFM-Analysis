CREATE DATABASE CustomerSegmentation;

USE CustomerSegmentation;

CREATE TABLE transactions (
    transaction_id INT PRIMARY KEY,
    customer_id VARCHAR(10),
    order_date DATE,
    amount DECIMAL(10,2)
);
