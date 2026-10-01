<?php
session_start();

// Lógica para el contador con persistencia en sesión (API REST simulada)
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    if (!isset($_SESSION['count'])) $_SESSION['count'] = 0;

    if ($_GET['action'] === 'inc') $_SESSION['count']++;
    elseif ($_GET['action'] === 'dec') $_SESSION['count']--;
    elseif ($_GET['action'] === 'reset') $_SESSION['count'] = 0;

    echo json_encode(['count' => $_SESSION['count']]);
    exit;
}

$count = $_SESSION['count'] ?? 0;

// Saludo dinámico según la hora del servidor
date_default_timezone_set('Europe/Madrid');
$hora = (int)date('H');
if ($hora >= 6 && $hora < 12) {
    $saludo = "¡Buenos días, David!";
    $icono = "🌅";
} elseif ($hora >= 12 && $hora < 20) {
    $saludo = "¡Buenas tardes, David!";
    $icono = "☕";
} else {
    $saludo = "¡Buenas noches, David!";
    $icono = "🌙";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $saludo ?></title>
    <style>
        :root {
            --bg-gradient: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.25);
            --text-main: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.85);
            --btn-bg: #ffffff;
            --btn-color: #e73c7e;
            --badge-bg: rgba(255, 255, 255, 0.2);
        }

        [data-theme="dark"] {
            --bg-gradient: linear-gradient(-45deg, #1a1a2e, #16213e, #0f3460, #e94560);
            --card-bg: rgba(0, 0, 0, 0.4);
            --card-border: rgba(255, 255, 255, 0.1);
            --text-main: #e0e0e0;
            --text-muted: rgba(255, 255, 255, 0.6);
            --btn-bg: #2a2a2a;
            --btn-color: #e94560;
            --badge-bg: rgba(0, 0, 0, 0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; transition: background 0.3s, color 0.3s, transform 0.2s; }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
            background: var(--bg-gradient);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .theme-toggle {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            color: var(--text-main);
            padding: 0.6rem 1.2rem;
            border-radius: 20px;
            cursor: pointer;
            backdrop-filter: blur(10px);
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .theme-toggle:hover {
            transform: translateY(-2px);
        }

        .card {
            text-align: center;
            padding: 3rem 2.5rem;
            border-radius: 24px;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 90%;
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .emoji {
            font-size: 4.5rem;
            display: inline-block;
            animation: float 3s ease-in-out infinite;
            margin-bottom: 0.5rem;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }

        h1 {
            color: var(--text-main);
            font-size: 2.2rem;
            margin: 0.5rem 0;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        #clock {
            color: var(--text-main);
            font-size: 1.5rem;
            font-weight: 600;
            font-variant-numeric: tabular-nums;
            padding: 0.6rem 1.2rem;
            background: var(--badge-bg);
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 1.5rem;
            border: 1px solid var(--card-border);
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.1);
        }

        .counter-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.2rem;
            margin-bottom: 1rem;
        }

        .btn {
            border: none;
            padding: 0.8rem 2rem;
            font-size: 1.3rem;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            color: var(--btn-color);
            background: var(--btn-bg);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }
        
        .btn:hover { transform: scale(1.05); }
        .btn:active { transform: scale(0.95); }

        .btn-reset {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            margin-bottom: 1.5rem;
            background: transparent;
            border: 1px solid var(--card-border);
            color: var(--text-main);
            box-shadow: none;
        }
        .btn-reset:hover {
            background: var(--badge-bg);
        }

        #count {
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--text-main);
            min-width: 4rem;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
            justify-content: center;
            margin-top: 1rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--card-border);
        }

        .badge {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            background: var(--badge-bg);
            border: 1px solid var(--card-border);
        }
    </style>
</head>
<body>
    <button class="theme-toggle" onclick="toggleTheme()">🌓 Modo Oscuro</button>

    <div class="card">
        <div class="emoji"><?= $icono ?></div>
        <h1><?= $saludo ?></h1>
        <p class="subtitle">PHP Avanzado: Fetch API + Sesiones</p>

        <div id="clock">--:--:--</div>

        <div class="counter-section">
            <button class="btn" onclick="updateCounter('dec')" aria-label="Restar">−</button>
            <span id="count"><?= $count ?></span>
            <button class="btn" onclick="updateCounter('inc')" aria-label="Sumar">+</button>
        </div>
        <button class="btn btn-reset" onclick="updateCounter('reset')">↺ Reiniciar Contador</button>

        <div class="badges">
            <span class="badge">PHP <?= phpversion() ?></span>
            <span class="badge">Sesión Activa</span>
            <span class="badge">Fetch API</span>
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

        // Fetch API para comunicarse con PHP sin recargar
        async function updateCounter(action) {
            try {
                const response = await fetch(`?action=${action}`);
                const data = await response.json();
                
                const el = document.getElementById('count');
                el.textContent = data.count;
                
                // Efecto visual al cambiar
                el.animate(
                    [{ transform: 'scale(1.4)' }, { transform: 'scale(1)' }],
                    { duration: 300, easing: 'ease-out' }
                );
            } catch (e) {
                console.error('Error de conexión:', e);
            }
        }

        // Alternador de Modo Claro/Oscuro
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.getAttribute('data-theme') === 'dark';
            html.setAttribute('data-theme', isDark ? 'light' : 'dark');
            
            const btn = document.querySelector('.theme-toggle');
            btn.textContent = isDark ? '🌓 Modo Oscuro' : '☀️ Modo Claro';
        }
    </script>
</body>
</html>
