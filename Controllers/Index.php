<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Functions.php';

$db = (new Database())->connect();
$functions = new Functions($db);

$student = $functions->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Students Record</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<div class="container">
    <h2>Student Records</h2>

    <a href="create.php">Add Student</a><br><br>


    <?php if (count($student) > 0): ?>
        <?php foreach ($student as $post): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($post['name']); ?></h3>
                <p><?php echo nl2br(htmlspecialchars($post['email'])); ?></p>
                <p><?php echo nl2br(htmlspecialchars($post['course'])); ?></p>
                <p><?php echo nl2br(htmlspecialchars($post['id_number'])); ?></p>
                <div class="actions">
                    <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No student record found.</p>
    <?php endif; ?>
</div>


</body>
</html>