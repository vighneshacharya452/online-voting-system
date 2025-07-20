<?php
session_start();
$msg = "";

// Admin credentials (you can change this later)
$admin_email = "admin@email.com";
$admin_password = "admin123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $admin_email && $password === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        $msg = "❌ Invalid admin credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (for icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Optional: Bootstrap JS (for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f0f0f0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .center-box {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .center-box h2 {
      margin-bottom: 20px;
    }

    .center-box label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
      text-align: center;
    }

    .center-box input[type="email"],
    .center-box input[type="password"],
    .center-box input[type="text"],
    .center-box input[type="submit"] {
      width: 90%;
      padding: 10px;
      margin: 10px auto;
      border-radius: 6px;
      border: 1px solid #ccc;
      text-align: center;
      display: block;
      font-size: 16px;
    }

    .center-box input[type="submit"] {
      background-color: #3498db;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

    .center-box input[type="submit"]:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
    <div class="center-box">
    <h2>🔐 Admin Login</h2>
    <form method="post">
        <input type="email" name="email" placeholder="Admin Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p style="color:red;"><?php echo $msg; ?></p>
</div>
</body>
</html>
