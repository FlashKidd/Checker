<?php
session_start();
if(!isset($_SESSION["user_id"])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The One Checker™</title>
  <style>
    :root {
      --neon1: #00f6ff;
      --neon2: #00f6ff;
      --neon3: #00f6ff;
      --bg: #151515;
      --text: #fff;
      --panel: #222;
      --ok-bg: rgba(0,255,0,0.1);
      --fail-bg: rgba(255,0,0,0.1);
      --ok-border: #00ff00;
      --fail-border: #ff0000;
    }
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
      body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(to bottom right, #0f0f0f, #1a1a1a);
        color: var(--text);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
      }
    .container {
      width: 90%;
      max-width: 800px;
      background: var(--bg);
      border-radius: 12px;
      box-shadow: 0 0 25px rgba(0,255,255,0.2);
      padding: 40px;
      position: relative;
      overflow: hidden;
      text-align: center;
    }

    h1 {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }
    .welcome {
      font-size: 1rem;
      color: var(--neon3);
      margin-bottom: 1rem;
    }

    h1 {
      text-align: center;
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }

    .stats {
      display: flex;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    .stat {
      flex: 1;
      background: rgba(255,255,255,0.05);
      padding: 0.8rem;
      border-radius: 6px;
      text-align: center;
      box-shadow: 0 0 6px var(--neon2);
    }
    .stat-icon { font-size: 1.2rem; }
    .stat-value {
      font-size: 1.2rem;
      font-weight: bold;
      margin: 0.2rem 0;
      color: var(--neon1);
    }
    .stat-label { font-size: 0.7rem; color: #aaa; }
    textarea {
      width: 100%; height: 100px;
      background: rgba(255,255,255,0.05);
      border: none; border-radius: 8px;
      padding: 0.8rem; font-size: 0.95rem; color: var(--text);
      box-shadow: inset 0 0 6px var(--neon3);
      resize: vertical;
      margin-bottom: 1rem;
    }
    .controls {
      margin-bottom: 1rem;
    }
    .controls > * {
      display: block;
      width: 100%;
      margin-bottom: 0.8rem;
      padding: 0.6rem;
      font-size: 0.95rem;
      border-radius: 6px;
    }
    .controls select {
      background: #222;
      border: none;
      color: var(--text);
    }
    .controls button {
      background: var(--neon1);
      border: none;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s ease;
      box-shadow: 0 0 6px var(--neon1);
    }
    button:disabled {
      opacity: 0.4;
      cursor: default;
      box-shadow: none;
    }
    button:not(:disabled):hover {
      background: #00d1ff;
    }
    .progress-container {
      margin-bottom: 1rem;
    }
    .bar-bg {
      width: 100%; height: 16px;
      background: rgba(255,255,255,0.1);
      border-radius: 8px; overflow: hidden;
      box-shadow: inset 0 0 6px var(--neon3);
    }
    #progressBar {
      width: 0%; height: 100%;
      background: linear-gradient(90deg, var(--neon1), var(--neon2));
      transition: width 0.3s ease;
    }
    #progressText {
      text-align: right;
      margin-top: 0.2rem;
      font-size: 0.85rem;
      color: var(--neon3);
    }
    .toggles {
      display: flex;
      gap: 1rem;
      justify-content: center;
      margin-bottom: 1rem;
    }
    .pill {
      padding: 0.5rem 1rem;
      border-radius: 999px;
      background: #222;
      color: var(--text);
      font-size: 0.9rem;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 0 6px var(--neon1);
      transition: 0.3s;
      user-select: none;
    }
    .pill.active {
      background: var(--neon1);
      color: #000;
    }
    .pill .count { margin-left: 0.4rem; font-size: 1rem; }
    .results {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease;
      position: relative;
      margin-bottom: 1rem;
    }
    .results.visible { max-height: 250px; }
    .results pre {
      background: var(--panel);
      padding: 0.8rem;
      margin-top: 0.4rem;
      border-left: 4px solid transparent;
      border-radius: 6px;
      box-shadow: inset 0 0 6px var(--neon3);
      color: var(--text);
      font-size: 0.9rem;
      white-space: pre-wrap;
      overflow-y: auto;
      max-height: 200px;
    }
    .copy-btn {
      position: absolute;
      top: 0.3rem;
      right: 0.3rem;
      background: var(--neon1);
      border: none;
      padding: 0.3rem 0.6rem;
      border-radius: 4px;
      font-size: 0.75rem;
      cursor: pointer;
      transition: background 0.2s;
    }
    .copy-btn:hover { background: var(--neon3); }
    footer {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.75rem;
      color: #555;
    }
    #confetti {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 10;
    }
  </style>
