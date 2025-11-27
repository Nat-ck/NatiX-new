<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - NatiX</title>
    <link rel="stylesheet" href="../Styles/contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <header class="page-header">
        <div class="header-left">
            <img class="logo" src="../images/logo.jpg" alt="NatiX Logo">
            <h1><i>NatiX</i></h1>
        </div>
        
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- NAVIGATION MENU -->
        <nav class="page-nav" id="pageNav">
            <ul>
                <li><a href="../index.php">Main</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="#" class="active">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../php/my_bets.php"><i class="fas fa-ticket"></i> My Bets</a></li>
                    <li><a href="../php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="../php/sign_up.php">Sign Up</a></li>
                    <li><a href="../php/log_in.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <main class="contact-main">
        <section class="contact-intro">
            <h2><i class="fas fa-headset"></i> Get In Touch</h2>
            <p>Have questions or suggestions? We're here to help!</p>
        </section>

        <div class="contact-container">
            <section class="contact-info">
                <h3><i class="fas fa-envelope"></i> Contact Details</h3>
                <ul class="contact-list">
                    <li>
                        <i class="fas fa-envelope-open"></i>
                        <div>
                            <strong>Email:</strong><br>
                            <a href="mailto:support@natix.com">support@natix.com</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Phone:</strong><br>
                            <a href="tel:+251984148907">+251 984 148 907</a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Location:</strong><br>
                            Addis Ababa, Ethiopia
                        </div>
                    </li>
                </ul>

                <h3><i class="fas fa-clock"></i> Hours</h3>
                <p class="hours">24/7 Online Support</p>
            </section>

            <section class="social-section">
                <h3><i class="fas fa-share-alt"></i> Follow Us</h3>
                <div class="social-links">
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="social-btn instagram">
                        <i class="fab fa-instagram"></i>
                        <span>Instagram</span>
                    </a>
                    <a href="#" class="social-btn youtube">
                        <i class="fab fa-youtube"></i>
                        <span>YouTube</span>
                    </a>
                </div>
            </section>
        </div>
    </main>

    <footer class="page-footer">
        <p>&copy; 2025 NatiX BetSmart. All Rights Reserved.</p>
    </footer>

    <script>
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('mobileMenuToggle');
            const nav = document.getElementById('pageNav');
            
            if (toggle && nav) {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    nav.classList.toggle('active');
                });
                
                document.addEventListener('click', function(e) {
                    if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                        nav.classList.remove('active');
                    }
                });
            }
        });
    </script>
</body>
</html>