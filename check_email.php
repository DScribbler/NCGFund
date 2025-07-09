<?php
if (!isset($_GET['email'])) exit;

$email = $_GET['email'];
$conn = new PDO("mysql:host=localhost;dbname=nelfund_db", "root", "");
$stmt = $conn->prepare("SELECT id FROM applicants WHERE email = ?");
$stmt->execute([$email]);

echo $stmt->rowCount() > 0 ? "exists" : "available";
