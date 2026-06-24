# PHP MVC — User Management System

A clean, pure-PHP MVC project. No Laravel, no Symfony — just plain PHP + PDO + MySQL.

---

## Project Structure

```
php-mvc/
│
├── config/
│   └── database.php          ← DB connection (PDO)
│
├── app/
│   ├── models/
│   │   └── User.php          ← MODEL: all SQL lives here
│   │
│   ├── controllers/
│   │   ├── AuthController.php  ← CONTROLLER: login/logout/register
│   │   └── UserController.php  ← CONTROLLER: list/create/edit/delete
│   │
│   └── views/
│       ├── layouts/
│       │   ├── header.php    ← Shared navbar + <head>
│       │   └── footer.php    ← Shared </body>
│       ├── auth/
│       │   ├── login.php     ← VIEW: login form
│       │   └── register.php  ← VIEW: register form
│       └── users/
│           ├── index.php     ← VIEW: users table
│           ├── create.php    ← VIEW: create form
│           └── edit.php      ← VIEW: edit form
│
├── public/
│   ├── index.php             ← FRONT CONTROLLER (entry point)
│   └── css/style.css
│
└── setup.sql                 ← Run this first in phpMyAdmin
```

---

## How MVC flows — every request

```
Browser → public/index.php (router)
               ↓
          Controller (reads request, calls Model, picks View)
               ↓
            Model (SQL query, returns data)
               ↓
          Controller (passes data to View)
               ↓
             View (renders HTML)
               ↓
          Browser ← response
```

---

## Setup (XAMPP)

### Step 1 — Copy the project
Put the `php-mvc` folder inside your XAMPP `htdocs` folder:
```
C:\xampp\htdocs\php-mvc\
```

### Step 2 — Create the database
1. Start Apache and MySQL in XAMPP Control Panel
2. Open `http://localhost/phpmyadmin`
3. Click **SQL** tab
4. Paste the contents of `setup.sql` and click **Go**

### Step 3 — Open the app
```
http://localhost/php-mvc/public/
```

### Demo login
| Field    | Value              |
|----------|--------------------|
| Email    | admin@example.com  |
| Password | admin123           |

---

## Key PHP concepts (for Java/Spring devs)

| PHP concept           | Spring Boot equivalent            |
|-----------------------|-----------------------------------|
| `session_start()`     | `HttpSession`                     |
| `$_SESSION['user_id']`| `SecurityContext.getAuthentication()` |
| `password_hash()`     | `BCryptPasswordEncoder.encode()`  |
| `password_verify()`   | `BCryptPasswordEncoder.matches()` |
| PDO prepared statements| `JdbcTemplate` with `?` params   |
| `require_once`        | `import` / class loading          |
| `header("Location:")` | `return "redirect:/..."` in Spring|
| `htmlspecialchars()`  | Thymeleaf's `th:text` (auto-escaping)|
| `$_POST['field']`     | `@RequestParam` in Spring         |
| `$_GET['id']`         | `@PathVariable` / `@RequestParam` |
