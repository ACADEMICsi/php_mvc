<?php
$pageTitle = 'Register';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="auth-box">
    <h1 class="auth-title">Create Account</h1>
    <p class="auth-subtitle">Register a new account</p>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="index.php?page=register-submit" method="POST" class="form">

        <div class="form-group">
            <label for="name">Full name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password <small>(min. 6 characters)</small></label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="confirm">Confirm password</label>
            <input type="password" id="confirm" name="confirm" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn btn-primary btn-full">Create Account</button>
    </form>

    <p class="auth-footer">Already have an account? <a href="index.php?page=login">Sign in</a></p>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>