<?php

session_start();
require_once __DIR__ . '/../Database.php';
class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    //register user
    public function register($email, $password) {

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users (email , password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['email' => $email, 'password' => $hashed_password]);

    }

    //login user
    public function login($email, $password) {
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            return true;
        } else {
            return false;
        }
    }

    //check if user is logged in
    public function check(){
        return isset($_SESSION['user_email']);
    }

    //get the current email
    public function user(){
        return $_SESSION['user_email'] ?? null;
    }

    //logout student
    public function logout() {
        session_destroy();
    }
}




?>