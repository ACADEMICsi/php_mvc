<?php
$pageTitle = 'New User';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="page-header">
    <h1>Create New User</h1>
    <a href="index.php?page=users" class="btn btn-secondary">← Back</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="card card-form">
    <form action="index.php?page=user-store" method="POST" class="form">

        <div class="form-group">
            <label for="name">Full name</label>
            <input type="text" id="name" name="name" placeholder="Jane Doe" required>
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="jane@example.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="index.php?page=users" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>