<?php
$studentsFile = 'students.json';

$students = [];
$message = "";

if (!file_exists($studentsFile)) {
    $message = "<div class='msg error'>No students found.</div>";
} else {
    $data = json_decode(file_get_contents($studentsFile), true);
    if (is_array($data) && count($data) > 0) {
        $students = $data;
    } else {
        $message = "<div class='msg error'>No students found.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #D5DEEF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 50px;
        }

        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 80%;
            max-width: 800px;
        }

        h2 {
            color: #053F5C;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
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

        /* Message */
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

<div class="container">
    <h2>Students List</h2>

    <?php if ($message) echo $message; ?>

    <?php if (count($students) > 0): ?>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($students as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['student_Id'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['name'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['group'] ?? '') ?></td>
                <td><?= htmlspecialchars($s['email'] ?? '') ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

</div>

</body>
</html>
