 <?php include 'header.php'; ?>
<?php
$submitted = false;
$errors = [];

try {
  // Connect to MySQL database
  $conn = new PDO("mysql:host=localhost;dbname=nelfund_db", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"] ?? "";
  $phone = $_POST["phone"] ?? "";
  $email = $_POST["email"] ?? "";
  $nin = $_POST["nin"] ?? "";
  $bvn = $_POST["bvn"] ?? "";

  if (!$name) $errors[] = "Name is required.";
  if (!$phone) $errors[] = "Phone is required.";
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required.";
  if (!$nin) $errors[] = "NIN is required.";
  if (!$bvn) $errors[] = "BVN is required.";

  if (!$errors) {
    $stmt = $conn->prepare("INSERT INTO applicants (name, phone, email, nin, bvn) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $phone, $email, $nin, $bvn]);
    $submitted = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register – NELFund</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      max-width: 500px;
      margin: 40px auto;
      background: #f4f4f4;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 6px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      background: #28a745;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
    }
    .btn:hover {
      background: #218838;
    }
    .error {
      color: red;
      margin: 5px 0;
    }
    .success-message {
      text-align: center;
      color: green;
    }
  </style>
</head>
<body>


  <div class="form-container">
    <?php if ($submitted): ?>
      <div class="success-message">
        <h2>Account successfully created!</h2>
        <a href="login.php"><p>proceed to the login page</p></a>
      </div>
    <?php else: ?>
      <form method="POST">
        <h2>National Credit Guarantee Fund Registration</h2>
        <?php foreach ($errors as $e): ?>
          <p class="error"><?= htmlspecialchars($e) ?></p>
        <?php endforeach; ?>
        <label>Full Name
          <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
        </label>
        <label>Phone Number
          <input type="text" name="phone" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
        </label>
        <label>Email
          <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </label>
        <label>NIN
          <input type="text" maxlength="11" name="nin" value="<?= htmlspecialchars($_POST['nin'] ?? '') ?>">
        </label>
        <label>BVN
          <input type="text" maxlength="11" name="bvn" value="<?= htmlspecialchars($_POST['bvn'] ?? '') ?>">
        </label>
        <button type="submit" class="btn">CREATE ACCOUNT</button>
      </form>
    <?php endif; ?>
  </div>
</body>
</html>
