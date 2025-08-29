<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_answers'])) {
    header('Location: quiz.php');
    exit;
}

$user_answers = $_SESSION['user_answers'];
unset($_SESSION['user_answers']); // Clear after use

// Fetch correct answers
$ids = implode(',', array_keys($user_answers));
$stmt = $pdo->prepare("SELECT id, correct_option FROM questions WHERE id IN ($ids)");
$stmt->execute();
$corrects = $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // id => correct_option

// Calculate score
$correct_count = 0;
foreach ($user_answers as $id => $answer) {
    if ($answer == $corrects[$id]) {
        $correct_count++;
    }
}
$total = count($user_answers);
$percentage = ($correct_count / $total) * 100;
// Simple IQ estimate: 100 + (percentage - 50)*0.3, clamped 70-130
$iq = max(70, min(130, 100 + ($percentage - 50) * 0.3));

// Feedback
if ($iq >= 120) {
    $feedback = "Exceptional intelligence! You have strong cognitive abilities in logic, patterns, and problem-solving.";
    $improvement = "Continue challenging yourself with advanced puzzles.";
} elseif ($iq >= 100) {
    $feedback = "Above average! Good skills in reasoning and numerical abilities.";
    $improvement = "Focus on pattern recognition for further improvement.";
} else {
    $feedback = "Room for growth. Your strengths may lie elsewhere.";
    $improvement = "Practice logical puzzles daily to boost your score.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Results</title>
    <style>
        /* Internal CSS - Amazing, colorful, with animations */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #84fab0, #8fd3f4);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: gradientAnimation 15s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color: #32cd32;
            font-size: 2.5em;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }
        .score {
            font-size: 3em;
            color: #ff4500;
            margin: 20px 0;
            animation: bounce 1s;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-30px); }
            60% { transform: translateY(-15px); }
        }
        button {
            background: #ff69b4;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 50px;
            cursor: pointer;
            margin: 10px;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #ff1493;
            transform: scale(1.1);
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .container { padding: 20px; }
            h1 { font-size: 2em; }
            .score { font-size: 2.5em; }
            p { font-size: 1em; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your IQ Test Results</h1>
        <p class="score"><?php echo round($iq); ?></p>
        <p><strong>Score:</strong> <?php echo $correct_count; ?> out of <?php echo $total; ?> correct.</p>
        <p><?php echo $feedback; ?></p>
        <p><strong>Improvement Areas:</strong> <?php echo $improvement; ?></p>
        <button onclick="window.location.href='quiz.php';">Retake Test</button>
        <button onclick="shareResults();">Share Results</button>
    </div>
    <script>
        // Internal JS - Share function
        function shareResults() {
            const text = `My IQ score is <?php echo round($iq); ?>! Take the test yourself.`;
            navigator.clipboard.writeText(text).then(() => {
                alert('Results copied to clipboard!');
            });
        }
    </script>
</body>
</html>
