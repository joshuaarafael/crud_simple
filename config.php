<?php

include '.env';

$conn = new mysqli($host, $user, $pass);

// Buat database jika belum ada
$conn->query("CREATE DATABASE IF NOT EXISTS $db");
$conn->select_db($db);

// Buat tabel users
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
)");

// Buat tabel items
$conn->query("CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
)");

// Tambah user admin jika belum ada
$result = $conn->query("SELECT * FROM users WHERE username = 'admin'");
if ($result->num_rows === 0) {
    $conn->query("INSERT INTO users (username, password) VALUES ('admin', MD5('123'))");
}
?>