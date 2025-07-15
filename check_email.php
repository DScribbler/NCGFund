<?php
if (!isset($_GET['email'])) exit;

$email = $_GET['email'];

// Use external PDO database connection
require_once 'db_connect.php'; // assumes $conn is defined as a PDO instance

$stmt = $conn->prepare("SELECT id FROM applicants WHERE email = ?");
$stmt->execute([$email]);

echo $stmt->rowCount() > 0 ? "exists" : "available";
