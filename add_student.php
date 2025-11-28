<?php
$studentsFile = 'students.json';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $group = trim($_POST['group'] ?? '');

    if ($student_id === '' || $name === '' || $group === '') {
        $message = '❌ All fields are required!';
    } else {
        $students = [];
        if (file_exists($studentsFile)) {
            $students = json_decode(file_get_contents($studentsFile), true);
        }

        // Vérifie si student_id existe déjà
        $exists = false;
        foreach ($students as $s) {
            if ($s['student_id'] === $student_id) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $message = "❌ Student ID already exists!";
        } else {
            $students[] = [
                'student_id' => $student_id,
                'name' => $name,
                'group' => $group,
              #  'email' => $email

            ];
            file_put_contents($studentsFile, json_encode($students, JSON_PRETTY_PRINT));
            $message = "✅ Student added successfully!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Student</title>
<link rel="stylesheet" href="style.css">
<style>
    body{
        font-family:'Segoe UI', sans-serif ;
        background: #D5DEEF;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        
    }
    .nav-bar {
        background: #053F5C; 
        padding: 15px 0;
        margin-bottom: 20px;
    }
    .form-container{
        background: white;
        padding: 30px 40px;
        border-radius: 12 px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) ;
        width: 380px;
        text-align: center;
    }
    .nav-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        padding: 0 20px;
    }
    .nav-link {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        background: rgba(255,255,255,0.2);
        border-radius: 6px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    .nav-link:hover {
        background: rgba(255,255,255,0.3);
    }
    .container {
        max-width: 500px;
        margin: 0 auto;
        background: #D5DEEF;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(30,64,175,0.2);
        border: 1px solid #053F5C;
    }
    h1{
        color:white ;
        margin-bottom: 20px;
    }
    label{
        font-weight: 600;
        color: #053F5C;
        display: block;
        margin-bottom: 6px;
        text-align: left;
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
     <div class="nav-bar">
        <div class="nav-container">
            <a href="add_student.php" class="nav-link"> Add Student </a>
            <a href="take_attendance.php" class="nav-link">Take Attendance</a>
            <a href="update_student" class="nav-link"> Update Student</a>
            <a href="list_students.php" class="nav-link"> List Student</a>
            <a href="create_session.php" class="nav-link"> Create Session</a>
            <a href="close_session.php" class="nav-link"> Close Session</a>
            <a href="attendance.html" class="nav-link"> Main System</a>
        </div>
    </div>
<div class="form-container">
 <h1>Add Student</h1>

 <?php if ($message) echo "<p id='confirmationMsg'>$message</p>"; ?>

 <form method="POST">
    <label>Student ID:</label>
    <input type="text" name="student_id" required><br><br>

    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Group:</label>
    <input type="text" name="group" required><br><br>

    <input type="submit" value="Add Student">
</form>
</div>

<p><a href="list_students.php">Go to Students List</a></p>
</body>
</html>
