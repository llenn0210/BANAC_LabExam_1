<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Functions.php';

$db = (new Database())->connect();
$functions = new Functions($db);

if (!isset($_GET['id'])) {
    echo "No student id provided.";
    exit;
}

// Get student by ID
$student = $functions->getById($_GET['id']);

if (!$student) {
    echo "Student not found.";
    exit;
}

if (isset($_POST['submit'])) {
    $id_number = $_POST['id_number'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    if ($functions->update($student['id'], $name, $email, $course, $id_number)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record.";
    }
}
?>

<link rel="stylesheet" href="style.css">

<form method="POST">
    <h2>Edit Student Records</h2>

    <label>ID Number:</label><br>
    <input type="text" name="id_number" 
           value="<?php echo htmlspecialchars($student['id_number']); ?>" required><br><br>
    
    <label>Name:</label><br>
    <input type="text" name="name" 
           value="<?php echo htmlspecialchars($student['name']); ?>" required><br><br>
    
    <label>Email:</label><br>
    <input type="email" name="email" 
           value="<?php echo htmlspecialchars($student['email']); ?>" required><br><br>

    <label>Course:</label><br>
    <input type="text" name="course" 
           value="<?php echo htmlspecialchars($student['course']); ?>" required><br><br>
    
    <input type="submit" name="submit" value="Update Record">
    <a href="index.php" class ="back-btn">Back to Records</a>
</form>
