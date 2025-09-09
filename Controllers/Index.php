<?php
require __DIR__ . '/../Database.php';
require __DIR__ . '/../Functions.php';
require __DIR__ . '/../LoginForm/Auth.php';

$db = (new Database())->connect();

$auth = new Auth($db);

if (!$auth->check()){
    header ("Location: ../LoginForm/login.php");
    exit;
}

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
                <!-- Dropdown menu at top right -->
                <div class="dropdown">
                    <button>⋮</button>
                    <div class="dropdown-content">
                        <a href="edit.php?id=<?php echo $post['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                    </div>
                </div>

                <!-- Student info -->
                <h3><?php echo htmlspecialchars($post['name']); ?></h3>
                <p>Email: <?php echo nl2br(htmlspecialchars($post['email'])); ?></p>
                <p>Course: <?php echo nl2br(htmlspecialchars($post['course'])); ?></p>
                <p>ID Number: <?php echo nl2br(htmlspecialchars($post['id_number'])); ?></p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No student record found.</p>
    <?php endif; ?>

    <br>
    <a href="../LoginForm/logout.php">Logout</a>
</div>

</body>
</html>
