 <?php include 'header.php'; ?>
<?php
session_start();
$errors = [];

try {
  // Connect to MySQL database
  $conn = new PDO("mysql:host=localhost;dbname=nelfund_db", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"] ?? "";
  $bvn = $_POST["bvn"] ?? "";

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Enter a valid email.";
  if (!$bvn) $errors[] = "BVN is required.";

  if (!$errors) {
    $stmt = $conn->prepare("SELECT id, name FROM applicants WHERE email = ? AND bvn = ?");
    $stmt->execute([$email, $bvn]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $_SESSION["user_id"] = $user["id"];
      $_SESSION["user_name"] = $user["name"];
      header("Location: dashboard.php");
      exit();
    } else {
      $errors[] = "Invalid email or BVN.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NELFund – Interest-Free Student Loans</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
 
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>National Credit Guarantee Fund</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .slideshow-container {
      position: relative;
      max-width: 100%;
      margin: auto;
      overflow: hidden;
    }

    .slide {
      display: none;
      position: relative;
    }

    .slide img {
      width: 100%;
      height: 570px;
      object-fit: cover;
    }

    .caption {
      position: absolute;
      bottom: 40px;
      left: 50px;
      background-color: rgba(0,0,0,0.5);
      color: #fff;
      padding: 15px 25px;
      font-size: 20px;
      border-radius: 5px;
    }

    /* Fade animation */
    .fade {
      animation: fadeEffect 1.5s ease-in-out;
    }

    @keyframes fadeEffect {
      from {opacity: 0.9}
      to {opacity: 1}
    }
  </style>
</head>
<body></body>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login – NCGFund</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .form-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 25px;
      background: #f8f8f8;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
  background: #008f5a;
      background: #00a86b;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
    }
    .btn:hover {
      background: #00a86b;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <form method="POST">
      <h2>Login to Your National Credit Guarantee Fund Account</h2>
      <?php foreach ($errors as $e): ?>
        <p class="error"><?= htmlspecialchars($e) ?></p>
      <?php endforeach; ?>
      <label>Email
        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
      </label>
      <label>BVN
        <input type="password" maxlength="11" name="bvn" value="<?= htmlspecialchars($_POST['bvn'] ?? '') ?>">
      </label>
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
