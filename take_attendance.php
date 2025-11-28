<?php
$studentsFile = 'students.json';
$students = [];
$message = '';

if (!file_exists($studentsFile)) {
    $message = "<div class='msg error'>Aucun étudiant trouvé.</div>";
} else {
    $students = json_decode(file_get_contents($studentsFile), true);
    if (!$students) {
        $message = "<div class='msg error'>Aucun étudiant trouvé.</div>";
    }
}

$todayFile = 'attendance_' . date('Y-m-d') . '.json';

#if (file_exists($todayFile)) {
    #$message = "<div class='msg error'>Attendance for today has already been taken.</div>";
#}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($students) && count($students) > 0) {
    $attendance = [];
    foreach ($students as $student) {
        $status = $_POST['status'][$student['student_id']] ?? 'absent';
        $attendance[] = ['student_id' => $student['student_id'], 'status' => $status];
    }
    file_put_contents($todayFile, json_encode($attendance, JSON_PRETTY_PRINT));
    $message = "<div class='msg success'>Attendance saved successfully!</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Take Attendance</title>
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
        max-width: 800px;
        margin: 0 auto;
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border: 1px solid #053F5C;
    }

    h2 {
        color: #053F5C;
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #cbd5e1;
        padding: 10px;
        text-align: left;
    }

    th {
        background: #053F5C;
        color: white;
    }

    td {
        background: #e8f1ff;
    }

    select {
        width: 100%;
        padding: 6px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
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
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
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
        <a href="update_student.php" class="nav-link"> Update Student</a>
        <a href="list_students.php" class="nav-link"> List Student</a>
        <a href="create_session.php" class="nav-link"> Create Session</a>
        <a href="close_session.php" class="nav-link"> Close Session</a>
        <a href="attendance.html" class="nav-link"> Main System</a>
    </div>
</div>

<div class="container">
    <h2>Take Attendance</h2>
     <?= $message ?>
    
    <?php if (count($students) > 0): ?>

<form method="POST">
   <table>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['student_id'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['name'] ?? '') ?></td>
                <td>
                    <select name="status[<?= htmlspecialchars($s['student_id']) ?>]">
                        <option value="present">Present</option>
                        <option value="absent">Absent</option>
                    </select>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if (!file_exists($todayFile)): ?>
    <button type="submit">Submit Attendance</button>
    <?php else: ?>
        <p>Attendance for today has already been taken.</p>
     <?php endif; ?>
</form>
<?php endif; ?>
</div>

</body>
</html>