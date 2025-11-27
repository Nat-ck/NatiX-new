<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn about NatiX sports betting coverage">
    <title>About Us - NatiX</title>
    <link rel="stylesheet" href="../Styles/about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>
    <header class="page-header">
        <div class="logo-context">
            <img class="logo" src="../images/logo.jpg" alt="NatiX logo">
            <h1><i>NatiX</i></h1>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="../index.php">Main</a></li>
                <li><a href="#" class="active">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
            
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="../php/my_bets.php"><i class="fas fa-ticket"></i> My Bets</a></li>
                    <li><a href="../php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="../php/sign_up.php">Sign Up</a></li>
                    <li><a href="../php/log_in.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="about-main">
        <!-- Hero Section -->
        <section class="hero-section">
            <img class="about-hero" src="../images/Betting.jewlery.jpg" alt="NatiX betting platform">
        </section>

        <!-- Coverage Section -->
        <section class="coverage-section">
            <h2><i class="fas fa-crosshairs"></i> What We Cover</h2>
            <div class="coverage-grid">
                <div class="coverage-item">
                    <i class="fas fa-futbol"></i>
                    <h3>Football</h3>
                    <p>Premier League, La Liga, Serie A, Bundesliga & more</p>
                </div>
                <div class="coverage-item">
                    <i class="fas fa-basketball-ball"></i>
                    <h3>Basketball</h3>
                    <p>NBA, EuroLeague & international tournaments</p>
                </div>
                <div class="coverage-item">
                    <i class="fas fa-table-tennis"></i>
                    <h3>Tennis</h3>
                    <p>ATP, WTA, Grand Slams</p>
                </div>
                <div class="coverage-item coming-soon">
                    <i class="fas fa-plus-circle"></i>
                    <h3>More Sports</h3>
                    <p>Coming Soon!</p>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section">
            <h2><i class="fas fa-users"></i> About NatiX</h2>
            <div class="about-content">
                <p>We provide simple, reliable, and <strong>real-time betting odds</strong> for your favorite sports events. Our platform is built for easy access to key match data, bookmaker prices, and expert insights.</p>
                <p>Whether you're a casual fan or serious bettor, NatiX gives you the information you need to make smart decisions. All odds are updated regularly from trusted sources.</p>
            </div>
        </section>
    </main>

    <footer class="page-footer">
        <p>&copy; 2025 NatiX BetSmart. All Rights Reserved.</p>
    </footer>
</body>
</html>