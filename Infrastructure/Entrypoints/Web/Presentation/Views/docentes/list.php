<?php
$pageTitle = 'Lista de Docentes';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'header.php';

use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>

<?php if (Flash::has('success')): ?>
    <div class="alert alert-success"><?= htmlspecialchars(Flash::get('success')) ?></div>
<?php endif; ?>
<?php if (Flash::has('error')): ?>
    <div class="alert alert-error"><?= htmlspecialchars(Flash::get('error')) ?></div>
<?php endif; ?>

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 class="page-title">Docentes</h1>
        <p class="page-sub"><?= count($docentes) ?> docente(s) registrado(s)</p>
    </div>
    <a href="index.php?route=docentes.create" class="btn btn-primary">➕ Nuevo docente</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Escalafón</th>
                    <th>Idioma</th>
                    <th>Experiencia</th>
                    <th>Área</th>
                    <th style="text-align:center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($docentes)): ?>
                <tr>
                    <td colspan="9" style="text-align:center;padding:2rem;color:var(--text-muted);">
                        No hay docentes registrados. <a href="index.php?route=docentes.create" style="color:var(--accent);">Crear el primero</a>.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($docentes as $d): ?>
                <tr>
                    <td style="color:var(--text-muted)"><?= $d->id ?></td>
                    <td>
                        <div style="font-weight:500"><?= htmlspecialchars($d->nombreCompleto) ?></div>
                        <div style="font-size:.78rem;color:var(--text-muted)"><?= htmlspecialchars($d->profesional) ?></div>
                    </td>
                    <td><?= htmlspecialchars($d->email) ?></td>
                    <td><?= htmlspecialchars($d->telefono) ?></td>
                    <td><span class="badge badge-blue"><?= htmlspecialchars($d->escalafon) ?></span></td>
                    <td><span class="badge badge-purple"><?= htmlspecialchars($d->idioma) ?></span></td>
                    <td style="text-align:center"><?= $d->aniosExperiencia ?> año(s)</td>
                    <td><?= htmlspecialchars($d->areaTrabajo) ?></td>
                    <td style="text-align:center">
                        <div style="display:flex;gap:.4rem;justify-content:center;">
                            <a href="index.php?route=docentes.show&id=<?= $d->id ?>"
                               class="btn btn-secondary btn-sm" title="Ver detalle">👁</a>
                            <a href="index.php?route=docentes.edit&id=<?= $d->id ?>"
                               class="btn btn-warning btn-sm" title="Editar">✏️</a>
                            <form method="POST"
                                  action="index.php?route=docentes.destroy&id=<?= $d->id ?>"
                                  style="display:inline"
                                  onsubmit="return confirm('¿Eliminar a <?= htmlspecialchars(addslashes($d->nombreCompleto)) ?>?')">
                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">🗑</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'footer.php'; ?>
