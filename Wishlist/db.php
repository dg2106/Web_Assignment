<?php
// db.php

// database connection settings
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = '';

// create database connection
$conn = new mysqli($hostname, $username, $password, $database);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}