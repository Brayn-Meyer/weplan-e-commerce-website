<?php
session_start();
include "includes/db.php";

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: landingpage.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // LOGIN (NO CHANGES HERE)
    if (isset($_POST['login'])) {
        $username = trim($_POST['login_username']);
        $password = $_POST['login_password'];

        $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, phone, password FROM customers WHERE username = ?");
        $stmt->execute([$username]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer && password_verify($password, $customer['password'])) {
            $_SESSION['customer_id'] = $customer['id'];
            $_SESSION['username'] = $username;
            $_SESSION['current_user'] = [
                'user_id' => $customer['id'],
                'username' => $username,
                'first_name' => $customer['first_name'],
                'last_name' => $customer['last_name'],
                'email' => $customer['email'],
                'phone' => $customer['phone']
            ];
            $_SESSION['user'] = [
                'id' => $customer['id'],
                'username' => $username,
                'firstname' => $customer['first_name'],
                'lastname' => $customer['last_name'],
                'email' => $customer['email'],
                'phone' => $customer['phone']
            ];
            header("Location: landingpage.php");
            exit;
        } else {
            $loginError = "Invalid username or password";
        }
    }
    // SIGNUP
    elseif (isset($_POST['signup'])) {
        $first_name = trim($_POST['signup_firstname']);
        $last_name = trim($_POST['signup_lastname']);
        $username = trim($_POST['signup_username']);
        $password = $_POST['signup_password'];
        $email = trim($_POST['signup_email']);
        $phone = trim($_POST['signup_phone']);

        // Check if username exists
        $stmt = $pdo->prepare("SELECT id FROM customers WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $signupError = "Username already exists";
        } else {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO customers (first_name, last_name, username, password, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $username, $passwordHash, $email, $phone]);
            $customer_id = $pdo->lastInsertId();
            
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['username'] = $username;
            $_SESSION['current_user'] = [
                'user_id' => $customer_id,
                'username' => $username,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone
            ];
            $_SESSION['user'] = [
                'id' => $customer_id,
                'username' => $username,
                'firstname' => $first_name,
                'lastname' => $last_name,
                'email' => $email,
                'phone' => $phone
            ];
            header("Location: landingpage.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Login | WePlan Travel</title>
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 2rem;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }
        .login-header {
            padding: 1.5rem;
            color: white;
            background: linear-gradient(to right, #ec4899, #f43f5e);
            text-align: center;
        }
        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        .login-body {
            padding: 2rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #4b5563;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: #ec4899;
            box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
        }
        .btn-login {
            width: 100%;
            padding: 1rem;
            border-radius: 1rem;
            font-weight: 600;
            color: white;
            text-align: center;
            background: linear-gradient(to right, #ec4899, #f43f5e);
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .btn-login:hover {
            background: linear-gradient(to right, #db2777, #e11d48);
            transform: translateY(-2px);
        }
        .switch-form {
            text-align: center;
            margin-top: 1rem;
            color: #4b5563;
        }
        .switch-link {
            color: #ec4899;
            font-weight: 600;
            text-decoration: none;
        }
        .error-message {
            color: #e11d48;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include "includes/header.php"; ?>
    <div class="login-container">
        <div class="login-box">
            <?php if (isset($_GET['action']) && $_GET['action'] === 'signup'): ?>
                <!-- Signup Form -->
                <div class="login-header">
                    <h3 class="login-title">Create Account</h3>
                </div>
                <div class="login-body">
                    <?php if (isset($signupError)): ?>
                        <div class="error-message"><?php echo $signupError; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="signup_firstname" class="form-label">First Name</label>
                            <input type="text" id="signup_firstname" name="signup_firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_lastname" class="form-label">Last Name</label>
                            <input type="text" id="signup_lastname" name="signup_lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_username" class="form-label">Username</label>
                            <input type="text" id="signup_username" name="signup_username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_password" class="form-label">Password</label>
                            <input type="password" id="signup_password" name="signup_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_email" class="form-label">Email</label>
                            <input type="email" id="signup_email" name="signup_email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="signup_phone" class="form-label">Phone</label>
                            <input type="text" id="signup_phone" name="signup_phone" class="form-control" required>
                        </div>
                        <button type="submit" name="signup" class="btn-login">Sign Up</button>
                    </form>
                    <div class="switch-form">
                        Already have an account? <a href="login.php" class="switch-link">Login</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Login Form -->
                <div class="login-header">
                    <h3 class="login-title">Welcome Back</h3>
                </div>
                <div class="login-body">
                    <?php if (isset($loginError)): ?>
                        <div class="error-message"><?php echo $loginError; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group">
                            <label for="login_username" class="form-label">Username</label>
                            <input type="text" id="login_username" name="login_username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="login_password" class="form-label">Password</label>
                            <input type="password" id="login_password" name="login_password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn-login">Login</button>
                    </form>
                    <div class="switch-form">
                        Don't have an account? <a href="login.php?action=signup" class="switch-link">Sign Up</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include "includes/footer.php"; ?>
</body>
</html>
