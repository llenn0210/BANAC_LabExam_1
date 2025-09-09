<?php

class Functions {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new student record
    public function create($id, $name, $email, $course, $id_number) {
        $sql = "INSERT INTO student (id, name, email, course, id_number) 
                VALUES (:id, :name, :email, :course, :id_number)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'course' => $course,
            'id_number' => $id_number
        ]);
    }

    // Get all students
    public function getAll() {
        $sql = "SELECT * FROM student ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get student by ID
    public function getById($id) {
        $sql = "SELECT * FROM student WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update student record
    public function update($id, $name, $email, $course, $id_number) {
        $sql = "UPDATE student 
                SET name = :name, email = :email, course = :course, id_number = :id_number
                WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'course' => $course,
            'id_number' => $id_number
        ]);
    }

    // Delete student
    public function delete($id) {
        $sql = "DELETE FROM student WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
