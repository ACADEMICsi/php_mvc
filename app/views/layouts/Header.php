<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'UserManager') ?></title>
    <link rel="stylesheet" href="/../../../public/style.css">
</head>
<body>

<nav class="navbar">
    <div class="nav-brand">UserManager</div>
    <div class="nav-links">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="nav-user">
                👤 <?= htmlspecialchars($_SESSION['user_name']) ?>
                <span class="badge badge-<?= $_SESSION['user_role'] ?>">
                    <?= $_SESSION['user_role'] ?>
                </span>
            </span>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="index.php?page=users">All Users</a>
                <a href="index.php?page=user-create">+ New User</a>
            <?php endif; ?>
            <a href="index.php?page=logout" class="btn-logout">Logout</a>
        <?php else: ?>
            <a href="index.php?page=login">Login</a>
            <a href="index.php?page=register">Register</a>
        <?php endif; ?>
    </div>
</nav>

<main class="container">