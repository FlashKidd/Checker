<?php
session_start();

// Check if we have a pending token and user ID
if (!isset($_SESSION['pending_user']) || !isset($_SESSION['pending_token'])) {
    header("Location: login.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredToken = trim($_POST['token']);
    $expectedToken = $_SESSION['pending_token'];

    if ($enteredToken == $expectedToken) {
        $_SESSION['user_id'] = $_SESSION['pending_user'];
        unset($_SESSION['pending_token'], $_SESSION['pending_user']);
        header("Location: index2.php");
        exit;
    } else {
        $error = "❌ Invalid token. Please check the code sent to your Telegram.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Token</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #0d0d0d;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,255,255,0.2);
            text-align: center;
        }
        input {
            padding: 10px;
            width: 80%;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            background-color: #222;
            color: white;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #00f6ff;
            color: #000;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        .error {
            color: #ff4444;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>🔐 Enter Your Token</h2>
        <p>Check your Telegram for a 6-digit login code</p>
        <form method="POST">
            <input type="text" name="token" placeholder="Enter token" required><br>
            <button type="submit">Verify</button>
        </form>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
    </div>
</body>
</html>
