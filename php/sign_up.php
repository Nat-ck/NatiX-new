<?php
session_start();
require_once 'config.php';

// Clear previous errors
unset($_SESSION['errors']);
unset($_SESSION['form_data']);

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store form data to repopulate fields if needed
    $_SESSION['form_data'] = $_POST;
    
    // Sanitize inputs
    $fullName = trim($_POST['Full_Name'] ?? '');
    $username = trim($_POST['Username'] ?? '');
    $email = trim($_POST['Email'] ?? '');
    $password = $_POST['Password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    $errors = [];
    
    // Validation logic
    if (empty($fullName)) $errors[] = "Full name is required";
    if (empty($username)) $errors[] = "Username is required";
    if (empty($email)) $errors[] = "Email is required";
    if (empty($password)) $errors[] = "Password is required";
    if ($password !== $confirmPassword) $errors[] = "Passwords do not match";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
    
    // Check if username/email exists
    if (empty($errors)) {
        $stmt = $dbConnection->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Username already exists";
        }
    }
    
    if (empty($errors)) {
        $stmt = $dbConnection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Email already registered";
        }
    }
    
    // If no errors, create user
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $dbConnection->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullName, $username, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            // Success - Clear session and redirect
            unset($_SESSION['errors']);
            unset($_SESSION['form_data']);
            header("Location: log_in.php?success=1");
            exit();
        } else {
            $errors[] = "Database error: Could not create account";
        }
    }
    
    // If errors exist, store in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: sign_up.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - NatiX</title>
    <link rel="stylesheet" href="../Styles/auth.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <img src="../images/logo.jpg" alt="NatiX Logo" class="auth-logo">
                <h2>Create Account</h2>
                <p>Join NatiX for the best odds</p>
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

            <form action="" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="Full_Name">Full Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="Full_Name" name="Full_Name" 
                               value="<?php echo htmlspecialchars($_SESSION['form_data']['Full_Name'] ?? ''); ?>"
                               placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-circle"></i>
                        <input type="text" id="Username" name="Username" 
                               value="<?php echo htmlspecialchars($_SESSION['form_data']['Username'] ?? ''); ?>"
                               placeholder="Choose a username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="Email" name="Email" 
                               value="<?php echo htmlspecialchars($_SESSION['form_data']['Email'] ?? ''); ?>"
                               placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="Password" name="Password" 
                               placeholder="Create a password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm-password" name="confirm_password" 
                               placeholder="Confirm your password" required>
                    </div>
                </div>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Sign Up
                </button>

                <div class="auth-footer">
                    <p>Already have an account? <a href="log_in.php">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>