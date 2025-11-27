<?php
session_start();
require_once 'config.php';

// If already logged in, redirect to main page
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $username = mysqli_real_escape_string($dbConnection, trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');
    
    $errors = [];
    
    // Validation
    if (empty($username)) $errors[] = "Username is required";
    if (empty($password)) $errors[] = "Password is required";
    
    if (empty($errors)) {
        // Check credentials
        $stmt = $dbConnection->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                unset($_SESSION['errors']);
                header("Location: ../index.php");
                exit();
            } else {
                $errors[] = "Invalid username or password";
            }
        } else {
            $errors[] = "Invalid username or password";
        }
    }
    
    // Store errors and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: log_in.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - NatiX</title>
    <link rel="stylesheet" href="../Styles/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="../images/logo.jpg" alt="NatiX Logo" class="auth-logo">
                <h2>Welcome Back!</h2>
                <p>Login to your NatiX account</p>
            </div>

            <!-- Display Errors -->
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="error-box">
                    <i class="fas fa-exclamation-triangle"></i>
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Success message from signup -->
            <?php if (isset($_GET['success'])): ?>
                <div class="success-box">
                    <i class="fas fa-check-circle"></i> Registration successful! Please login.
                </div>
            <?php endif; ?>

            <form action="" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" 
                               placeholder="Enter your username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" 
                               placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="sign_up.php">Sign up here</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>