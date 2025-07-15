<?php
session_start();
if (!isset($_SESSION["user_id"])) exit;

require_once "db_connect.php"; // External PDO connection

$user_id = $_SESSION["user_id"];

$stmt = $conn->prepare("SELECT * FROM grant_applications WHERE user_id = ?");
$stmt->execute([$user_id]);
$grant = $stmt->fetch(PDO::FETCH_ASSOC);

function star_middle($value) {
  $len = strlen($value);
  if ($len <= 4) return str_repeat("*", $len);
  return substr($value, 0, 3) . str_repeat("*", $len - 6) . substr($value, -3);
}

if ($grant):
?>
  <div class="info-box">
    <strong>Project Title</strong>
    <?= htmlspecialchars($grant['project_title']) ?>
  </div>
  <div class="info-box">
    <strong>Amount Requested</strong>
    ₦<?= number_format($grant['amount_requested'], 2) ?>
  </div>
  <div class="info-box">
    <strong>Grant Application</strong>
    Under Review
  </div>
<?php
else:
?>
  <div class="info-box" style="grid-column: span 2; text-align:center;">
    <strong>No Grant Application Found</strong>
    You have not submitted any application.
  </div>
  <a href="#" data-bs-toggle="modal" data-bs-target="#grantFormModal" class="btn btn-success">
    Apply for Grant
  </a>
<?php endif; ?>

