<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$submitted = false;
$errors = [];

$conn = new mysqli("localhost", "root", "", "nelfund_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION["user_id"] ?? null;

    // Sanitize inputs
    $fullname = trim($_POST["fullname"] ?? "");
    $dob = $_POST["dob"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $nationality = trim($_POST["nationality"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $nin = trim($_POST["nin"] ?? "");
    $bvn = trim($_POST["bvn"] ?? "");
    $education = trim($_POST["education"] ?? "");
    $institution = trim($_POST["institution"] ?? "");
    $graduation_year = trim($_POST["graduation_year"] ?? "");
    $field_of_study = trim($_POST["field_of_study"] ?? "");
    $business_name = trim($_POST["business_name"] ?? "");
    $sector = trim($_POST["sector"] ?? "");
    $project_title = trim($_POST["project_title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $amount_requested = trim($_POST["amount_requested"] ?? "");
    $declaration = isset($_POST["declaration"]);
    $status = "Under Review";

    // Validation
    if (!$user_id) $errors[] = "User session is missing.";
    if (!$fullname) $errors[] = "Full name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (!$phone) $errors[] = "Phone number is required.";
    if (!$dob || !$gender || !$nationality) $errors[] = "Complete personal info is required.";
    if (!$nin || !$bvn) $errors[] = "NIN and BVN are required.";
    if (!$project_title || !$description) $errors[] = "Project title and description are required.";
    if (!$amount_requested || !is_numeric($amount_requested)) $errors[] = "Valid amount requested is required.";
    if (!$declaration) $errors[] = "You must agree to the declaration.";

    if (!$errors) {
        $stmt = $conn->prepare("INSERT INTO grant_applications (
            user_id, fullname, dob, gender, nationality, email, phone, address, nin, bvn,
            education, institution, graduation_year, field_of_study,
            business_name, sector, project_title, description, amount_requested, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "isssssssssssssssssss",
            $user_id, $fullname, $dob, $gender, $nationality, $email, $phone, $address, $nin, $bvn,
            $education, $institution, $graduation_year, $field_of_study,
            $business_name, $sector, $project_title, $description, $amount_requested, $status
        );

        if ($stmt->execute()) {
            $submitted = true;

            // AJAX success response
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                echo "<div class='success'><h4>✅ Application Submitted!</h4><p>Your application is under review.</p></div>
                <script>
                  document.dispatchEvent(new CustomEvent('applicationSubmitted'));
                </script>";
                exit();
            }
        } else {
            $errors[] = "Database error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!-- Styles -->
<style>
  label { display: block; margin-top: 15px; font-weight: bold; }
  input, select, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  .btn {
    background: #2e7d32;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    margin-top: 20px;
    cursor: pointer;
  }
  .btn:hover { background: #1b5e20; }
  .error { color: red; }
  .success { color: green; text-align: center; }
</style>

<!-- HTML Output -->
<div class="container">
  <?php if ($submitted): ?>
    <div class="success">
      <h2>✅ Application Submitted!</h2>
      <p>Your grant application has been received and is under review.</p>
    </div>
  <?php else: ?>
    <h2>Grant Application Form</h2>
    <?php foreach ($errors as $e): ?>
      <p class="error"><?= htmlspecialchars($e) ?></p>
    <?php endforeach; ?>

    <form method="POST" id="grantForm">
      <h3>Personal Information</h3>
      <label>Full Name</label>
      <input type="text" name="fullname" value="<?= htmlspecialchars($fullname ?? "") ?>" required>

      <label>Date of Birth</label>
      <input type="date" name="dob" value="<?= htmlspecialchars($dob ?? "") ?>" required>

      <label>Gender</label>
      <select name="gender">
        <option value="">Select</option>
        <option <?= ($gender ?? "") == "Male" ? "selected" : "" ?>>Male</option>
        <option <?= ($gender ?? "") == "Female" ? "selected" : "" ?>>Female</option>
        <option <?= ($gender ?? "") == "Other" ? "selected" : "" ?>>Other</option>
      </select>

      <label>Nationality</label>
      <input type="text" name="nationality" value="<?= htmlspecialchars($nationality ?? "") ?>">

      <label>Email Address</label>
      <input type="email" name="email" value="<?= htmlspecialchars($email ?? "") ?>" required>

      <label>Phone Number</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($phone ?? "") ?>" required>

      <label>Home Address</label>
      <input type="text" name="address" value="<?= htmlspecialchars($address ?? "") ?>">

      <label>NIN</label>
      <input type="text" maxlength="11" name="nin" value="<?= htmlspecialchars($nin ?? "") ?>" required>

      <label>BVN</label>
      <input type="password" maxlength="11" name="bvn" value="<?= htmlspecialchars($bvn ?? "") ?>" required>

      <h3>Education / Background</h3>
      <label>Highest Qualification</label>
      <input type="text" name="education" value="<?= htmlspecialchars($education ?? "") ?>">

      <label>Institution Attended</label>
      <input type="text" name="institution" value="<?= htmlspecialchars($institution ?? "") ?>">

      <label>Year of Graduation</label>
      <input type="text" name="graduation_year" value="<?= htmlspecialchars($graduation_year ?? "") ?>">

      <label>Field of Study</label>
      <input type="text" name="field_of_study" value="<?= htmlspecialchars($field_of_study ?? "") ?>">

      <h3>Project or Business Information</h3>
      <label>Business/Project Name</label>
      <input type="text" name="business_name" value="<?= htmlspecialchars($business_name ?? "") ?>">

      <label>Business Sector</label>
      <input type="text" name="sector" value="<?= htmlspecialchars($sector ?? "") ?>">

      <label>Project Title</label>
      <input type="text" name="project_title" value="<?= htmlspecialchars($project_title ?? "") ?>" required>

      <label>Project Description</label>
      <textarea name="description" rows="6" required><?= htmlspecialchars($description ?? "") ?></textarea>

      <label>Amount Requested (₦)</label>
      <input type="text" name="amount_requested" value="<?= htmlspecialchars($amount_requested ?? "") ?>" required>

      <label>
        <input type="checkbox" name="declaration" value="yes" <?= $declaration ? "checked" : "" ?>>
        I confirm that the information provided above is accurate to the best of my knowledge.
      </label>

      <button type="submit" class="btn">Submit Grant Application</button>
    </form>
  <?php endif; ?>
</div>
