<?php
$user = "Flash Kidd";
$country = "Somewhere Around The Globe";
$skills = ["PHP", "Java", "Rizzing", "Roasting", "Many More"];
$hobbies = ["Chess", "Anime", "Free Fire","Coding"];
$quotes = [
  "Discipline, Desire, Stack, Focus, Move in silence",
  "Comfort is the enemy of growth. Lean into the discomfort.",
  "Your only guarantee is uncertainty. Embrace it.",
  "Failure is feedback, not a final verdict.",
  "Time is ruthless: it won’t wait for you.",
  "You are the author of your story. Stop blaming the plot.",
  "Nobody owes you anything. Earn everything.",
  "Pain is universal; your struggle doesn’t make you special.",
  "Action breeds confidence; waiting breeds doubt.",
  "Dreams don’t work unless you do.",
  "Death is the ultimate deadline. Make every second count."
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Flash Kidd's World</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --bg: #0d0d0d;
      --accent: #00ffee;
      --secondary: #ff00aa;
      --text: #e0e0e0;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem;
    }
    h1 {
      color: var(--accent);
      font-size: 2.5rem;
      margin-bottom: 0.3rem;
      animation: glow 2s infinite alternate;
    }
    @keyframes glow {
      from { text-shadow: 0 0 5px var(--accent); }
      to { text-shadow: 0 0 20px var(--accent), 0 0 30px var(--secondary); }
    }
    .box {
      background: #111;
      border: 1px solid var(--accent);
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,255,255,0.1);
      width: 100%;
      max-width: 600px;
      margin-top: 1rem;
    }
    ul {
      padding-left: 1.2rem;
    }
    .btn {
      background: var(--accent);
      color: black;
      padding: 0.7rem 1.2rem;
      margin: 0.5rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.2s;
    }
    .btn:hover {
      background: var(--secondary);
      color: white;
    }
    .hidden {
      display: none;
    }
    .btn-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 1rem;
    }
    footer {
      margin-top: 2rem;
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>
<body>
  <h1>Yo! I'm <?php echo $user; ?> 👾</h1>
  <div class="box">
    <p><strong>Country:</strong> <?php echo $country; ?></p>
    <p><strong>Skills:</strong></p>
    <ul>
      <?php foreach ($skills as $skill) echo "<li>$skill</li>"; ?>
    </ul>
    <p><strong>Hobbies:</strong></p>
    <ul>
      <?php foreach ($hobbies as $hobby) echo "<li>$hobby</li>"; ?>
    </ul>
    <p><strong>Life Motto:</strong> <em>"<?php echo $quotes[0]; ?>"</em></p>

    <div class="btn-container">
      <button class="btn" onclick="showQuote()">More Quotes </button>
      <a href="login.php" class="btn">Login </a>
    </div>
    
    <p id="quote" class="hidden"></p>
  </div>

  <footer>Hosted with ❤️ — FlashKidd <?php echo date("Y"); ?></footer>

  <script>
    const quotes = <?php echo json_encode(array_slice($quotes, 1)); ?>;
    function showQuote() {
      const q = quotes[Math.floor(Math.random() * quotes.length)];
      const el = document.getElementById("quote");
      el.innerText = q;
      el.classList.remove("hidden");
    }
  </script>
</body>
</html>
