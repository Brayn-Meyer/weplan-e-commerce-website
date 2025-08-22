<?php
session_start();
include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $passwordHash = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Insert new customer
    $stmt = $pdo->prepare("
        INSERT INTO customers (first_name, last_name, username, password, email, phone)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$first_name, $last_name, $username, $passwordHash, $email, $phone]);

    // Get the new customer ID
    $customer_id = $pdo->lastInsertId();

    // Store customer info in session
    $_SESSION['customer_id'] = $customer_id;
    $_SESSION['username'] = $username;

    echo "Account created and logged in as $username! <a href='landingpage.php'>Go book a trip</a>";
}
?>

<form method="post">
    First Name: <input type="text" name="first_name" required><br>
    Last Name: <input type="text" name="last_name" required><br>
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Email: <input type="text" name="email" required><br>
    Phone: <input type="text" name="phone" required><br>
    <button type="submit">Register</button>
</form>
