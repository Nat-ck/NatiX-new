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

            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i> Invalid username or password
                </div>
            <?php endif; ?>
            <form action="../php/log_in.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
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