<?php

$pageTitle = 'All Users';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="page-header">
    <h1>User Management</h1>
    <?php if ($_SESSION['user_role'] === 'admin'): ?>
        <a href="index.php?page=user-create" class="btn btn-primary">+ New User</a>
    <?php endif; ?>
</div>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
                <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">No users found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>

                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>

                    <td>
                        <span class="badge badge-<?= $u['role'] ?>">
                            <?= $u['role'] ?>
                        </span>
                    </td>

                    <td><?= date('M d, Y', strtotime($u['created_at'])) ?></td>

                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                    <td class="actions">
                        <a href="index.php?page=user-edit&id=<?= $u['id'] ?>" class="btn btn-sm btn-secondary">Edit</a>

                        <?php if ($u['id'] !== $_SESSION['user_id']): ?>
                            <a
                                href="index.php?page=user-delete&id=<?= $u['id'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete <?= htmlspecialchars($u['name']) ?>?')"
                            >Delete</a>
                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>