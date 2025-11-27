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

            <?php if (isset($_GET['errors'])): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> 
                        <?php echo htmlspecialchars($_GET['errors']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_GET['registered'])): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> Registration successful! Please login.
                    </div>
                <?php endif; ?>
            <form action="../php/sign_up.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="Full_Name">Full Name</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input type="text" id="Full_Name" name="Full_Name" placeholder="Enter your full name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Username">Username</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user-circle"></i>
                        <input type="text" id="Username" name="Username" placeholder="Choose a username" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Email">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="Email" name="Email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="Password" name="Password" placeholder="Create a password" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm your password" required>
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