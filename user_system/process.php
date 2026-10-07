<?php
session_start();

$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "user_system";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    $_SESSION['auth_message'] = "We couldn't connect to the account database. Please try again.";
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

if (($_POST['action'] ?? '') === 'signup') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (strlen($username) < 3 || strlen($username) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254 || strlen($password) < 8) {
        $_SESSION['auth_message'] = "Enter a username (3-50 characters), a valid email, and a password of at least 8 characters.";
        header("Location: index.php?mode=signup");
        exit();
    }

    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['auth_message'] = "That username or email is already registered.";
        $check_stmt->close();
        $conn->close();
        header("Location: index.php?mode=signup");
        exit();
    }

    $check_stmt->close();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($insert_stmt->execute()) {
        $_SESSION['auth_message'] = "Account created. Log in with your new account to continue.";
        $insert_stmt->close();
        $conn->close();
        header("Location: index.php?mode=login");
        exit();
    }

    $_SESSION['auth_message'] = "We couldn't create your account. Please try again.";
    $insert_stmt->close();
    $conn->close();
    header("Location: index.php?mode=signup");
    exit();
}

if (($_POST['action'] ?? '') === 'login') {
    $input_user = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $input_user, $input_user);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $db_username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $db_username;
            $stmt->close();
            $conn->close();
            header("Location: mybrand.php");
            exit();
        }
    }

    $_SESSION['auth_message'] = "The username, email, or password you entered is incorrect.";
    $stmt->close();
    $conn->close();
    header("Location: index.php?mode=login");
    exit();
}

$conn->close();
header("Location: index.php");
exit();
?>
