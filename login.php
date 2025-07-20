<?php
include("db.php");

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM voters WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Login success, redirect to voting page
        header("Location: vote.php");
        exit();
    } else {
        $msg = "❌ Invalid email or password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
  <h2>🔐 Voter Login</h2>
  <form method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Enter email" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter password" required>

    <input type="submit" value="Login">
  </form>
</div>

</body>
</html>
