
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit();
}

$conn = new mysqli("localhost", "root", "", "nelfund_db");
if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM applicants WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

$grant_stmt = $conn->prepare("SELECT * FROM grant_applications WHERE user_id = ?");
$grant_stmt->bind_param("i", $user_id);
$grant_stmt->execute();
$grant = $grant_stmt->get_result()->fetch_assoc();


function star_middle($value) {
  $len = strlen($value);
  if ($len <= 4) return str_repeat("*", $len);
  return substr($value, 0, 3) . str_repeat("*", $len - 6) . substr($value, -3);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard – NELFund</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #e9f5ee;
      margin: 0;
      padding: 0;
    }
    .header {
      background: #155724;
      color: white;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .container {
      max-width: 800px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .profile-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #155724;
      margin-bottom: 10px;
    }
    .center {
      text-align: center;
    }
    .info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
      margin-top: 20px;
    }
    .info-box {
      background: #f0fdf4;
      padding: 15px;
      border-radius: 6px;
      border-left: 4px solid #28a745;
    }
    .info-box strong {
      display: block;
      color: #155724;
      margin-bottom: 5px;
    }
    .footer-links {
      margin-top: 30px;
      text-align: center;
    }
    .footer-links a {
      margin: 0 15px;
      color: #218838;
      text-decoration: none;
      font-weight: 500;
    }
    .footer-links a:hover {
      text-decoration: underline;
    }
    @media (max-width: 600px) {
      .info-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
  <!-- Add in <head> of your dashboard -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('grantForm');

  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(form);

      fetch('grantapplication.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(responseHtml => {
        // Replace modal content with the updated form response (success message or errors)
        document.querySelector('.modal-body').innerHTML = responseHtml;

        // If submission was successful, reload part of the dashboard
        if (responseHtml.includes("Application Submitted")) {
          // Close modal after 1 second
          setTimeout(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('grantFormModal'));
            modal.hide();
          }, 1000);

          // Fetch updated grant section
          fetch('fetch_grant_section.php')
            .then(res => res.text())
            .then(html => {
              document.querySelector('.info-grid').innerHTML = html;
            });
        }
      });
    });
  }
});
</script>

<body>
 
   <header class="navbar" style="position:sticky; top:0%;">
    
      <div class="logo" style="text-align:centre; padding-left:200px;">NCGFund User Dashboard</div>
      <nav>
        
      </nav>
    
  </div>
  
  </header>
  <div class="container">
    <div class="center">
      <img src="aa.jpg" alt="Profile Picture" class="profile-img">
      <h2><?= htmlspecialchars($user['name']) ?></h2>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>

    <div class="info-grid">
      <div class="info-box">
        <strong>Phone Number</strong>
        <?= htmlspecialchars($user['phone']) ?>
      </div>
      <div class="info-box">
        <strong>NIN</strong>
        <?= star_middle($user['nin']) ?>
      </div>
      <div class="info-box">
        <strong>BVN</strong>
        <?= star_middle($user['bvn']) ?>
      </div>
      <?php if ($grant): ?>
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
      <?php else: ?>
      <div class="info-box" style="grid-column: span 2; text-align:center;">
        <strong>No Grant Application Found</strong>
        You have not submitted any application.
      </div>
     <!-- Trigger Button -->
<a href="#" data-bs-toggle="modal" data-bs-target="#grantFormModal" class="btn btn-success">
  Apply for Grant
</a>

<!-- Modal Structure -->
<div class="modal fade" id="grantFormModal" tabindex="-1" aria-labelledby="grantFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="grantFormLabel">Grant Application Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php include 'grantapplication.php'; ?>
      </div>
    </div>
  </div>
</div>


<script>
  const openBtn = document.getElementById('openGrantForm');
  const modal = document.getElementById('grantModal');
  const formContainer = document.getElementById('grantFormContent');

  openBtn.addEventListener('click', function (e) {
    e.preventDefault();
    modal.style.display = 'block';

    // Load the form into the modal using AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "grantapplication.php", true); // Separate file with only the form markup
    xhr.onload = function () {
      if (xhr.status === 200) {
        formContainer.innerHTML = xhr.responseText;
      } else {
        formContainer.innerHTML = "Unable to load form.";
      }
    };
    xhr.send();
  });

  function closeModal() {
    modal.style.display = 'none';
    formContainer.innerHTML = 'Loading form...';
  }
</script>

      <?php endif; ?>
    </div>

    <div class="footer-links">
      <a href="update_profile.php">Update Profile</a>
      <a href="faq.php">FAQs</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>
</body>
</html>