</head>
<body>
  <canvas id="confetti"></canvas>
  <div class="container">
    <h1>The One Checker™</h1>
    <div class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['user_id']); ?></div>
    <div class="stats">
      <div class="stat"><div class="stat-icon">📋</div><div class="stat-value" id="total">0</div><div class="stat-label">Total</div></div>
      <div class="stat"><div class="stat-icon">✔️</div><div class="stat-value" id="checked">0</div><div class="stat-label">Checked</div></div>
      <div class="stat"><div class="stat-icon">⏳</div><div class="stat-value" id="remaining">0</div><div class="stat-label">Remaining</div></div>
    </div>
    <textarea id="ipList" placeholder="Enter cc|mes|ano|cvv, one per line…"></textarea>
    <div class="controls">
      <select id="apiSelect">
        <option value="1">API 1 (default)</option>
        <option value="2">API 2</option>
        <option value="3">API 3</option>
      </select>
      <button id="startBtn" disabled>Start</button>
      <button id="stopBtn" disabled>Stop</button>
    </div>
    <div class="progress-container">
      <div class="bar-bg"><div id="progressBar"></div></div>
      <div id="progressText">0%</div>
    </div>
    <div class="toggles">
      <div id="pill-ok" class="pill" onclick="toggleList('ok')">Working <span class="count" id="count-ok">0</span></div>
      <div id="pill-fail" class="pill" onclick="toggleList('fail')">Not Working <span class="count" id="count-fail">0</span></div>
    </div>
    <div id="results-ok" class="results"><button class="copy-btn" onclick="copyList('ok')">Copy</button><pre id="okList"></pre></div>
    <div id="results-fail" class="results"><button class="copy-btn" onclick="copyList('fail')">Copy</button><pre id="failList"></pre></div>
    <footer>The One Checker™</footer>
  </div>
  <script>
    const txt = document.getElementById('ipList');
    const startBtn = document.getElementById('startBtn');
    const stopBtn = document.getElementById('stopBtn');
    const apiSel = document.getElementById('apiSelect');
    const okList = document.getElementById('okList');
    const failList = document.getElementById('failList');
    const canvas = document.getElementById('confetti');
    const ctx = canvas.getContext('2d');
    const container = document.querySelector('.container');
    let ipQueue = [], isRunning = false, total = 0, checked = 0, okCount = 0, failCount = 0;
    const LIMIT = 10; let particles = [], confLaunched = false;

    function resizeCanvas() {
      canvas.width = container.offsetWidth;
      canvas.height = container.offsetHeight;
    }
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    txt.addEventListener('input', () => {
      startBtn.disabled = txt.value.trim() === '';
    });

    startBtn.addEventListener('click', startCheck);
    stopBtn.addEventListener('click', stopCheck);

    function updateStats() {
      document.getElementById('total').textContent     = total;
      document.getElementById('checked').textContent   = checked;
      document.getElementById('remaining').textContent = total - checked;
      document.getElementById('count-ok').textContent  = okCount;
      document.getElementById('count-fail').textContent= failCount;
      const pct = total ? Math.round((checked/total)*100) : 0;
      document.getElementById('progressBar').style.width  = pct + '%';
      document.getElementById('progressText').textContent = pct + '%';
      if(pct === 100 && !confLaunched) launchConfetti();
    }

    function updateInputList() {
      txt.value = ipQueue.join('\n');
    }

    function startCheck() {
      ipQueue   = txt.value.trim().split('\n').map(l => l.trim()).filter(l => l);
      total     = ipQueue.length;
      checked   = okCount = failCount = 0;
      okList.textContent   = '';
      failList.textContent = '';
      isRunning = true;
      startBtn.disabled = true;
      stopBtn.disabled  = false;
      updateStats();
      updateInputList();
      for(let i=0; i<LIMIT; i++) processNext();
    }

    function stopCheck() {
      isRunning = false;
      stopBtn.disabled = true;
      startBtn.disabled= txt.value.trim() === '';
    }

    function processNext() {
  if (!isRunning || !ipQueue.length) {
    if (checked >= total) stopCheck();
    return;
  }

  const ip = ipQueue.shift();
  updateInputList();

  // pick endpoint based on API selector
  let endpoint = 'checkproxy.php';
  if (apiSel.value === '2') endpoint = 'api.php';
  else if (apiSel.value === '3') endpoint = 'captcha.php';

  const xhr = new XMLHttpRequest();
  xhr.open('GET', `${endpoint}?ip=${encodeURIComponent(ip)}`, true);
  xhr.onload = () => {
    checked++;
    const raw = xhr.responseText.trim();
    let listType, borderColor, bgColor;

    if (raw.includes('#Approved')) {
      okCount++;
      listType = 'ok';
      borderColor = 'var(--ok-border)';
      bgColor     = 'var(--ok-bg)';
    } else if (raw.includes('#Declined')) {
      failCount++;
      listType = 'fail';
      borderColor = 'var(--fail-border)';
      bgColor     = 'var(--fail-bg)';
    } else {
      failCount++;
      listType = 'fail';
      borderColor = 'var(--fail-border)';
      bgColor     = 'var(--fail-bg)';
    }

    // create a <pre> so you see the whole response
    const entry = document.createElement('pre');
    entry.textContent = `${raw}`;
    entry.style.borderLeft = `4px solid ${borderColor}`;
    entry.style.background   = bgColor;

    // append to the correct list
    if (listType === 'ok')   okList.appendChild(entry);
    if (listType === 'fail') failList.appendChild(entry);

    updateStats();
    processNext();
  };

  xhr.onerror = () => {
    checked++;
    failCount++;
    const entry = document.createElement('pre');
    entry.textContent = `${ip}\n[ERROR]`;
    entry.style.borderLeft   = '4px solid var(--fail-border)';
    entry.style.background   = 'var(--fail-bg)';
    failList.appendChild(entry);
    updateStats();
    processNext();
  };

  xhr.send();
}


    function toggleList(type) {
      const pill = document.getElementById(`pill-${type}`);
      const res  = document.getElementById(`results-${type}`);
      const wasActive = pill.classList.contains('active');
      ['ok','fail'].forEach(t=>{
        document.getElementById(`pill-${t}`).classList.remove('active');
        document.getElementById(`results-${t}`).classList.remove('visible');
      });
      if(!wasActive) {
        pill.classList.add('active');
        res.classList.add('visible');
      }
    }

    function copyList(type) {
      const listEl = document.getElementById(`${type}List`);
      if(!listEl) return;
      const text = Array.from(listEl.children)
                        .map(div => div.textContent)
                        .join('\n');
      navigator.clipboard.writeText(text).then(() => alert('Copied!'));
    }

    function launchConfetti() {
      confLaunched = true;
      const W = canvas.width, H = canvas.height;
      for(let i=0; i<150; i++) {
        particles.push({
          x: Math.random()*W,
          y: -10,
          r: Math.random()*8+4,
          d: Math.random()*150,
          tilt: Math.random()*10-10,
          color: `hsl(${Math.random()*360},100%,60%)`,
          inc: Math.random()*0.07+0.05,
          angle: 0
        });
      }
      (function anim(){
        ctx.clearRect(0,0,W,H);
        particles.forEach(p => {
          p.angle += p.inc;
          p.y += (Math.cos(p.d)+3+p.r/2)/2;
          p.tilt = Math.sin(p.angle)*15;
          ctx.beginPath();
          ctx.lineWidth = p.r/2;
          ctx.strokeStyle = p.color;
          ctx.moveTo(p.x+p.tilt+p.r/4, p.y);
          ctx.lineTo(p.x+p.tilt, p.y+p.tilt+p.r/4);
          ctx.stroke();
        });
        particles = particles.filter(p=>p.y < H+20);
        if(particles.length) requestAnimationFrame(anim);
      })();
    }
  </script>
</body>
</html>
