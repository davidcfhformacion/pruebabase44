<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Hola, David!</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .card {
            text-align: center;
            padding: 3rem 2.5rem;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .emoji {
            font-size: 4rem;
            display: inline-block;
            animation: wave 2s ease infinite;
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            20%      { transform: rotate(15deg); }
            40%      { transform: rotate(-10deg); }
            60%      { transform: rotate(15deg); }
            80%      { transform: rotate(-5deg); }
        }

        h1 {
            color: #fff;
            font-size: 2.5rem;
            margin: 0.5rem 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        #clock {
            color: #fff;
            font-size: 1.3rem;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .counter-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn {
            border: none;
            padding: 0.75rem 1.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            color: #e73c7e;
            background: #fff;
        }

        .btn:hover { transform: scale(1.08); box-shadow: 0 4px 20px rgba(0,0,0,0.25); }
        .btn:active { transform: scale(0.95); }

        #count {
            font-size: 2rem;
            font-weight: 800;
            color: #fff;
            min-width: 3rem;
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .badge {
            padding: 0.35rem 0.9rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="emoji">👋</div>
        <h1>¡Hola, David!</h1>
        <p class="subtitle">Página de prueba dinámica en PHP</p>

        <div id="clock"></div>

        <div class="counter-section">
            <button class="btn" onclick="changeCount(-1)">−</button>
            <span id="count">0</span>
            <button class="btn" onclick="changeCount(1)">+</button>
        </div>

        <div class="badges">
            <span class="badge">PHP <?= phpversion() ?></span>
            <span class="badge">Servidor integrado</span>
            <span class="badge">Docker Compose</span>
        </div>
    </div>

    <script>
        // Reloj en tiempo real
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').textContent =
                now.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        }
        updateClock();
        setInterval(updateClock, 1000);

        // Contador dinámico
        let count = 0;
        function changeCount(delta) {
            count += delta;
            document.getElementById('count').textContent = count;
            const el = document.getElementById('count');
            el.animate(
                [{ transform: 'scale(1.3)' }, { transform: 'scale(1)' }],
                { duration: 200, easing: 'ease-out' }
            );
        }
    </script>
</body>
</html>
