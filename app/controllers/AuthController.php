<?php

class AuthController
{
    private User $userModel;

    public function __construct()
    {
        // Inject the Model — same idea as @Autowired in Spring
        $this->userModel = new User();
    }

    // GET /public/?page=login 
    public function login(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('users');
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);             

        require_once __DIR__ . '/../views/auth/login.php';
    }

    // POST /public/?page=login-submit
    public function loginSubmit(): void
    {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');

        // Basic validation
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Please fill in all fields.';
            $this->redirect('login');
            return;
        }

        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];

            $this->redirect('users');
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
            $this->redirect('login');
        }
    }

    // GET /public/?page=logout 
    public function logout(): void
    {
        // Wipe everything from the session, then destroy it
        $_SESSION = [];
        session_destroy();
        $this->redirect('login');
    }

    // GET /public/?page=register
    public function register(): void
    {
        if (isset($_SESSION['user_id'])) {
            $this->redirect('users');
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        require_once __DIR__ . '/../views/auth/register.php';
    }

    // POST /public/?page=register-submit
    public function registerSubmit(): void
    {
        $name     = trim($_POST['name']     ?? '');
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm']  ?? '');

        // Validation
        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error'] = 'All fields are required.';
            $this->redirect('register');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email address.';
            $this->redirect('register');
            return;
        }

        if ($password !== $confirm) {
            $_SESSION['error'] = 'Passwords do not match.';
            $this->redirect('register');
            return;
        }

        if (strlen($password) < 6) {
            $_SESSION['error'] = 'Password must be at least 6 characters.';
            $this->redirect('register');
            return;
        }

        if ($this->userModel->emailExists($email)) {
            $_SESSION['error'] = 'That email is already registered.';
            $this->redirect('register');
            return;
        }

        
        $this->userModel->create($name, $email, $password, 'user');
        $_SESSION['success'] = 'Account created! Please log in.';
        $this->redirect('login');
    }

    //Helper: redirect to a page 
    private function redirect(string $page): void
    {
        header("Location: index.php?page=$page");
        exit;  
    }
}