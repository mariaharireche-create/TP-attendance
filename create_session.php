<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $group_id = $_POST['group_id'];
    $prof_id = $_POST['prof_id'];

    $stmt = $conn->prepare("INSERT INTO attendance_sessions (course_id, group_id, date, opened_by, status) VALUES (?, ?, NOW(), ?, 'open')");
    if ($stmt->execute([$course_id, $group_id, $prof_id])) {
        $last_id = $conn->lastInsertId();
        $message = "<div class='msg success'>Session created successfully! ID: $last_id</div>";
    } else {
        $message = "<div class='msg error'>Failed to create session!</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create  Session</title>

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
            background: #D5DEEF; 
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 380px;
            text-align: center;
        }
        h2 {
            color: #053F5C;
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            color: #053F5C;
            display: block;
            margin-bottom: 6px;
            text-align: left;
        }
        button  {
            background: #053F5C;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }
        input  {
            background: #cbd5e1;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #053F5C;
            font-size: 14px;
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
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #34d399;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #f87171;
        }
    </style>
</head>

<body>
    <div class="form-container">
    <h2>Open  Session</h2>

    

    <form method="POST">
      <label for="ID">Course ID:</label> 
      <input name="course_id"><br>

      <label for="ID">Group ID:</label>  
      <input name="group_id"><br>

      <label for="ID">Professor ID:</label> 
      <input name="prof_id"><br>

      <button type="submit">Create Session</button>
    </form>
      <?php 
        if (!empty($message)) {
            echo $message;
        }
    ?>
    </div>
</body>
</html>

