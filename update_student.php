<?php
include 'db_connect.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $matricule = $_POST['matricule'];
    $group_id = $_POST['group_id'];

    #$stmt = $conn->prepare("UPDATE students SET fullname=?, matricule=?, group_id=? WHERE id=?");
    #$stmt->execute([$fullname, $matricule, $group_id, $id]);
    #echo "Student updated!";
    if ($id && $fullname && $matricule && $group_id) {
        $stmt = $conn->prepare("UPDATE students SET fullname=?, matricule=?, group_id=? WHERE id=?");
        $success = $stmt->execute([$fullname, $matricule, $group_id, $id]);

        if ($success) {
            $message = "<div class='msg success'>Student updated successfully!</div>";
        } else {
            $message = "<div class='msg error'>Failed to update student!</div>";
        }
    } else {
        $message = "<div class='msg error'>All fields are required!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Student</title>
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #D5DEEF;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        width: 400px;
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
    <h2>Update Student</h2>

     <?= $message ?>

    <form method="POST">
         <input type="text" name="id" placeholder="Student ID" required>
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="text" name="matricule" placeholder="Matricule" required>
        <input type="text" name="group_id" placeholder="Group ID" required>
        <button type="submit">Update Student</button>

    </form>
</div>

</body>
</html>
