<?php
$pageTitle = 'Edit User';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="page-header">
    <h1>Edit User</h1>
    <a href="index.php?page=users" class="btn btn-secondary">← Back</a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="card card-form">
    <form action="index.php?page=user-update" method="POST" class="form">

        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="form-group">
            <label for="name">Full name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?= htmlspecialchars($user['name']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= htmlspecialchars($user['email']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">New password <small>(leave blank to keep current)</small></label>
            <input type="password" id="password" name="password" placeholder="••••••••">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
        
                <option value="user"  <?= $user['role'] === 'user'  ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="index.php?page=users" class="btn btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>