<?php

class UserController
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // GET ?page=users  →  List all users 
    public function index(): void
    {
        $this->requireLogin();  

        $users = $this->userModel->all();

        $success = $_SESSION['success'] ?? null;
        $error   = $_SESSION['error']   ?? null;
        unset($_SESSION['success'], $_SESSION['error']);

     
        require_once __DIR__ . '/../views/users/index.php';
    }

    //GET ?page=user-create  Show "create user" form 
    public function create(): void
    {
        $this->requireAdmin();

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        require_once __DIR__ . '/../views/users/create.php';
    }

    //POST ?page=user-store  Save new user
    public function store(): void
    {
        $this->requireAdmin();

        $name     = trim($_POST['name']     ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');
        $role     = $_POST['role'] ?? 'user';

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('user-create');
            return;
        }

        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = 'Email already exists.';
            $this->redirect('user-create');
            return;
        }

        $this->userModel->create($name, $email, $password, $role);
        $_SESSION['success'] = "User '$name' created successfully.";
        $this->redirect('users');
    }

    //GET ?page=user-edit&id=5 Show edit form
    public function edit(): void
    {
        $this->requireAdmin();

        $id   = (int)($_GET['id'] ?? 0);
        $user = $this->userModel->findById($id);

        if (!$user) {
            $_SESSION['error'] = 'User not found.';
            $this->redirect('users');
            return;
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        require_once __DIR__ . '/../views/users/edit.php';
    }

    //POST ?page=user-update Save edits
    public function update(): void
    {
        $this->requireAdmin();

        $id    = (int)($_POST['id']    ?? 0);
        $name  = trim($_POST['name']   ?? '');
        $email = trim($_POST['email']  ?? '');
        $role  = $_POST['role'] ?? 'user';

        if (empty($name) || empty($email)) {
            $_SESSION['error'] = 'Name and email are required.';
            $this->redirect("user-edit&id=$id");
            return;
        }

        $this->userModel->update($id, $name, $email, $role);

        // If a new password was provided, update it separately
        $newPassword = trim($_POST['password'] ?? '');
        if (!empty($newPassword)) {
            $this->userModel->updatePassword($id, $newPassword);
        }

        $_SESSION['success'] = 'User updated successfully.';
        $this->redirect('users');
    }

    //GET ?page=user-delete&id=5 Delete a user
    public function delete(): void
    {
        $this->requireAdmin();

        $id = (int)($_GET['id'] ?? 0);

        if ($id === (int)$_SESSION['user_id']) {
            $_SESSION['error'] = 'You cannot delete your own account.';
            $this->redirect('users');
            return;
        }

        $this->userModel->delete($id);
        $_SESSION['success'] = 'User deleted.';
        $this->redirect('users');
    }

    //Guards

    private function requireLogin(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('login');
        }
    }

    private function requireAdmin(): void
    {
        $this->requireLogin();
        if ($_SESSION['user_role'] !== 'admin') {
            http_response_code(403);
            die("<h1>403 Forbidden — Admins only</h1>");
        }
    }

    private function redirect(string $page): void
    {
        header("Location: index.php?page=$page");
        exit;
    }
}