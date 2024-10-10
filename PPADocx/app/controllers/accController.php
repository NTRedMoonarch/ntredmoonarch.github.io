<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error = '';
$message = '';

if (isset($_GET['page']) && $_GET['page'] === 'logout') {
    session_destroy();
    header('Location: ?page=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($role === 'administrator' && $username === 'admin' && $password === 'password') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'administrator';
        header('Location: ?page=home');
        exit;
    } elseif ($role === 'coordinator' && $username === 'coordinator' && $password === 'password') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'coordinator';
        header('Location: ?page=home');
        exit;
    } else {
        $error = 'Invalid username, password, or role.';
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'signup') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if ($password !== $confirmPassword) {
        $error = 'Passwords do not match.';
    } else {
        $message = 'Signup successful! You can now log in.';
    }
}

return [
    'error' => $error,
    'message' => $message,
];
