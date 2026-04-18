<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'CRUD Docentes') ?></title>
    <style>
        /* ── Reset & Variables ─────────────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0f1117;
            --bg2:       #181c27;
            --bg3:       #1e2335;
            --accent:    #4f8ef7;
            --accent2:   #7c3aed;
            --success:   #22c55e;
            --danger:    #ef4444;
            --warning:   #f59e0b;
            --text:      #e2e8f0;
            --text-muted:#94a3b8;
            --border:    #2d3748;
            --radius:    10px;
            --shadow:    0 4px 24px rgba(0,0,0,.45);
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ────────────────────────────────────────────────── */
        .navbar {
            background: var(--bg2);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 60px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.4);
        }
        .navbar-brand {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--accent);
            text-decoration: none;
            letter-spacing: .03em;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .navbar-brand span { color: var(--text); font-weight: 400; }
        .navbar-nav { display: flex; gap: .5rem; }
        .nav-link {
            color: var(--text-muted);
            text-decoration: none;
            padding: .4rem .9rem;
            border-radius: 6px;
            font-size: .9rem;
            transition: background .2s, color .2s;
        }
        .nav-link:hover, .nav-link.active {
            background: var(--bg3);
            color: var(--text);
        }

        /* ── Main ──────────────────────────────────────────────────── */
        .main-content {
            flex: 1;
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        /* ── Alertas flash ─────────────────────────────────────────── */
        .alert {
            padding: .85rem 1.2rem;
            border-radius: var(--radius);
            margin-bottom: 1.5rem;
            font-size: .93rem;
            border-left: 4px solid;
        }
        .alert-success { background: rgba(34,197,94,.1);  border-color: var(--success); color: #86efac; }
        .alert-error   { background: rgba(239,68,68,.1);  border-color: var(--danger);  color: #fca5a5; }
        .alert-warning { background: rgba(245,158,11,.1); border-color: var(--warning); color: #fde68a; }

        /* ── Cards ─────────────────────────────────────────────────── */
        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-title { font-size: 1.1rem; font-weight: 600; }
        .card-body  { padding: 1.5rem; }

        /* ── Tabla ──────────────────────────────────────────────────── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .9rem; }
        thead th {
            background: var(--bg3);
            color: var(--text-muted);
            font-weight: 600;
            font-size: .78rem;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: .75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        tbody tr { border-bottom: 1px solid var(--border); transition: background .15s; }
        tbody tr:hover { background: var(--bg3); }
        tbody td { padding: .8rem 1rem; vertical-align: middle; }

        /* ── Botones ────────────────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1.1rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: .88rem;
            font-weight: 500;
            text-decoration: none;
            transition: opacity .2s, transform .1s;
        }
        .btn:active { transform: scale(.97); }
        .btn:hover  { opacity: .85; }
        .btn-primary  { background: var(--accent);  color: #fff; }
        .btn-warning  { background: var(--warning); color: #111; }
        .btn-danger   { background: var(--danger);  color: #fff; }
        .btn-secondary{ background: var(--bg3);     color: var(--text); border: 1px solid var(--border); }
        .btn-success  { background: var(--success); color: #fff; }
        .btn-sm { padding: .3rem .7rem; font-size: .8rem; }

        /* ── Formulario ─────────────────────────────────────────────── */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }
        .form-group { display: flex; flex-direction: column; gap: .4rem; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: .83rem; color: var(--text-muted); font-weight: 500; }
        input[type=text], input[type=email], input[type=url],
        input[type=number], select, textarea {
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text);
            padding: .55rem .85rem;
            font-size: .9rem;
            outline: none;
            transition: border-color .2s;
            width: 100%;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
        }
        select option { background: var(--bg2); }

        /* ── Badge ──────────────────────────────────────────────────── */
        .badge {
            display: inline-block;
            padding: .2rem .6rem;
            border-radius: 20px;
            font-size: .75rem;
            font-weight: 600;
        }
        .badge-blue   { background: rgba(79,142,247,.2); color: #93c5fd; }
        .badge-purple { background: rgba(124,58,237,.2); color: #c4b5fd; }
        .badge-green  { background: rgba(34,197,94,.2);  color: #86efac; }

        /* ── Page title ─────────────────────────────────────────────── */
        .page-header { margin-bottom: 1.5rem; }
        .page-title  { font-size: 1.5rem; font-weight: 700; }
        .page-sub    { color: var(--text-muted); font-size: .9rem; margin-top: .25rem; }

        /* ── Responsive ─────────────────────────────────────────────── */
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
            .main-content { padding: 1rem; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="index.php?route=home" class="navbar-brand">
        <?php if (isset($_SESSION['auth'])): ?>
    <span style="color:#94a3b8;font-size:.85rem;padding:.4rem .5rem;">
        👤 <?= htmlspecialchars($_SESSION['auth']['nombre']) ?>
    </span>
    <a href="index.php?route=auth.logout" class="nav-link" style="color:#ef4444;">Salir</a>
<?php endif; ?>
        🎓 <span>CRUD</span> Docentes
    </a>
    <div class="navbar-nav">
        <a href="index.php?route=home"            class="nav-link">Inicio</a>
        <a href="index.php?route=docentes.index"  class="nav-link">Docentes</a>
        <a href="index.php?route=docentes.create" class="nav-link">+ Nuevo</a>
    </div>
</nav>

<div class="main-content">
