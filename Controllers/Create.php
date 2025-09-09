<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Functions.php';

$db = (new Database())->connect();
$functions = new Functions($db);

if (isset($_POST['submit'])) {
    $id_number = $_POST['id_number'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // Let database auto-handle "id" (if it's AUTO_INCREMENT)
    if ($functions->create(null, $name, $email, $course, $id_number)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error creating student.";
    }
}
?>

<link rel="stylesheet" href="style.css">

<form method="POST">
    <h2>Create Student Record</h2>
    
    <label>ID Number:</label><br>
    <input type="text" name="id_number" required><br><br>

    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>
    
    <label>Course:</label><br>
    <input type="text" name="course" required><br><br>
    
    <input type="submit" name="submit" value="Add Student">
    <a href="index.php" class="cancel-btn">Cancel</a>
</form>
