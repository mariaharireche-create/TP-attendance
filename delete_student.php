<?php
include 'db_connect.php';

$message = "";
#if (isset($_GET['id'])) {
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id']) && $_GET['id'] !== "") {
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $success=$stmt->execute([$_GET['id']]);
  #  echo "Student deleted!";
   if ($success) {
        $message = "<div class='msg success'>Student deleted successfully!</div>";
    } else {
        $message = "<div class='msg error'>Failed to delete student!</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background:#D5DEEF; 
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: white;
            width: 380px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            color: #053F5C;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #D5DEEF;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            background: #053F5C;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.9;
        }

        
        .msg {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        .success {
            background: #d0f8ce;
            color: #256029;
            border: 1px solid #66bb6a;
        }

        .error {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ef5350;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Delete Student</h2>

    <?= $message ?>

    <form method="GET">
        <label style="color:#1b5e20; font-weight:600; float:left;">Student ID:</label>
        <input type="number" name="id" placeholder="Enter student ID..." required>

        <button type="submit">Delete</button>
    </form>
</div>

</body>
</html>