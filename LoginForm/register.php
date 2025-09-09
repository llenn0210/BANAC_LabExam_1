<?php

require_once __DIR__ . '/../Database.php';
require  'Auth.php';


$db = (new Database())->connect();
$auth = new Auth($db);


$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($auth->register($email, $password)) {
        header("Location: login.php");
        exit;
    }else {
        $message = "Registration failed. Try again.";

    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class = "card">
        <h2>Register</h2>
        <form method = "post">
            <input type="email" name= "email" placeholder="Email" required><br></br>
            <input type="password" name = "password" placeholder="Password" required><br>
            <button type= "submit">Register</button><br></br>
        </form>

        <p> <?php echo $message;?></p>
        <a href = "login.php">Back to Login</a>
        

    </div>



</body>
</html>