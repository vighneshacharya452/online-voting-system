<?php
session_start();

// If not admin, redirect to login
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

include("db.php");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Voting Results</title>
    <link rel="stylesheet" href="style.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome (for icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Optional: Bootstrap JS (for dropdowns, modals, etc.) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <div class="center-box">
<a href="logout.php" class="btn btn-outline-danger float-end m-3">
    <i class="fas fa-sign-out-alt"></i> Logout
</a>

    🚪 Logout
</a>

    <h2>📊 Voting Results</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Candidate Name</th>
            <th>Total Votes</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM candidates");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['name']}</td><td>{$row['votes']}</td></tr>";
        }
        ?>
    </table>
    </div>
</body>
</html>
