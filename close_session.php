<?php
include 'db_connect.php';
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['session_id'])) {
    $session_id = $_POST['session_id'];
    $stmt = $conn->prepare("UPDATE attendance_sessions SET status='closed' WHERE id=?");
    if ($stmt->execute([$session_id])) {
        $message = "<div class='success'>Session closed successfully!</div>";
    } else {
        $message = "<div class='error'>Failed to close session.</div>";
    }
}}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Close Session</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #D5DEEF;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1{
            text-align: center;
            color: #053F5C;
            margin-bottom: 20px;
        }
        label{
            font-family: 'Segoe UI', sans-serif;
            color:#053F5C ;
        }
        .success {
            background: #c8ffd4;
            color: #067a1c;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 6px solid #06b63d;
            font-weight: bold;
        }

        .error {
            background: #ffd4d4;
            color: #a30000;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 6px solid #ff3d3d;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #D5DEEF;
            font-size: 14px;
        }
        button {
            background:#053F5C ;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            opacity: 0.9;
        }
        
    </style>

</head>
<body>
<div class="container">
    <h1>Close Attendance Session</h1>
     
    <form method="POST">
   <label for="ID"> Session ID to close:</label> 
    <input name="session_id"><br>
    <button type="submit">Close Session</button>
     <?php 
        if (!empty($message)) {
            echo $message;
        }
    ?>
    </form>
</div>
</body>
</html>

