<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'toor');
define('DB', 'cryptowatcher');

$conn = @new mysqli(HOST, USER, PASSWORD, DB);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}