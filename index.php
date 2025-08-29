<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IQ Test - Homepage</title>
    <style>
        /* Internal CSS - Amazing, colorful, with animations */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4);
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
            color: #ff6b6b;
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
            margin-bottom: 30px;
            color: #555;
        }
        button {
            background: #4ecdc4;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2em;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #45b7a7;
            transform: scale(1.1);
        }
        /* Responsive design */
        @media (max-width: 600px) {
            .container { padding: 20px; }
            h1 { font-size: 2em; }
            p { font-size: 1em; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to the IQ Test</h1>
        <p>This online IQ test assesses your logical reasoning, pattern recognition, and problem-solving skills. It's designed to give you an estimate of your cognitive abilities. Ready to challenge your mind?</p>
        <button onclick="window.location.href='quiz.php';">Start Test</button>
    </div>
</body>
</html>
