<?php
session_start();
include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Get all user info in one query
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, email, phone, password 
                            FROM customers 
                            WHERE username = ?");
    $stmt->execute([$username]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($customer && password_verify($password, $customer['password'])) {
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['username'] = $username;

        // Store current user details
        $_SESSION['current_user'] = [
            'user_id' => $customer['id'],
            'username' => $username,
            'first_name' => $customer['first_name'],
            'last_name' => $customer['last_name'],
            'email' => $customer['email'],
            'phone' => $customer['phone']
        ];

        header("Location: landingpage.php");
        exit;
    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>

<?php if (!empty($error)) echo "<p>$error</p>"; ?>
