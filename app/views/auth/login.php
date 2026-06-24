<?php

$pageTitle = 'Login';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="auth-box">
    <h1 class="auth-title">Welcome back</h1>
    <p class="auth-subtitle">Sign in to manage users</p>

    <?php if (!empty($error)): ?>
        <!-- htmlspecialchars() escapes output to prevent XSS attacks -->
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form action="index.php?page=login-submit" method="POST" class="form">

        <div class="form-group">
            <label for="email">Email address</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="admin@example.com"
                required
                autocomplete="email"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="••••••••"
                required
                autocomplete="current-password"
            >
        </div>

        <button type="submit" class="btn btn-primary btn-full">Sign in</button>
    </form>

    <p class="auth-footer">No account? <a href="index.php?page=register">Register here</a></p>

    <div class="hint-box">
        <strong>Demo credentials:</strong><br>
        Email: admin@example.com<br>
        Password: admin123
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>