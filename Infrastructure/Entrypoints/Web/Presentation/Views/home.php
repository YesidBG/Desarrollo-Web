<?php
$pageTitle = 'Inicio';
require __DIR__ . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'header.php';

use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>

<?php if (Flash::has('success')): ?>
    <div class="alert alert-success"><?= htmlspecialchars(Flash::get('success')) ?></div>
<?php endif; ?>
<?php if (Flash::has('error')): ?>
    <div class="alert alert-error"><?= htmlspecialchars(Flash::get('error')) ?></div>
<?php endif; ?>

<div class="page-header">
    <h1 class="page-title">Panel de control</h1>
    <p class="page-sub">Sistema de gestión de docentes</p>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1.25rem;margin-bottom:2rem;">
    <div class="card" style="padding:1.5rem;display:flex;align-items:center;gap:1rem;">
        <div style="font-size:2.5rem;">👨‍🏫</div>
        <div>
            <div style="font-size:2rem;font-weight:700;color:var(--accent)"><?= (int)$totalDocentes ?></div>
            <div style="color:var(--text-muted);font-size:.88rem;">Docentes registrados</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Acciones rápidas</span>
    </div>
    <div class="card-body" style="display:flex;gap:1rem;flex-wrap:wrap;">
        <a href="index.php?route=docentes.index"  class="btn btn-primary">📋 Ver todos los docentes</a>
        <a href="index.php?route=docentes.create" class="btn btn-success">➕ Registrar nuevo docente</a>
    </div>
</div>

<?php require __DIR__ . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'footer.php'; ?>