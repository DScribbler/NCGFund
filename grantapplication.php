<?php
if (session_status() === PHP_SESSION_NONE) session_start();

include 'db_connect.php';

$errors = [];
$submitted = false;

// AJAX submission handler
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SERVER["HTTP_X_REQUESTED_WITH"])) {
    header("Content-Type: application/json");

    $user_id = $_SESSION["user_id"] ?? null;

    $fullname = $_POST["fullname"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $nationality = $_POST["nationality"] ?? "";
    $email = $_POST["email"] ?? "";
    $phone = $_POST["phone"] ?? "";
    $address = $_POST["address"] ?? "";
    $nin = $_POST["nin"] ?? "";
    $bvn = $_POST["bvn"] ?? "";
    $education = $_POST["education"] ?? "";
    $institution = $_POST["institution"] ?? "";
    $graduation_year = $_POST["graduation_year"] ?? "";
    $field_of_study = $_POST["field_of_study"] ?? "";
    $business_name = $_POST["business_name"] ?? "";
    $sector = $_POST["sector"] ?? "";
    $project_title = $_POST["project_title"] ?? "";
    $description = $_POST["description"] ?? "";
    $amount_requested = $_POST["amount_requested"] ?? "";
    $declaration = isset($_POST["declaration"]);
    $status = "Under Review";

    if (!$user_id) $errors[] = "User session is missing.";
    if (!$fullname) $errors[] = "Full name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email required.";
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

        $stmt->execute();
        $stmt->close();

        echo json_encode(["success" => true]);
        exit;
    } else {
        echo json_encode(["success" => false, "errors" => $errors]);
        exit;
    }
}

// Only show form if not an AJAX request
if ($_SERVER["REQUEST_METHOD"] !== "POST"):
?>

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
</style>

<div class="container">
  <h2>Grant Application Form</h2>
  <form id="grantForm">
    <h3>Personal Information</h3>
    <label>Full Name</label>
    <input type="text" name="fullname" required>

    <label>Date of Birth</label>
    <input type="date" name="dob" required>

    <label>Gender</label>
    <select name="gender">
      <option value="">Select</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>

    <label>Nationality</label>
    <input type="text" name="nationality">

    <label>Email Address</label>
    <input type="email" name="email" required>

    <label>Phone Number</label>
    <input type="text" name="phone" required>

    <label>Home Address</label>
    <input type="text" name="address">

    <label>NIN</label>
    <input type="text" maxlength="11" name="nin" required>

    <label>BVN</label>
    <input type="password" maxlength="11" name="bvn" required>

    <h3>Education / Background</h3>
    <label>Highest Qualification</label>
    <input type="text" name="education">

    <label>Institution Attended</label>
    <input type="text" name="institution">

    <label>Year of Graduation</label>
    <input type="text" name="graduation_year">

    <label>Field of Study</label>
    <input type="text" name="field_of_study">

    <h3>Project or Business Information</h3>
    <label>Business/Project Name</label>
    <input type="text" name="business_name">

    <label>Business Sector</label>
    <input type="text" name="sector">

    <label>Project Title</label>
    <input type="text" name="project_title" required>

    <label>Project Description</label>
    <textarea name="description" rows="6" required></textarea>

    <label>Amount Requested (₦)</label>
    <input type="text" name="amount_requested" required>

    <label>
      <input type="checkbox" name="declaration" value="yes">
      I confirm that the information provided above is accurate to the best of my knowledge.
    </label>

    <button type="submit" class="btn">Submit Grant Application</button>
  </form>
</div>
<?php endif; ?>

