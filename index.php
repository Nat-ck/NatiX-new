<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NatiX | Live Betting Odds</title>
    <link rel="stylesheet" href="./Styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="bet-slip-overlay" id="betSlipOverlay"></div>
    
    <aside class="bet-slip" id="betSlip">
        <div class="bet-slip-header">
            <h3><i class="fas fa-ticket-alt"></i> Bet Slip</h3>
            <button class="close-slip" onclick="closeBetSlip()">&times;</button>
        </div>
        <div id="betSelections"></div>
        <div class="bet-slip-inputs">
            <input type="number" id="stakeAmount" placeholder="Enter stake ($)" min="1">
            <div class="bet-slip-total">
                <span>Total Odds:</span>
                <span id="totalOdds">0.00</span>
            </div>
            <div class="bet-slip-total">
                <span>Potential Win:</span>
                <span class="potential-win" id="potentialWin">$0.00</span>
            </div>
            <form action="php/my_bets.php" method="POST">
                <input type="hidden" name="bet_data" id="betDataInput">
                <input type="hidden" name="stake" id="stakeInput">
                <button type="submit" class="place-bets-btn" id="placeBetsBtn" disabled>
                    Place Bet
                </button>
            </form>
        </div>
    </aside>

    <!-- Header -->
    <header class="main-header">
        <div class="logo-context">
            <img class="logo" src="./images/logo.jpg" alt="NatiX Logo">
            <h1><i>NatiX</i></h1>
        </div>
        
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        
        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="#" class="active">Main</a></li>
                <li><a href="./templates/about.php">About</a></li>
                <li><a href="./templates/contact.php">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="./php/my_bets.php"><i class="fas fa-ticket"></i> My Bets</a></li>
                    <li><a href="./php/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="./php/sign_up.php">Sign Up</a></li>
                    <li><a href="./php/log_in.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="header-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                </div>
            <?php endif; ?>
            
            <div class="language-selector">
                <i class="fas fa-globe"></i>
                <select id="language">
                    <option value="en">English</option>
                    <option value="am">አማርኛ</option>
                </select>
            </div>
        </div>
    </header>

    <!-- Hero Carousel -->
    <section class="hero-section">
        <div class="slideshow-container">
            <div class="slide active">
                <img src="./images/Betting.jewlery.jpg" alt="Betting Promotions">
            </div>
            <div class="slide">
                <img src="./images/Casino-img.jpg" alt="Casino Games">
            </div>
            <div class="slide">
                <img src="./images/Dollar-img.jpg" alt="Win Big">
            </div>
            <button class="prev" onclick="changeSlide(-1)">❮</button>
            <button class="next" onclick="changeSlide(1)">❯</button>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-section">
                <h2><i class="fas fa-bolt"></i> Quick Menu</h2>
                <ul>
                    <li><a href="./php/my_bets.php"><i class="fas fa-ticket"></i> My Bets</a></li>
                    <li><a href="#"><i class="fas fa-futbol"></i> Live Scores</a></li>
                    <li><a href="#"><i class="fas fa-trophy"></i> Top Leagues</a></li>
                </ul>
            </div>

            <div class="sidebar-section">
                <h2><i class="fas fa-newspaper"></i> Latest News</h2>
                <article class="news-item">
                    <h4>Man City Signs New Striker</h4>
                    <p>Big signing ahead of derby clash...</p>
                </article>
                <article class="news-item">
                    <h4>Champions League Draw</h4>
                    <p>Quarter-final matchups announced!</p>
                </article>
            </div>

            <div class="sidebar-section">
                <h2><i class="fas fa-info-circle"></i> Information</h2>
                <ul class="info-list">
                    <li>✅ 18+ only - Gamble responsibly</li>
                    <li>✅ Odds updated every 5 minutes</li>
                    <li>✅ Verify bets before confirming</li>
                    <li>✅ Info only - No real money</li>
                    <li>✅ Contact support for help</li>
                </ul>
            </div>
        </aside>

        <!-- Betting Section -->
        <section class="betting-area">
            <h1 class="section-title"><i class="fas fa-chart-line"></i> Live Odds</h1>
            
            <!-- Match Cards -->
            <div class="match-grid">
                <!-- Match Card 1 -->
                <article class="match-card">
                    <header class="match-header">
                        <span class="league">Premier League</span>
                        <span class="time">15 Aug 21:45</span>
                    </header>
                    <div class="match-teams">
                        <div class="team">
                            <img src="./images/Manutd-logo.jpg" alt="Man Utd" class="team-logo">
                            <span>Man Utd</span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <img src="./images/Chelsea-logo.jpg" alt="Chelsea" class="team-logo">
                            <span>Chelsea</span>
                        </div>
                    </div>
                    <div class="odds-container">
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Man Utd vs Chelsea', 'Man Utd', '3.75', '1')">
                            <span class="odd-label">1</span>
                            <span class="odd-value">3.75</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Man Utd vs Chelsea', 'Draw', '3.40', 'X')">
                            <span class="odd-label">X</span>
                            <span class="odd-value">3.40</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Man Utd vs Chelsea', 'Chelsea', '2.10', '2')">
                            <span class="odd-label">2</span>
                            <span class="odd-value">2.10</span>
                        </button>
                    </div>
                </article>

                <!-- Match Card 2 -->
                <article class="match-card">
                    <header class="match-header">
                        <span class="league">La Liga</span>
                        <span class="time">16 Aug 20:00</span>
                    </header>
                    <div class="match-teams">
                        <div class="team">
                            <img src="./images/RealMadrid-logo.jpg" alt="Real Madrid" class="team-logo">
                            <span>Real Madrid</span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <img src="./images/Barcelona-logo.jpg" alt="Barcelona" class="team-logo">
                            <span>Barcelona</span>
                        </div>
                    </div>
                    <div class="odds-container">
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Real Madrid vs Barcelona', 'Real Madrid', '2.30', '1')">
                            <span class="odd-label">1</span>
                            <span class="odd-value">2.30</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Real Madrid vs Barcelona', 'Draw', '3.50', 'X')">
                            <span class="odd-label">X</span>
                            <span class="odd-value">3.50</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Real Madrid vs Barcelona', 'Barcelona', '3.00', '2')">
                            <span class="odd-label">2</span>
                            <span class="odd-value">3.00</span>
                        </button>
                    </div>
                </article>

                <!-- Match Card 3 -->
                <article class="match-card">
                    <header class="match-header">
                        <span class="league">Premier League</span>
                        <span class="time">30 Nov 17:05</span>
                    </header>
                    <div class="match-teams">
                        <div class="team">
                            <img src="./images/liverpool-logo.jpg" alt="Liverpool" class="team-logo">
                            <span>Liverpool</span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <img src="./images/west-ham-logo.png" alt="West Ham" class="team-logo">
                            <span>West Ham</span>
                        </div>
                    </div>
                    <div class="odds-container">
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Liverpool vs West Ham', 'Liverpool', '1.67', '1')">
                            <span class="odd-label">1</span>
                            <span class="odd-value">1.67</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Liverpool vs West Ham', 'Draw', '4.40', 'X')">
                            <span class="odd-label">X</span>
                            <span class="odd-value">4.40</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Liverpool vs West Ham', 'West Ham', '4.90', '2')">
                            <span class="odd-label">2</span>
                            <span class="odd-value">4.90</span>
                        </button>
                    </div>
                </article>

                <!-- Match Card 4 -->
                <article class="match-card">
                    <header class="match-header">
                        <span class="league"> Champions League</span>
                        <span class="time">25 Nov 23:00</span>
                    </header>
                    <div class="match-teams">
                        <div class="team">
                            <img src="./images/mancity-logo.png" alt="Manchester City" class="team-logo">
                            <span>Manchester City</span>
                        </div>
                        <div class="vs">VS</div>
                        <div class="team">
                            <img src="./images/leverkusen-logo.png" alt="Leverkusen" class="team-logo">
                            <span>Leverkusen</span>
                        </div>
                    </div>
                    <div class="odds-container">
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Manchester City vs Leverkusen', 'Manchester City', '1.29', '1')">
                            <span class="odd-label">1</span>
                            <span class="odd-value">1.29</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Manchester City vs Leverkusen', 'Draw', '6.60', 'X')">
                            <span class="odd-label">X</span>
                            <span class="odd-value">6.60</span>
                        </button>
                        <button type="button" class="odd-btn" onclick="addToBetSlip('Manchester City vs Leverkusen', 'Leverkusen', '9.60', '2')">
                            <span class="odd-label">2</span>
                            <span class="odd-value">9.60</span>
                        </button>
                    </div>
                </article>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="main-footer">
        <p>&copy; 2025 NatiX BetSmart. All Rights Reserved.</p>
    </footer>

    <script>
        // BET SLIP FUNCTIONALITY
        let betSlip = [];
        
        function addToBetSlip(match, selection, odd, code) {
            // Check if already exists
            const exists = betSlip.some(bet => bet.match === match && bet.selection === selection);
            if (exists) {
                alert('This selection is already in your bet slip!');
                return;
            }
            
            betSlip.push({ match, selection, odd: parseFloat(odd), code });
            updateBetSlipDisplay();
            openBetSlip();
            
            // Visual feedback
            event.target.style.background = 'var(--accent-color)';
            event.target.style.color = 'var(--primary-bg)';
        }
        
        function removeFromBetSlip(index) {
            betSlip.splice(index, 1);
            updateBetSlipDisplay();
        }
        
        function updateBetSlipDisplay() {
            const container = document.getElementById('betSelections');
            const totalOdds = document.getElementById('totalOdds');
            const potentialWin = document.getElementById('potentialWin');
            const placeBtn = document.getElementById('placeBetsBtn');
            const stakeInput = document.getElementById('stakeAmount');
            
            if (betSlip.length === 0) {
                container.innerHTML = '<p style="color: var(--text-secondary); text-align: center;">No selections</p>';
                totalOdds.textContent = '0.00';
                potentialWin.textContent = '$0.00';
                placeBtn.disabled = true;
                return;
            }
            
            let html = '';
            betSlip.forEach((bet, index) => {
                html += `
                    <div class="bet-selection">
                        <div class="bet-selection-header">
                            <h4>${bet.match}</h4>
                            <button class="remove-selection" onclick="removeFromBetSlip(${index})">&times;</button>
                        </div>
                        <p>${bet.selection} <span class="bet-selection-odd">@ ${bet.odd}</span></p>
                    </div>
                `;
            });
            
            container.innerHTML = html;
            
            // Calculate totals
            const totalOddsValue = betSlip.reduce((acc, bet) => acc * bet.odd, 1).toFixed(2);
            totalOdds.textContent = totalOddsValue;
            
            const stake = parseFloat(stakeInput.value) || 0;
            const win = (stake * totalOddsValue).toFixed(2);
            potentialWin.textContent = `$${win}`;
            
            placeBtn.disabled = stake <= 0;
            
            // Update hidden inputs for form submission
            document.getElementById('betDataInput').value = JSON.stringify(betSlip);
            document.getElementById('stakeInput').value = stake;
        }
        
        function openBetSlip() {
            document.getElementById('betSlip').classList.add('active');
            document.getElementById('betSlipOverlay').classList.add('active');
        }
        
        function closeBetSlip() {
            document.getElementById('betSlip').classList.remove('active');
            document.getElementById('betSlipOverlay').classList.remove('active');
        }
        
        // Stake input change handler
        document.getElementById('stakeAmount').addEventListener('input', updateBetSlipDisplay);
        
        // Overlay click to close
        document.getElementById('betSlipOverlay').addEventListener('click', closeBetSlip);
        
        // Mobile Menu Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('mobileMenuToggle');
            const nav = document.getElementById('mainNav');
            
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

        // Carousel Script
        let slideIndex = 0;
        const slides = document.querySelectorAll('.slide');
        
        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
        }
        
        function changeSlide(direction) {
            slideIndex += direction;
            if (slideIndex >= slides.length) slideIndex = 0;
            if (slideIndex < 0) slideIndex = slides.length - 1;
            showSlide(slideIndex);
        }
        
        setInterval(() => {
            changeSlide(1);
        }, 4000);
    </script>
</body>
</html>