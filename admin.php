<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

include("db.php");

// Reset all voters
if (isset($_POST['reset_voters'])) {
    $conn->query("DELETE FROM voters");
    echo "<p style='color:orange;'>⚠️ All voters have been deleted successfully.</p>";
}


if (isset($_POST['reset_votes'])) {
    $conn->query("UPDATE candidates SET votes = 0");
    echo "<p style='color:green;'>✅ All vote counts have been reset to 0.</p>";
}


// Add candidate logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $name = $_POST['name'];
    $conn->query("INSERT INTO candidates (name) VALUES ('$name')");
    echo "<p>✅ Candidate added successfully!</p>";
}

// Delete candidate logic
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM candidates WHERE id = $id");
    echo "<p>❌ Candidate deleted!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Candidates</title>
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
   
    <a href="logout.php" class="btn btn-outline-danger float-end m-3">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>

</a>

    <h2>👨‍💼 Admin Panel - Add/Delete Candidates</h2>

    <!-- Add Candidate Form -->
    <form method="post">
        <input type="text" name="name" placeholder="Enter candidate name" required>
        <input type="submit" name="add" value="Add Candidate">
    </form>

    <hr>
    <h3>📋 All Candidates</h3>
    <ul>
        <?php
        $result = $conn->query("SELECT * FROM candidates");
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']} 
                <a href='admin.php?delete={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this candidate?');\">❌ Delete</a>
            </li>";
        }
        ?>
    </ul>

    <hr>
<h3>📊 Voting Results</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>Candidate Name</th>
        <th>Total Votes</th>
    </tr>
    <?php
    $results = $conn->query("SELECT * FROM candidates");
    while ($row = $results->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['votes']}</td>
              </tr>";
    }
    ?>
</table> 
<br>
<form method="post" onsubmit="return confirm('Reset all votes?');">
    <input type="submit" name="reset_votes" value="🧹 Reset All Votes" class="btn btn-danger">
</form>

<br> <!-- GAP HERE -->

<form method="post" onsubmit="return confirm('Delete all voters?');">
    <input type="submit" name="reset_voters" value="🗑️ Reset Voter List" class="btn btn-warning">
</form>


</body>
</html>
