<?php
session_start();
include 'db.php';

// Fetch questions from DB
$stmt = $pdo->prepare("SELECT * FROM questions LIMIT 10"); // Limit to 10 for the test
$stmt->execute();
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store answers in session and redirect to results using JS (but since POST, handle here and use JS redirect)
    $_SESSION['user_answers'] = $_POST['answers'];
    echo "<script>window.location.href='results.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Quiz</title>
    <style>
        /* Internal CSS - Amazing, colorful, with animations */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #a18cd1, #fbc2eb);
            color: #333;
            margin: 0;
            padding: 20px;
            animation: gradientAnimation 15s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            margin: auto;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h1 {
            color: #6a5acd;
            text-align: center;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            background: #f0f8ff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .question:hover {
            transform: translateY(-5px);
        }
        label {
            display: block;
            margin: 10px 0;
            font-size: 1.1em;
            cursor: pointer;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        button {
            background: #ffd700;
            color: #333;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 50px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #ffcc00;
            transform: scale(1.1);
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .container { padding: 20px; }
            h1 { font-size: 1.8em; }
            label { font-size: 1em; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>IQ Test Quiz</h1>
        <form method="POST" id="quizForm">
            <?php foreach ($questions as $index => $q): ?>
                <div class="question">
                    <p><strong>Question <?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($q['question_text']); ?></p>
                    <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="A"> A: <?php echo htmlspecialchars($q['option_a']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="B"> B: <?php echo htmlspecialchars($q['option_b']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="C"> C: <?php echo htmlspecialchars($q['option_c']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $q['id']; ?>]" value="D"> D: <?php echo htmlspecialchars($q['option_d']); ?></label>
                </div>
            <?php endforeach; ?>
            <button type="submit">Submit Answers</button>
        </form>
    </div>
    <script>
        // Internal JS - No separate file
        // Simple validation or navigation can be added, but for now, basic submit
    </script>
</body>
</html>
