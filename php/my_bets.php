<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: log_in.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$bet_data = $_POST['bet_data'] ?? '[]';
$bet_slip = json_decode($bet_data, true);

if (empty($bet_slip)) {
    header("Location: ../index.php");
    exit();
}

$total_odds = array_reduce($bet_slip, function($acc, $bet) {
    return $acc * $bet['odd'];
}, 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_bets'])) {
    $stake = floatval($_POST['stake']);
    $potential_win = $stake * $total_odds;
    $success_message = "Bet placed successfully! (Demo mode)";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bets - NatiX</title>
    <link rel="stylesheet" href="../Styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .bets-container { max-width: 1200px; margin: 2rem auto; padding: 0 2rem; }
        .bets-header { background: linear-gradient(145deg, #1a1a2e, #151525); color: var(--accent-color); padding: 2rem; border-radius: 15px; margin-bottom: 2rem; border: 1px solid var(--border-color); }
        .bet-confirmation { background: var(--card-bg); border-radius: 15px; padding: 2rem; border: 1px solid var(--border-color); margin-bottom: 2rem; }
        .bet-item { background: rgba(0, 255, 136, 0.05); border-left: 4px solid var(--accent-color); padding: 1rem; margin-bottom: 1rem; border-radius: 8px; }
        .bet-summary { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color); }
        .summary-box { background: rgba(0, 255, 136, 0.1); padding: 1.5rem; border-radius: 8px; text-align: center; }
        .summary-box p { color: var(--accent-color); font-size: 1.5rem; font-weight: bold; }
        .btn-confirm { background: linear-gradient(to right, var(--accent-color), #00ccff); color: var(--primary-bg); padding: 1rem 3rem; border: none; border-radius: 8px; font-weight: bold; font-size: 1.1rem; cursor: pointer; }
        .success-message { background: rgba(0, 255, 136, 0.2); border-left: 4px solid var(--accent-color); padding: 1rem; margin-bottom: 2rem; border-radius: 8px; color: var(--accent-color); }
    </style>
</head>
<body>
    <header class="main-header">
        <nav class="main-nav" id="mainNav">
            <ul>
                <li><a href="../index.php" >Main</a></li>
            </ul>
        </nav>
    </header>

    <main class="bets-container">
        <?php if (isset($success_message)): ?>
            <div class="success-message">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <div class="bets-header">
            <h1><i class="fas fa-ticket-alt"></i> Bet Confirmation</h1>
            <p>Review your selections before placing bet</p>
        </div>

        <div class="bet-confirmation">
            <h3 style="color: var(--accent-color); margin-bottom: 1.5rem;">
                <i class="fas fa-list"></i> Your Selections (<?php echo count($bet_slip); ?>)
            </h3>
            
            <?php foreach ($bet_slip as $bet): ?>
                <div class="bet-item">
                    <h4><?php echo htmlspecialchars($bet['match']); ?></h4>
                    <p>Selection: <strong><?php echo htmlspecialchars($bet['selection']); ?></strong> (Code: <?php echo htmlspecialchars($bet['code']); ?>) - Odd: <span style="color: var(--accent-color); font-weight: bold;">@ <?php echo $bet['odd']; ?></span></p>
                </div>
            <?php endforeach; ?>

            <div class="bet-summary">
                <div class="summary-box">
                    <h3>Total Odds</h3>
                    <p><?php echo number_format($total_odds, 2); ?></p>
                </div>
                <div class="summary-box">
                    <h3>Stake</h3>
                    <p>$<?php echo number_format($_POST['stake'] ?? 0, 2); ?></p>
                </div>
                <div class="summary-box">
                    <h3>Potential Win</h3>
                    <p>$<?php echo number_format(($_POST['stake'] ?? 0) * $total_odds, 2); ?></p>
                </div>
            </div>

            <form method="POST" class="confirm-form">
                <input type="hidden" name="confirm_bets" value="1">
                <input type="hidden" name="stake" value="<?php echo htmlspecialchars($_POST['stake'] ?? 0); ?>">
                <input type="hidden" name="bet_data" value="<?php echo htmlspecialchars($bet_data); ?>">
                <button type="submit" class="btn-confirm">
                    <i class="fas fa-check-circle"></i> Confirm & Place Bet
                </button>
            </form>
            <?php
            if (isset($_POST['confirm_bets'])) {
                echo '<script>alert("Bet placed successfully!"); window.location.href = "../index.php";</script>';
            }
            ?>
        </div>
    </main>

    <footer class="main-footer">
        <p>&copy; 2025 NatiX BetSmart. All Rights Reserved.</p>
    </footer>
</body>
</html>