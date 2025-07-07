<?php
session_start();
$user_sessions = json_decode(file_get_contents("user_sessions.json"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = trim($_POST['user_id']);

    if (!isset($user_sessions[$userId]['access_granted']) || !$user_sessions[$userId]['access_granted']) {
        $error = " You must pass the challenge first. Use /start in the bot.";
    } else {
        // Generate and send token
        $token = rand(100000, 999999);
        $_SESSION['pending_user'] = $userId;
        $_SESSION['pending_token'] = $token;

        // Send token via bot
        $botToken = "8099845785:AAGNQGM7jgv38FpwFdJNbCY389NlBX1ZOZg";
        $msg = "🔐 Your login token is: <code>$token</code>\nEnter this on the website.";
        file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$userId&text=" . urlencode($msg) . "&parse_mode=HTML");

        header("Location: token.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The One | Login</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom right, #0f0f0f, #1a1a1a);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #151515;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.2);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        .container img {
            width: 100px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 12px;
            width: 80%;
            border: none;
            border-radius: 6px;
            margin-top: 10px;
            background-color: #222;
            color: #fff;
        }

        button {
            margin-top: 20px;
            padding: 12px 25px;
            background: #00f6ff;
            border: none;
            color: black;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            transition: 0.3s ease;
        }

        button:hover {
            background: #00d1ff;
        }

        .error {
            color: #ff6666;
            margin-top: 10px;
        }

        .loader {
            width: 100px;
            height: 5px;
            background: #333;
            margin: 20px auto;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .loader::before {
            content: "";
            position: absolute;
            width: 40%;
            height: 100%;
            background: #00ffff;
            animation: move 2s linear infinite;
        }

        @keyframes move {
            0% { left: -40%; }
            100% { left: 100%; }
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="theone.png" alt="The One">
        <h2>Access The One</h2>
        <form method="POST">
            <input type="text" name="user_id" placeholder="Enter your Telegram User ID" required><br>
            <button type="submit">Request Access</button>
        </form>
        <div class="loader"></div>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    </div>
</body>
</html>
