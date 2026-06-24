<?php

class User 
{
    private PDO $db;

    public function __construct() {
        $this->db = getDB();
    } 

    //get all users
    public function all(): array {
        $stmt = $this->db->query("SELECT id, name, email, role, created_at FROM users ORDER BY id DESC");
        return $stmt->fetchAll();
    } 

    //get one user by id
    public function findById(int $id): array|false {
        $stmt = $this->db->prepare("SELECT id, name, email, role FROM users WHERE id = ?");
        $stmt-> excute([$id]);
        return $stmt->fecth();
    }

    //get user by email
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    } 

    //CREATE: insert a new user
    public function create(string $name, string $email, string $password, string $role = 'user'): bool
    {
        // password_hash() = bcrypt hashing. Like BCryptPasswordEncoder in Spring Security.
        // NEVER store plain-text passwords.
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
 
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$name, $email, $hashedPassword, $role]);
    }
 
    //UPDATE: change user details
    public function update(int $id, string $name, string $email, string $role): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $email, $role, $id]);
    }
 
    // UPDATE: change password only
    public function updatePassword(int $id, string $newPassword): bool
    {
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$hashed, $id]);
    }
 
    // DELETE: remove a user 
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
 
    //HELPER: check if email is already registered
    public function emailExists(string $email): bool
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }


}